<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
date_default_timezone_set('US/Eastern');
require '../db.php';

	if(!isset($_REQUEST['date_to'])){$_REQUEST['date_to']=date('Y-m-d');}	
	if(!isset($_REQUEST['date_from'])){$_REQUEST['date_from']=date('Y-m-d' ,strtotime("-1 months"));}	
	
	$query="select
	p.ID as order_id,
	comment_count as item_count,
    max( CASE WHEN pm.meta_key = '_order_total' and p.ID = pm.post_id THEN pm.meta_value END ) as order_total,
    max( CASE WHEN pm.meta_key = '_order_tax' and p.ID = pm.post_id THEN pm.meta_value END ) as order_tax,
    max( CASE WHEN pm.meta_key = '_order_shipping' and p.ID = pm.post_id THEN pm.meta_value END ) as shipping,
    max( CASE WHEN pm.meta_key = '_cart_discount' and p.ID = pm.post_id THEN pm.meta_value END ) as discount,
    max( CASE WHEN pm.meta_key = '_fee_price' and p.ID = pm.post_id THEN pm.meta_value END ) as fee,
    max( CASE WHEN pm.meta_key='_payment_method' and p.ID = pm.post_id THEN pm.meta_value END ) as payment_method,
    max( CASE WHEN pm.meta_key='_payment_method_title' and p.ID = pm.post_id THEN pm.meta_value END ) as payment_method_title
    from
    wp_posts p 
    join wp_postmeta pm on p.ID = pm.post_id
    join wp_woocommerce_order_items oi on p.ID = oi.order_id
    where post_type = 'shop_order' and date(p.post_date) >= '".$_REQUEST['date_from']."' AND date(p.post_date)<='".$_REQUEST['date_to']."'  group by p.ID";
	
	$total_sale=0;
	$items_count=0;
	$orders_count=0;
	$order_total=0;
	$total_tax=0;
	$total_shipping=0;
	$total_discount=0;
	$total_fee=0;
	$result = $conn->query($query);	

	$pos_card=0;
	$pos_cash=0;
	$pos_check=0;
	$paypal=0;
	$creditcard=0;
	$others=0;
	$zelle = 0;
	$cash_app = 0;
	

	while($row = $result->fetch_assoc())
	{
		$orders_count++;
		$items_count += $row['item_count'];
		$order_total += $row['order_total'];
		$total_tax += $row['order_tax'];
		$total_shipping += $row['shipping'];
		$total_discount += $row['discount'];
		$total_fee += $row['fee'];

		$total_sale = $order_total - $total_tax-$total_shipping-$total_fee+$total_discount;
		$method=$row['payment_method'];
		if( $method == 'pos_cash')
			$pos_cash += $row['order_total'];
		else if( $method =='poscash')
		    $pos_cash += $row['order_total'];
		else if( $method == 'pos_card')
			$pos_card += $row['order_total'];
		elseif($method =='poscard')
		    $pos_card += $row['order_total'];
		else if( $method == 'pos_check' || $method =='cheque' || $method =='poscheck')
			$pos_check += $row['order_total'];
		else if( $method == 'paypal' || $method =='eh_paypal_express')
			$paypal += $row['order_total'];
		else if( $method == 'braintree_credit_card')
			$creditcard += $row['order_total'];
		else if( $method == 'zelle')
			$zelle += $row['order_total'];
		else if( $method== "bacs")
		    $zelle += $row['order_total'];
		else if( $method == 'cash_app')
			$cash_app += $row['order_total'];
		elseif($method == 'cod')
		    $cash_app += $row['order_total'];
		else
			$others += $row['order_total'];
	}
	
	
    $sql_rf = "SELECT SUM(meta.meta_value) AS total_refund FROM wp_posts AS posts
    LEFT JOIN wp_postmeta AS meta ON posts.ID = meta.post_id
    WHERE meta.meta_key = '_order_total'
    AND posts.post_type = 'shop_order_refund' AND date(post_date) >= '".$_REQUEST['date_from']."' AND date(post_date)<='".$_REQUEST['date_to']."'";
	$result_rf = $conn->query($sql_rf);	
	$row_rf = $result_rf->fetch_assoc();
	
	$cr = array( 
		'q'=>$query,
		"orders_count"=>$orders_count,
		"items_count"=>$items_count,
		"total_sale"=>$total_sale,
		"order_total"=>$order_total,
		"total_tax"=>$total_tax,
		"total_shipping"=>$total_shipping,
		"total_discount"=>$total_discount,
		"total_fee"=>$total_fee,
		"total_refund"=>$row_rf['total_refund'],
		'pos_card'=>$pos_card,
		'pos_cash'=>$pos_cash,
		'pos_check'=>$pos_check,
		'paypal'=>$paypal,
		'creditcard'=>$creditcard,
		'zelle' => $zelle,
        'cash_app' => $cash_app,
		'others'=>$others
	);

	

	echo json_encode($cr);
?>