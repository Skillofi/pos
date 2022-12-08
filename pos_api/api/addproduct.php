<?php

require '../db.php';
if(isset($_REQUEST['add_product']))
{
	if(!empty($_REQUEST['title']))
	{
		$max=0;
		$sql_max = "SELECT MAX(ID) from wp_posts";
		$result_max = $conn->query($sql_max);
		$row_max = $result_max->fetch_assoc();
		$max=($row_max['MAX(ID)']+1);
		
	    $total=0;
		$sql = "INSERT INTO `wp_posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, 
		`ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, 
		`post_type`, `post_mime_type`, `comment_count`) VALUES ('1', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', '', '".$_REQUEST['title']."', '', 
		'pos_publish', 'open', 'closed', '', '', '', '', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', '', '0', 
		'https://www.georgiaphonecase.com/?post_type=shop_order&#038;p=".$max."', '0', 'product', '', '0')";
		$conn->query($sql);
		$pid = $conn->insert_id;
		
		if(!empty($_REQUEST['price']))
		{		
			$sqls4 = "INSERT INTO wp_postmeta
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$pid."','_price','".$_REQUEST['price']."')";
			$conn->query($sqls4);		
		}
		if(!empty($_REQUEST['qty']))
		{		
			$sqls5 = "INSERT INTO wp_postmeta
			(`post_id`, `meta_key`, `meta_value`)
			VALUES ('".$pid."','_stock','".$_REQUEST['qty']."')";
			$conn->query($sqls5);		
		}
		echo $pid;
	}
}
?>