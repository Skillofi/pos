 <?php $i=1;
						$sqlda="SELECT post_title, COUNT(*) as Qty FROM wp_posts o 
						LEFT JOIN wp_woocommerce_order_items oi ON oi.order_id = o.ID
						Left JOIN wp_woocommerce_order_itemmeta ON wp_woocommerce_order_itemmeta.order_item_id=oi.order_item_id 
						AND wp_woocommerce_order_itemmeta.meta_key='_product_id'
						WHERE o.post_type = 'shop_order' AND oi.order_item_type='line_item' AND o.post_status='wc-approved-cs'  GROUP BY meta_value 
						ORDER BY 2 DESC LIMIT 20";
                        $resultda = $conn->query($sqlda);
                        
						$product = $resultda->fetch_assoc(); 
						 
echo json_encode($product);
						?>