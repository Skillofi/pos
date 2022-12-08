<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require '../db.php';
if(isset($_REQUEST['term']))
{
	$product[] = array();
	$where='1==2';
	if(!empty($_REQUEST['term']))
	{
	$array=explode(" ",$_REQUEST['term']);
	$where='(';
	for($i=0;$i<count($array);$i++)
	{
		if(($i+1)==count($array)){$and='';}else{$and='AND';}
		$where.="post_title Like '%".$array[$i]."%' $and ";
	}
	$where.=')';
	}
	
	$sql_pro = "SELECT ID, post_title FROM `wp_posts` 
	WHERE post_type='product' AND post_status='publish' AND $where LIMIT 500";

    $result_pro = $conn->query($sql_pro);
	while($row_pro = $result_pro->fetch_assoc())
	{
		
		$sql3  = "SELECT meta_value FROM `wp_postmeta` WHERE `post_id`='".$row_pro['ID']."' AND meta_key='_price'";
		$result3 = $conn->query($sql3);
		$row3 = $result3->fetch_assoc();
								
		$sql4  = "SELECT meta_value FROM `wp_postmeta` WHERE `post_id`='".$row_pro['ID']."' AND meta_key='_stock'";
		$result4 = $conn->query($sql4);
		$row4 = $result4->fetch_assoc();
		

		$sql4im  = "SELECT p.ID,am.meta_value FROM wp_posts p LEFT JOIN wp_postmeta pm ON pm.post_id = p.ID AND pm.meta_key = '_thumbnail_id' LEFT JOIN wp_postmeta am ON am.post_id = pm.meta_value AND am.meta_key = '_wp_attached_file' WHERE p.post_type = 'product' AND p.post_status = 'publish' AND `ID`='".$row_pro['ID']."'";
		$result4im = $conn->query($sql4im);
		$row4im = $result4im->fetch_assoc();
		
		
		if(empty($row4['meta_value'])){$row4['meta_value']=0;}
        if(empty($row3['meta_value'])){$row3['meta_value']=0;}
        
		if(empty($row4im['meta_value'])){$link='dummy.png';}
		else{$link=$row4im['meta_value'];}
		
        
        /* $select='<img src="'.$link.'" width="40"/><em style="width: 75%;white-space: nowrap;overflow:
         hidden;text-overflow: ellipsis;display: inline-grid;">'.$row_pro['post_title'].'</em> <b>'.number_format($row4['meta_value'],0).'</b>in Stock <b>$'.$row3['meta_value'].'</b> 
		 <img src="add.png" width="40"/>';
		*/
		$product[] = array(
        "id" => $row_pro['ID'],
        "thumbnail" => $link,
        "name" => $row_pro['post_title'],
        "stock" =>number_format($row4['meta_value'],2),
        "price" => $row3['meta_value']
    );
		
	}
	
	echo json_encode($product);

}
?>