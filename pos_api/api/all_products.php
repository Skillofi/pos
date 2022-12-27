<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require '../db.php';
$product[] = array();
$sql_pro = "SELECT ID, post_title FROM `wp_posts` 
WHERE post_type='product' AND post_status='publish'";
$result_pro = $conn->query($sql_pro);
while($row_pro = $result_pro->fetch_assoc())
{
	
	$sql3  = "SELECT meta_value FROM `wp_postmeta` WHERE `post_id`='".$row_pro['ID']."' AND meta_key='_price'";
	$result3 = $conn->query($sql3);
	$row3 = $result3->fetch_assoc();
	
	$stockQuery  = "SELECT meta_value FROM `wp_postmeta` WHERE `post_id`='".$row_pro['ID']."' AND meta_key='_stock'";
	$stockQueryResult = $conn->query($stockQuery);
	$stocks = $stockQueryResult->fetch_assoc();
    
    if(empty($stocks['meta_value'])){
        $stocks['meta_value']=0;
        
    }
	$product[] = array(
        "id" => $row_pro['ID'],
        "name" => $row_pro['post_title'],
        "price" => $row3['meta_value'],
        "stock" =>number_format($stocks['meta_value'],2),
    );
}

echo json_encode($product);

?>