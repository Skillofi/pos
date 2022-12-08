<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require '../db.php';
if(isset($_REQUEST['customer']))
{
	$customer=array();
	$sql_pro = "SELECT DISTINCT ID, user_email FROM `wp_users` 
	Left JOIN `wp_usermeta` ON (wp_usermeta.user_id=wp_users.ID) 
	where ID='".$_REQUEST['customer']."'";
	$result_pro = $conn->query($sql_pro);
	$row_pro = $result_pro->fetch_assoc();
	
	$sql3  = "SELECT * FROM `wp_usermeta` WHERE `user_id`='".$row_pro['ID']."' AND meta_key='first_name'";
	$result3 = $conn->query($sql3);
	$row3 = $result3->fetch_assoc();
								
	$sql4  = "SELECT * FROM `wp_usermeta` WHERE `user_id`='".$row_pro['ID']."' AND meta_key='last_name'";
	$result4 = $conn->query($sql4);
	$row4 = $result4->fetch_assoc();
	
	$customer['fname']=$row3['meta_value'];
	$customer['lname']=$row4['meta_value'];
	$customer['email']=$row_pro['user_email'];
	
	echo json_encode($customer);	
}
else if (isset($_REQUEST['term']))
{
	$customers=array();
	$term=$_REQUEST['term'];
	$q="SELECT wp_users.ID, wp_users.user_email, 
	firstmeta.meta_value as first_name, 
	lastmeta.meta_value as last_name , 
	addmeta.meta_value as address,
	phmeta.meta_value as phone,
	add2meta.meta_value as address2, 
	citymeta.meta_value as city, 
	pcodemeta.meta_value as postcode , 
	cntrymeta.meta_value as country,
	statemeta.meta_value as state
	
	FROM wp_users left join wp_usermeta as firstmeta on wp_users.ID = firstmeta.user_id and firstmeta.meta_key = 'first_name' 
	left join wp_usermeta as lastmeta on wp_users.ID = lastmeta.user_id and lastmeta.meta_key = 'last_name'
	left join wp_usermeta as phmeta on wp_users.ID = phmeta.user_id and phmeta.meta_key = 'billing_phone'
	left join wp_usermeta as addmeta on wp_users.ID = addmeta.user_id and addmeta.meta_key = 'billing_address_1'

	left join wp_usermeta as add2meta on wp_users.ID = add2meta.user_id and add2meta.meta_key = 'billing_address_2'
	left join wp_usermeta as citymeta on wp_users.ID = citymeta.user_id and citymeta.meta_key = 'billing_city'
	left join wp_usermeta as pcodemeta on wp_users.ID = pcodemeta.user_id and pcodemeta.meta_key = 'billing_postcode'
	left join wp_usermeta as cntrymeta on wp_users.ID = cntrymeta.user_id and cntrymeta.meta_key = 'billing_country'
	left join wp_usermeta as statemeta on wp_users.ID = statemeta.user_id and statemeta.meta_key = 'billing_state'
	
	 where wp_users.user_email LIKE '%".$term."%' or firstmeta.meta_value LIKE '%".$term."%' or lastmeta.meta_value LIKE '%".$term."%' ";
	$result_proc = $conn->query($q);
	$i=0;
	while($row_proc = $result_proc->fetch_assoc())
	{
		$cr = array( 
			"id" => $row_proc['ID'], 
			"first_name" => $row_proc['first_name'], 
			"last_name" => $row_proc['last_name'], 
			"user_email"=>$row_proc['user_email'],
			"address"=>$row_proc['address'],
			"phone"=>$row_proc['phone'],
			"address2" => $row_proc['address2'], 
			"city" => $row_proc['city'], 
			"postcode"=>$row_proc['postcode'],
			"country"=>$row_proc['country'],
			"state"=>$row_proc['state']
		);
		$customers[$i]=$cr;
				$i++;
	}
	echo json_encode($customers);
}
else
{
	$customers[] = array();
	$sql_pro = "SELECT wp_users.ID, wp_users.user_email, firstmeta.meta_value as first_name, lastmeta.meta_value as last_name , addmeta.meta_value as address,phmeta.meta_value as phone
	FROM wp_users left join wp_usermeta as firstmeta on wp_users.ID = firstmeta.user_id and firstmeta.meta_key = 'first_name' 
	left join wp_usermeta as lastmeta on wp_users.ID = lastmeta.user_id and lastmeta.meta_key = 'last_name'
	left join wp_usermeta as phmeta on wp_users.ID = phmeta.user_id and phmeta.meta_key = 'billing_phone'
	left join wp_usermeta as addmeta on wp_users.ID = addmeta.user_id and addmeta.meta_key = 'billing_address_1'";
	$result_pro = $conn->query($sql_pro);
	$i=0;
	while($row_pro = $result_pro->fetch_assoc())
	{
		$cr = array( 
			"id" => $row_proc['ID'], 
			"first_name" => $row_proc['first_name'], 
			"last_name" => $row_proc['last_name'], 
			"user_email"=>$row_proc['user_email'],
			"address"=>$row_proc['address']
		);
		$customers[$i]=$cr;
				$i++;

	}	
	echo json_encode($customers);
}
?>