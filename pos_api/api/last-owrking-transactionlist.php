<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require '../db.php';

$where='';
$where1;
if(!empty($_REQUEST['date']))
{
    $where .=" AND date(post_date)='".$_REQUEST['date']."'";
}
if(!empty($_REQUEST['order']))
{
    $where .=" AND ID='".$_REQUEST['order']."'";
}
if(!empty($_REQUEST['customer']))
{
    $where .=" AND `wp_postmeta`.meta_value='".$_REQUEST['customer']."'";
}


 $sql_count="select count(Id) as count from wp_posts
Left Join `wp_postmeta` ON (`wp_posts`.ID=`wp_postmeta`.post_id AND wp_postmeta.meta_key = '_customer_user')
WHERE post_type = 'shop_order' $where";

$result_count = $conn->query($sql_count);
$count_result = $result_count->fetch_assoc();
$totalrecords = $count_result? $count_result['count'] : 0;

$perpage=25;
if(isset($_REQUEST['limit']))
{
    $perpage = $_REQUEST['limit'];
}

if($perpage<=0)
    $perpage=25;

$current_page=1;
if(isset($_REQUEST['page']))
{
    $current_page = $_REQUEST['page'];
}
if($current_page<0)
    $current_page = 0;

$skip = $perpage * ($current_page<=0?0:$current_page);


if(!isset($_REQUEST['perpage']))
{
    $where1=" Limit ".$perpage." Offset ".$skip."";
}

$paginations=array(
    'total'=>$totalrecords,
    'perpage'=>$perpage,
    'current'=>$current_page,
    'next'=>$current_page+1,
    'prev'=>$current_page-1 <0 ?0:$current_page-1,
    'isstart'=>$current_page==0,
    'isend'=> $skip>=$totalrecords
);



$sql = "SELECT wp_posts.ID, wp_posts.post_date, wp_postmeta.meta_key, wp_postmeta.meta_value from wp_posts
Left Join `wp_postmeta` ON (`wp_posts`.ID=`wp_postmeta`.post_id AND wp_postmeta.meta_key = '_customer_user')
WHERE post_type = 'shop_order' $where Order By wp_posts.post_date DESC $where1";
$result = $conn->query($sql);
$order = [];
$i = $skip+1;
while ($row = $result->fetch_assoc()) 
{
    $sql1  = "SELECT * FROM `wp_postmeta` WHERE `post_id`='".$row['ID']."' AND meta_key = '_order_total'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    
    $sql1c  = "SELECT *,fname.meta_value as fname,lname.meta_value as lname FROM `wp_postmeta`
    Left Join `wp_users` ON (`wp_users`.ID=`wp_postmeta`.meta_value)
    Left Join `wp_usermeta` as fname ON (fname.user_id=`wp_users`.ID AND fname.meta_value='first_name')
    Left Join `wp_usermeta` as lname ON (lname.user_id=`wp_users`.ID AND lname.meta_value='first_name')
    WHERE `post_id`='".$row['ID']."' AND wp_postmeta.meta_key = '_customer_user'";
    $result1c = $conn->query($sql1c);
    $row1c = $result1c->fetch_assoc();

    // $sqltax="Select sum(i.meta_value)as amount from wp_woocommerce_order_items o,wp_woocommerce_order_itemmeta i WHERE o.order_item_id=i.order_item_id and o.order_id='".$row['ID']."' AND o.order_item_type='line_item' and i.meta_key='_line_tax' ";
    // $resultax = $conn->query($sqltax);
    // $rowtx = $resultax->fetch_assoc();

    $order[] = array(
        'index'=>$i,
        'date_created'=> $row['post_date'],
        'id'=>$row['ID'],
        'customer'=>$row1c ? ($row1c['user_nicename'].' '.$row1c['fname'].' '.$row1c['lname']):'',
        'total' =>number_format(($row1? $row1['meta_value'] : 0),2)//+($rowtx?$rowtx['amount']:0)
    );
    $i++;
}

$resposne =array(
    'page'=>$paginations,
    'data'=>$order
);
echo json_encode($resposne);

?>