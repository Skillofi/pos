<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require '../db.php';

$where = '';
if (!empty($_REQUEST['from_date'])) {
    $where .= " AND date(post_date) >='" . $_REQUEST['from_date'] . "'";
}
if (!empty($_REQUEST['end_date'])) {
    $where .= " AND date(post_date) <='" . $_REQUEST['end_date'] . "'";
}
if (!empty($_REQUEST['orderID'])) {
    $where .= " AND ID='" . $_REQUEST['orderID'] . "'";
}
if (!empty($_REQUEST['customer'])) {
    $where .= " AND `wp_postmeta`.meta_value='" . $_REQUEST['customer'] . "'";
}


$draw            =   $_REQUEST['draw'];
$row             =   $_REQUEST['start'];
$rowperpage      =   $_REQUEST['length'];
$columnIndex     =   $_REQUEST['order'][0]['column'];
$columnName      =   $_REQUEST['columns'][$columnIndex]['data'];
$columnSortOrder =   $_REQUEST['order'][0]['dir'];
$searchValue     =   $_REQUEST['search']['value'];

// $sql_count = "select count(Id) as count from wp_posts
// Left Join `wp_postmeta` ON (`wp_posts`.ID=`wp_postmeta`.post_id AND wp_postmeta.meta_key = '_customer_user')
// WHERE post_type = 'shop_order'";

// $result_count = $conn->query($sql_count);
// $count_result = $result_count->fetch_assoc();
// $totalRecords = $count_result ? $count_result['count'] : 0;
$sql_count = "select count(Id) as count from wp_posts
Left Join `wp_postmeta` ON (`wp_posts`.ID=`wp_postmeta`.post_id AND wp_postmeta.meta_key = '_customer_user') WHERE post_type = 'shop_order' $where";
$result_count = $conn->query($sql_count);
$count_result = $result_count->fetch_assoc();
$totalRecordwithFilter = $count_result ? $count_result['count'] : 0;

$totalRecords = $count_result ? $count_result['count'] : 0;

$sql = "SELECT wp_posts.ID, wp_posts.post_date, wp_postmeta.meta_key, wp_postmeta.meta_value from wp_posts
Left Join `wp_postmeta` ON (`wp_posts`.ID=`wp_postmeta`.post_id AND wp_postmeta.meta_key = '_customer_user')
WHERE post_type = 'shop_order' $where ORDER BY wp_posts.post_date DESC LIMIT {$row},{$rowperpage} ";

$result = $conn->query($sql);
$data = array();
$i = $row + 1;

while ($val = $result->fetch_assoc()) {
    
    $sql1  = "SELECT * FROM `wp_postmeta` WHERE `post_id`='" . $val['ID'] . "' AND meta_key = '_order_total'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();

    $sql7  = "SELECT * FROM `wp_postmeta` WHERE `post_id`='" . $val['ID'] . "' AND meta_key = '_payment_method_title'";
    $result7 = $conn->query($sql7);
    $row7 = $result7->fetch_assoc();

    $sql1c  = "SELECT *,fname.meta_value as fname,lname.meta_value as lname FROM `wp_postmeta`
    Left Join `wp_users` ON (`wp_users`.ID=`wp_postmeta`.meta_value)
    Left Join `wp_usermeta` as fname ON (fname.user_id=`wp_users`.ID AND fname.meta_value='first_name')
    Left Join `wp_usermeta` as lname ON (lname.user_id=`wp_users`.ID AND lname.meta_value='first_name')
    WHERE `post_id`='" . $val['ID'] . "' AND wp_postmeta.meta_key = '_customer_user'";
    $result1c = $conn->query($sql1c);
    $row1c = $result1c->fetch_assoc();

    // $sqltax="Select sum(i.meta_value)as amount from wp_woocommerce_order_items o,wp_woocommerce_order_itemmeta i WHERE o.order_item_id=i.order_item_id and o.order_id='".$val['ID']."' AND o.order_item_type='line_item' and i.meta_key='_line_tax' ";
    // $resultax = $conn->query($sqltax);
    // $rowtx = $resultax->fetch_assoc();
  
    $data[] = array(
        'index' => $i,
        'date_created' => ($val['post_date'] != "") ? date('M d,Y', strtotime($val['post_date'])) : '',
        'date_time' => ($val['post_date'] != "") ? date('h:i:s A', strtotime($val['post_date'])) : '',
        'id' => $val['ID'],
        'customer' => $row1c ? ($row1c['user_nicename'] . ' ' . $row1c['fname'] . ' ' . $row1c['lname']) : '',
        'total' => number_format(($row1 ? $row1['meta_value'] : 0), 2),
        'paymentmethod' => $row7 ? $row7['meta_value'] : ''
    );
    $i++;
}
$response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecordwithFilter,
        "iTotalDisplayRecords" => $totalRecords,
        "aaData" => $data,
        
    );
echo json_encode($response);