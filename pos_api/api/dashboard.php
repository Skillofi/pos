<?php
header("Access-Control-Allow-Origin: *");
require '../db.php';


$total_sale=0;
$total_cost=0;
$profit=0;
$profitper=0;
$total_inv=0;
	
$sqld = "SELECT COUNT(*) FROM `wp_posts` WHERE post_type='product' AND post_status='publish' ";
$resultd = $conn->query($sqld);		
$rowd = $resultd->fetch_assoc();

$sqld1 = "SELECT ID FROM `wp_posts` WHERE post_type='product' AND post_status='publish' ";
$resultd1 = $conn->query($sqld1);		
while($rowd1 = $resultd1->fetch_assoc())
{
    $sql21  = "SELECT * FROM `wp_postmeta` WHERE `post_id`='".$rowd1['ID']."' AND meta_key='_stock'";
    $result21 = $conn->query($sql21);
    $row21 = $result21->fetch_assoc();
    
    $sql51  = "SELECT * FROM `wp_postmeta` WHERE `post_id`='".$rowd1['ID']."' AND meta_key='_cost_price'";
    $result51 = $conn->query($sql51);
    $row51 = $result51->fetch_assoc();
    
    if(empty($row21['meta_value'])){$row21['meta_value']=0;}
    if(empty($row51['meta_value'])){$row51['meta_value']=0;}
    
    $total_inv=$total_inv+($row21['meta_value']*$row51['meta_value']);
    
}

$sql = "SELECT oi.order_item_id as order_id,wp_woocommerce_order_itemmeta.meta_value as product_id ,o.post_date as sale_date
FROM wp_posts o 
LEFT JOIN wp_woocommerce_order_items oi ON oi.order_id = o.ID
Left JOIN wp_woocommerce_order_itemmeta ON wp_woocommerce_order_itemmeta.order_item_id=oi.order_item_id AND wp_woocommerce_order_itemmeta.meta_key ='_product_id'
WHERE o.post_type = 'shop_order' AND oi.order_item_type='line_item' 
AND o.post_status='wc-approved-cs'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) 
{
    $sql2  = "SELECT * FROM `wp_woocommerce_order_itemmeta` WHERE `order_item_id`='".$row['order_id']."' AND meta_key='_qty'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    
    $sql4  = "SELECT * FROM `wp_woocommerce_order_itemmeta` WHERE `order_item_id`='".$row['order_id']."' AND meta_key='_line_total'";
    $result4 = $conn->query($sql4);
    $row4 = $result4->fetch_assoc();
    
    if(empty($row4['meta_value'])){$row4['meta_value']=0;}
    
    $total_sale=$total_sale+$row4['meta_value'];
}

$sql5  = "SELECT SUM(meta_value) as cost FROM `wp_postmeta` WHERE meta_key='_cost_price'";
$result5 = $conn->query($sql5);
$row5 = $result5->fetch_assoc();

$total_cost=$row5['cost'];

$t=100;

$profit=$total_cost-$total_sale;

if(empty($profit)){$profit=0;}

if(empty($total_cost)){$total_cost=0;}

$profit1=$profit;$total_cost1=$total_cost;

if($profit==0 && $total_cost==0){$profit1=1;$total_cost1=1;$t=0;}
if($total_sale>0)
{$profitper=($profit1/$total_cost1)*$t;}else{$profitper=0;$profit=0;}


$product[] = array(
    "profitper"=>$profitper,
    "totalProducts"=>$rowd['COUNT(*)'],
    "totalSale"=>$total_sale,
    "totalCost"=>$total_cost,
    "totalProfit"=>$profit,
    'totalInventory'=>$total_inv

);
echo json_encode($product);

?>