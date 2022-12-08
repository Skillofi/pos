<?php
header("Access-Control-Allow-Origin: *");

require '../db.php';
    $_POST = $_POST['obj'];
    if($_POST['tr_body_total']>0)
	{
	
		$max=0;
		$sql_max = "SELECT MAX(ID) from wp_posts";
		$result_max = $conn->query($sql_max);
		$row_max = $result_max->fetch_assoc();
		$max=($row_max['MAX(ID)']+1);
		
		$customerid = $_POST['customer'];
		$applytax=$_POST['tax'];
		
// 		$date=$_POST['post_date'];
		$date = date('Y-m-d H:i:s');
		
	    $total=0;
		$sql = "INSERT INTO `wp_posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, 
		`ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, 
		`post_type`, `post_mime_type`, `comment_count`) VALUES ('1', '".$date."', '".$date."', '', 'Order &ndash; ".$date."', '', 
		'wc-completed', 'closed', 'closed', 'wc_order_6sxM2rgmzP5tX', 'order-jun-".$date."', '', '', '".$date."', '".$date."', '', '0', 
		'https://www.georgiaphonecase.com/?post_type=shop_order&#038;p=".$max."', '0', 'shop_order', '', '".$_POST['tr_body_total']."')";
		$conn->query($sql);
		$pid = $conn->insert_id;
		$ii=1;
		$chk=0;

		 $total_tax=0;
		 do
		 {
		 	if(isset($_POST['pid'.$ii]))
		 	{
		 		$product_id= $_POST['pid'.$ii];

		 		$proid=$pid;
		 		$conn=$conn;
				
				if($product_id==-1)
				{
					$max=0;
					$sql_max = "SELECT MAX(ID) from wp_posts";
					$result_max = $conn->query($sql_max);
					$row_max = $result_max->fetch_assoc();
					$max=($row_max['MAX(ID)']+1);
					
					$sql = "INSERT INTO `wp_posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, 
					`ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, 
					`post_type`, `post_mime_type`, `comment_count`) VALUES ('1', '".$date."', '".$date."', '', '".$_REQUEST['product_name'.$ii]."', '', 
					'publish', 'open', 'closed', '', '', '', '', '".$date."', '".$date."', '', '0', 
					'https://www.georgiaphonecase.com/?post_type=product&#038;p=".$max."', '0', 'product', '', '0')";
					$conn->query($sql);
					$product_id = $conn->insert_id;
					
					if(!empty($_REQUEST['price'.$ii]))
					{		
						$sqls4 = "INSERT INTO wp_postmeta
						(`post_id`, `meta_key`, `meta_value`)
						VALUES ('".$product_id."','_price','".$_REQUEST['price'.$ii]."')";
						$conn->query($sqls4);		
					}
					if(!empty($_REQUEST['qty'.$ii]))
					{		
						$sqls5 = "INSERT INTO wp_postmeta
						(`post_id`, `meta_key`, `meta_value`)
						VALUES ('".$product_id."','_stock','".$_REQUEST['qty'.$ii]."')";
						$conn->query($sqls5);		
					}
				}
			
			$tax=0;
			if($_POST['tax'.$ii]==1)
			{
			    $tax =($_POST['amount'.$ii]/100)*6;
			}
			
		    $sql_pro = "SELECT * FROM `wp_posts` 
	        WHERE ID='".$product_id."'";//
	        $result_pro = $conn->query($sql_pro);
	        $row_pro = $result_pro->fetch_assoc();
	        
			$sqls = "INSERT INTO wp_woocommerce_order_items
			(`order_item_name`, `order_item_type`, `order_id`)
			VALUES ('".$row_pro['post_title']."','line_item','".$proid."')";
			$conn->query($sqls);
		    $poid = $conn->insert_id;			
			
			$total=$total+$_POST['amount'.$ii];
			
			$sqls3 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			 VALUES ('".$poid."','_product_id','".$product_id."')";
			$conn->query($sqls3);
			
			$sqls4 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			 VALUES ('".$poid."','_variation_id','')";
			$conn->query($sqls4);		    

			$sqls1 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poid."','_qty','".$_POST['qty'.$ii]."')";
			$conn->query($sqls1);
			
			$sqls2 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poid."','_tax_class','')";
			$conn->query($sqls2);
			
			$sqls5 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			 VALUES ('".$poid."','_line_subtotal','".$_POST['amount'.$ii]."')";
			$conn->query($sqls5);
			
			$sqls6 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			 VALUES ('".$poid."','_line_subtotal_tax','".$tax."')";
			$conn->query($sqls6);
			
			$sqls7 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			 VALUES ('".$poid."','_line_total','".$_POST['amount'.$ii]."')";
			$conn->query($sqls7);
			
			$sqls8 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			 VALUES ('".$poid."','_line_tax','".$tax."')";
			$conn->query($sqls8);
			
			$tax_data='a:2:{s:5:"total";a:1:{i:1;s:5:"'.$tax.'";}s:8:"subtotal";a:1:{i:1;s:5:"'.$tax.'";}}';
			
			$sqls9 = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			 VALUES ('".$poid."','_line_tax_data','".$tax_data."')";
			$conn->query($sqls9);
			
			$sqlu2 = "UPDATE wp_postmeta SET meta_value=meta_value-'".$_POST['qty'.$ii]."' 
            WHERE post_id='".$product_id."' AND meta_key='_stock'";
            $conn->query($sqlu2);
			
		 	$total_tax=$total_tax+$tax;
		 	}
			
		 	$ii++;
		 }while($ii<=$_POST['tr_body_total']);
		

		if($customerid==-1)
		{
			$sql_customer = "INSERT INTO wp_users
		(`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`)
		VALUES ('".$_REQUEST['fname_cus']."','".md5($_REQUEST['fname_cus'])."','".$_REQUEST['fname_cus']."','".$_REQUEST['cus_email']."','','".date('Y-m-d')."','',0,'".$_REQUEST['fname_cus']."')";
		$conn->query($sql_customer);
		$customerid = $conn->insert_id;
		
		$sqls4 = "INSERT INTO wp_usermeta
		(`user_id`, `meta_key`, `meta_value`)
		VALUES ('".$customerid."','first_name','".$_REQUEST['fname_cus']."')";
		$conn->query($sqls4);
		
		if(!empty($_REQUEST['last_name'])  && $_POST['last_name']!='undefined' && $_POST['last_name']!='null')
		{		
			$sqls4 = "INSERT INTO wp_usermeta
			(`user_id`, `meta_key`, `meta_value`)
			VALUES ('".$customerid."','last_name','".$_REQUEST['lname_cus']."')";
			$conn->query($sqls4);		
		}
		
		if(!empty($_REQUEST['cus_phone']) && $_POST['cus_phone']!='undefined' && $_POST['cus_phone']!='null')
		{		
			$sqls4 = "INSERT INTO wp_usermeta
			(`user_id`, `meta_key`, `meta_value`)
			VALUES ('".$customerid."','billing_phone','".$_REQUEST['cus_phone']."')";
			$conn->query($sqls4);		
		}
		//billing_address_1
		if(!empty($_REQUEST['cus_address'])  && $_POST['cus_address']!='undefined' && $_POST['cus_address']!='null')
		{		
			$sqls4 = "INSERT INTO wp_usermeta
			(`user_id`, `meta_key`, `meta_value`)
			VALUES ('".$customerid."','billing_address_1','".$_REQUEST['cus_address']."')";
			$conn->query($sqls4);		
		}
//new
		if(!empty($_REQUEST['address2'])  && $_POST['address2']!='undefined' && $_POST['address2']!='null')
		{		
			$sqls4 = "INSERT INTO wp_usermeta
			(`user_id`, `meta_key`, `meta_value`)
			VALUES ('".$customerid."','billing_address_2','".$_REQUEST['address2']."')";
			$conn->query($sqls4);		
		}
		if(!empty($_REQUEST['country'])  && $_POST['country']!='undefined' && $_POST['country']!='null')
		{		
			$sqls4 = "INSERT INTO wp_usermeta
			(`user_id`, `meta_key`, `meta_value`)
			VALUES ('".$customerid."','billing_country','".$_REQUEST['country']."')";
			$conn->query($sqls4);		
		}
		if(!empty($_REQUEST['city'])  && $_POST['city']!='undefined' && $_POST['city']!='null')
		{		
			$sqls4 = "INSERT INTO wp_usermeta
			(`user_id`, `meta_key`, `meta_value`)
			VALUES ('".$customerid."','billing_city','".$_REQUEST['city']."')";
			$conn->query($sqls4);		
		}
		if(!empty($_REQUEST['state'])  && $_POST['state']!='undefined' && $_POST['state']!='null')
		{		
			$sqls4 = "INSERT INTO wp_usermeta
			(`user_id`, `meta_key`, `meta_value`)
			VALUES ('".$customerid."','billing_state','".$_REQUEST['state']."')";
			$conn->query($sqls4);		
		}
		if(!empty($_REQUEST['postcode'])  && $_POST['postcode']!='undefined' && $_POST['postcode']!='null')
		{		
			$sqls4 = "INSERT INTO wp_usermeta
			(`user_id`, `meta_key`, `meta_value`)
			VALUES ('".$customerid."','billing_postcode','".$_REQUEST['postcode']."')";
			$conn->query($sqls4);		
		}
		//echo ("customer added $customerid");
		}

		$sqlpm1 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_customer_user','".$customerid."')";
		$conn->query($sqlpm1);
		
		if(isset($_POST['fname_cus']) && $_POST['fname_cus']!='' && $_POST['fname_cus']!='undefined'  && $_POST['fname_cus']!='null')
		{
			//_billing_first_name fname_cus
			$sqlpm1 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_first_name','".$_POST['fname_cus']."')";
			$conn->query($sqlpm1);

			$sqlpm1 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_shipping_first_name','".$_POST['fname_cus']."')";
			$conn->query($sqlpm1);
		}
		if(isset($_POST['lname_cus']) && $_POST['lname_cus']!='' && $_POST['lname_cus']!='undefined' && $_POST['lname_cus']!='null')
		{
			//_billing_last_name lname_cus
			$sqlpm1 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_last_name','".$_POST['lname_cus']."')";
			$conn->query($sqlpm1);
			$sqlpm1 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_shipping_last_name','".$_POST['lname_cus']."')";
			$conn->query($sqlpm1);
		}
		if(isset($_POST['cus_email']) && $_POST['cus_email']!='' && $_POST['cus_email']!='undefined' && $_POST['cus_email']!='null')
		{
			//_billing_email cus_email
			$sqlpm1 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_email','".$_POST['cus_email']."')";
			$conn->query($sqlpm1);
		}
		if(isset($_POST['cus_phone']) && $_POST['cus_phone']!='' && $_POST['cus_phone']!='undefined'  && $_POST['cus_phone']!='null')
		{
			//_billing_phone cus_phone
			$sqlpm1 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_phone','".$_POST['cus_phone']."')";
			$conn->query($sqlpm1);
		}
		
		//billing_address_1
		if(!empty($_REQUEST['cus_address']) && $_POST['cus_address']!='undefined' && $_POST['cus_address']!='null')
		{		
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_address_1','".$_REQUEST['cus_address']."')";
			$conn->query($sqls4);
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_shipping_address_1','".$_REQUEST['cus_address']."')";
			$conn->query($sqls4);
		}

		//new
		if(!empty($_REQUEST['address2'])  && $_POST['address2']!='undefined' && $_POST['address2']!='null')
		{		
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_address_2','".$_REQUEST['address2']."')";
			$conn->query($sqls4);	
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_shipping_address_2','".$_REQUEST['address2']."')";
			$conn->query($sqls4);	
		}
		if(!empty($_REQUEST['country'])  && $_POST['country']!='undefined' && $_POST['country']!='null')
		{		
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_country','".$_REQUEST['country']."')";
			$conn->query($sqls4);	
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_shipping_country','".$_REQUEST['country']."')";
			$conn->query($sqls4);	
		}
		if(!empty($_REQUEST['city'])  && $_POST['city']!='undefined' && $_POST['city']!='null')
		{		
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_city','".$_REQUEST['city']."')";
			$conn->query($sqls4);		
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_shipping_city','".$_REQUEST['city']."')";
			$conn->query($sqls4);		
		}
		if(!empty($_REQUEST['state'])  && $_POST['state']!='undefined' && $_POST['state']!='null')
		{		
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_state','".$_REQUEST['state']."')";
			$conn->query($sqls4);	
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_shipping_state','".$_REQUEST['state']."')";
			$conn->query($sqls4);		
		}
		if(!empty($_REQUEST['postcode'])  && $_POST['postcode']!='undefined' && $_POST['postcode']!='null')
		{		
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_billing_postcode','".$_REQUEST['postcode']."')";
			$conn->query($sqls4);	
			$sqls4 = "INSERT INTO wp_postmeta (`post_id`, `meta_key`, `meta_value`) VALUES ('".$proid."','_shipping_postcode','".$_REQUEST['postcode']."')";
			$conn->query($sqls4);		
		}
		if($total_tax>0 && $proid>0)
		{
			
			$sqlst = "INSERT INTO wp_woocommerce_order_items
			(`order_item_name`, `order_item_type`, `order_id`)
			VALUES ('US-GA-VAT-1','tax','".$proid."')";
			$conn->query($sqlst);
		    $poidt = $conn->insert_id;
		    
			$sqls1t = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poidt."','label','Tax')";
			$conn->query($sqls1t);
			
			$sqls2t = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poidt."','tax_amount','".$total_tax."')";
			$conn->query($sqls2t);
		}
		$fp=0;
		if(isset($_POST['fee_type'])  && $_POST['fee_price']>0)
		{
			$fp=$_POST['fee_price'];
			$sqlpmf = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_fee_method','".$_POST['fee_type']."')";
			$conn->query($sqlpmf);
			
			$sqlpmf1 = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_fee_price','".$_POST['fee_price']."')";
			$conn->query($sqlpmf1);
			
			
			$sqlsf = "INSERT INTO wp_woocommerce_order_items
			(`order_item_name`, `order_item_type`, `order_id`)
			VALUES ('".$_POST['fee_type']."','fee','".$proid."')";
			$conn->query($sqlsf);
		    $poidf = $conn->insert_id;
		    

			$sqls1t = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poidf."','label','Tax')";
			$conn->query($sqls1t);
			
			$sqls2t = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poidf."','_line_total','".$_POST['fee_price']."')";
			$conn->query($sqls2t);
		}
		$discount=0;
		if(isset($_POST['discount_name'])  && $_POST['discount_amount']>0)
		{
			$discount=$_POST['discount_amount'];
			$sqlpmf = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_discount','".$_POST['discount_name']."')";
			$conn->query($sqlpmf);
			
			$sqlpmf1 = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_discount_amount','".$_POST['discount_amount']."')";
			$conn->query($sqlpmf1);
			
			
			$sqlsf = "INSERT INTO wp_woocommerce_order_items
			(`order_item_name`, `order_item_type`, `order_id`)
			VALUES ('".$_POST['discount_name']."','fee','".$proid."')";
			$conn->query($sqlsf);
		    $poidf = $conn->insert_id;
		    

			$sqls1t = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poidf."','label','Tax')";
			$conn->query($sqls1t);
			
			$sqls2t = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poidf."','_line_total','".$_POST['discount_anount']."')";
			$conn->query($sqls2t);
		}
		$sp=0;
		if(isset($_POST['shipping_type']) && $_POST['shipping_type']>0 && $_POST['shipping_price']>0)
		{
			$sp=$_POST['shipping_price'];
			$sqlpms = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_shipping_method','".$_POST['shipping_type']."')";
			$conn->query($sqlpms);
			
			$sqlpms1 = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_order_shipping','".$_POST['shipping_price']."')";
			$conn->query($sqlpms1);	
			
			
			
			$sqlss = "INSERT INTO wp_woocommerce_order_items
			(`order_item_name`, `order_item_type`, `order_id`)
			VALUES ('Shipping','shipping','".$proid."')";
			$conn->query($sqlss);
		    $poids = $conn->insert_id;
			
			$sqls2t = "INSERT INTO wp_woocommerce_order_itemmeta
			(`order_item_id`, `meta_key`, `meta_value`)
			VALUES ('".$poids."','cost','".$_POST['shipping_price']."')";
			$conn->query($sqls2t);
		}
		
		
		$sqlpm = "INSERT INTO wp_postmeta 
		(`post_id`, `meta_key`, `meta_value`)
		VALUES ('".$proid."','_order_total','".(($total - $discount)+$fp+$sp+$total_tax)."')";
		$conn->query($sqlpm);
		
		$sqlpm = "INSERT INTO wp_postmeta 
		(`post_id`, `meta_key`, `meta_value`)
		VALUES ('".$proid."','_order_tax','".$total_tax."')";
		$conn->query($sqlpm);
		
		if(isset($_POST['note']))
		{			
			$sqlpms1 = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_note','".$_POST['note']."')";
			$conn->query($sqlpms1);
			
			$sql_comment="INSERT INTO `wp_comments`(`comment_post_ID`,`comment_date`, `comment_date_gmt`, `comment_content`,  `comment_approved`, `comment_agent`, `comment_type`) 
			VALUES ($proid,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_POST['note']."',1,'WooCommerce','order_note')";
			$conn->query($sql_comment);
		}
		
		
		if(isset($_POST['payment_type']) && !empty($_POST['payment_type']))
		{
			if($_POST['payment_type']==1){$value="pos_cash"; $name='POS Cash';}
			if($_POST['payment_type']==2){$value="pos_card"; $name='POS Card';}
			if($_POST['payment_type']==3){$value="pos_check";$name='POS Check';}
			if($_POST['payment_type']==4){$value="zelle";$name='Zelle';}
			if($_POST['payment_type']==5){$value="cash_app";$name='Cash App';}
			if($_POST['payment_type']==6){$value="others";$name='Others';}
			$sqlpm1 = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_payment_method','".$value."')";
			$conn->query($sqlpm1);

			$sqlpm2 = "INSERT INTO wp_postmeta 
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$proid."','_payment_method_title','".$name."')";
			$conn->query($sqlpm2);
		}
		echo json_encode(array('status' => 200, 'message' => 'Order created', 'pid' => $pid));
	}else{
	    echo json_encode(array('status' => 400, 'message' => 'Something went wrong'));
	}
		
?>

