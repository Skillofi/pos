<?php
header("Access-Control-Allow-Origin: *");

require '../db.php';
if(isset($_REQUEST['id'])){
$sql4  = "SELECT * FROM `setting` where id=1";
$result4 = $conn->query($sql4);
$row4 = $result4->fetch_assoc();

$title = "Email: ".$row4['email']."
".$row4['address']."
Tel: ".$row4['tel']."
Fax: ".$row4['fax']."";


$sql = "SELECT ID,post_date,time(post_date) as time from wp_posts
Left Join `wp_postmeta` ON (`wp_posts`.ID=`wp_postmeta`.post_id AND wp_postmeta.meta_key = '_customer_user')
WHERE ID = '".$_REQUEST['id']."'";
$result = $conn->query($sql);
$result = $result->fetch_assoc();

$sql_note = "SELECT * from `wp_postmeta`
WHERE post_id = '".$_REQUEST['id']."' AND meta_key='_note'";
$result_note = $conn->query($sql_note);
$result_note = $result_note->fetch_assoc();

$sql1c  = "SELECT wp_users.user_email as email,
	fname.meta_value as first_name,
	lname.meta_value as last_name,
	address.meta_value as address,
	address2.meta_value as address2, 
	phone.meta_value as phone,
	city.meta_value as city, 
	code.meta_value as postcode , 
	country.meta_value as country,
	state.meta_value as state
	FROM `wp_postmeta`
Left Join `wp_users` ON (`wp_users`.ID=`wp_postmeta`.meta_value)
Left Join `wp_usermeta` as fname ON (fname.user_id=`wp_users`.ID AND fname.meta_value='first_name')
Left Join `wp_usermeta` as lname ON (lname.user_id=`wp_users`.ID AND lname.meta_value='first_name')
Left Join `wp_usermeta` as address ON (address.user_id=`wp_users`.ID AND address.meta_value='billing_address_1')
Left Join `wp_usermeta` as address2 ON (address2.user_id=`wp_users`.ID AND address2.meta_value='billing_address_2')
Left Join `wp_usermeta` as country ON (country.user_id=`wp_users`.ID AND country.meta_value='billing_country')
Left Join `wp_usermeta` as city ON (city.user_id=`wp_users`.ID AND city.meta_value='billing_city')
Left Join `wp_usermeta` as state ON (state.user_id=`wp_users`.ID AND state.meta_value='billing_state')
Left Join `wp_usermeta` as code ON (code.user_id=`wp_users`.ID AND code.meta_value='billing_postcode')
Left Join `wp_usermeta` as phone ON (code.user_id=`wp_users`.ID AND phone.meta_value='billing_phone')
WHERE `post_id`='".$_REQUEST['id']."' AND wp_postmeta.meta_key = '_customer_user'";

$result1c = $conn->query($sql1c);
$row1c = $result1c->fetch_assoc();

$total_tax=0;

$subtotal=0;
$i=0;    
$sql1 = "Select order_item_id,order_item_name from wp_woocommerce_order_items 
WHERE order_id='".$_REQUEST['id']."' AND order_item_type='line_item'";
$result1 = $conn->query($sql1);
$line_items = array();
while($row1 = $result1->fetch_assoc())
{
	$sql_qty = "Select meta_value from wp_woocommerce_order_itemmeta
	WHERE order_item_id = '".$row1['order_item_id']."' AND meta_key='_qty'";
	$result_qty = $conn->query($sql_qty);
	$result_qty = $result_qty->fetch_assoc();
	
	$sql_price = "Select meta_value from wp_woocommerce_order_itemmeta
	WHERE order_item_id = '".$row1['order_item_id']."' AND meta_key='_line_total'";
	$result_price = $conn->query($sql_price);
	$result_price = $result_price->fetch_assoc();
	
	$sql_tax = "Select meta_value from wp_woocommerce_order_itemmeta
	WHERE order_item_id = '".$row1['order_item_id']."' AND meta_key='_line_tax'";
	$result_tax = $conn->query($sql_tax);
	$result_tax = $result_tax->fetch_assoc();
	
	$i++;
	$line_items[]=array(
		'sno'=>$i,
		'name'=>$row1?$row1['order_item_name']:'',
		'quantity'=>$result_qty?$result_qty['meta_value']:0,
		'price'=>$result_price?number_format(($result_price['meta_value']/$result_qty['meta_value']),2):0,
		'subtotal_tax'=>$result_tax?number_format(($result_tax['meta_value']),2):0,
		'subtotal'=>$result_price?number_format($result_price['meta_value'],2):0
	);
	$total_tax=$total_tax+($result_tax?$result_tax['meta_value']:0);
	$subtotal = $subtotal + ($result_price?$result_price['meta_value']:0);
}




$sql_fee = "SELECT * from `wp_postmeta`
WHERE post_id = '".$_REQUEST['id']."' AND meta_key='_fee_price'";
$result_fee = $conn->query($sql_fee);
$result_fee = $result_fee->fetch_assoc();

$sql_discount = "SELECT * from `wp_postmeta`
WHERE post_id = '".$_REQUEST['id']."' AND meta_key='_discount_amount'";
$result_discount = $conn->query($sql_discount);
$result_discount = $result_discount->fetch_assoc();


$sql_shipping = "SELECT * from `wp_postmeta`
WHERE post_id = '".$_REQUEST['id']."' AND meta_key='_order_shipping'";
$result_shipping = $conn->query($sql_shipping);
$result_shipping = $result_shipping->fetch_assoc();

$fee =$result_fee? $result_fee['meta_value']  : 0 ;
$discount = $result_discount? $result_discount['meta_value']  : 0 ;
$shipping = $result_shipping ? $result_shipping['meta_value'] : 0 ;
$q="SELECT  
	mailmeta.meta_value as email,
	firstmeta.meta_value as first_name, 
	lastmeta.meta_value as last_name , 
	addmeta.meta_value as address,
	add2meta.meta_value as address2, 
	phmeta.meta_value as phone,
	citymeta.meta_value as city, 
	pcodemeta.meta_value as postcode , 
	cntrymeta.meta_value as country,
	statemeta.meta_value as state,
	paymentmeta.meta_value as paymentmethod
		FROM wp_posts 
	left join wp_postmeta as firstmeta on wp_posts.ID = firstmeta.post_id and firstmeta.meta_key = '_shipping_first_name' 
	left join wp_postmeta as lastmeta on wp_posts.ID = lastmeta.post_id and lastmeta.meta_key = '_shipping_last_name'
	left join wp_postmeta as phmeta on wp_posts.ID = phmeta.post_id and phmeta.meta_key = '_billing_phone'
	left join wp_postmeta as addmeta on wp_posts.ID = addmeta.post_id and addmeta.meta_key = '_shipping_address_1'
	left join wp_postmeta as add2meta on wp_posts.ID = add2meta.post_id and add2meta.meta_key = '_shipping_address_2'
	left join wp_postmeta as citymeta on wp_posts.ID = citymeta.post_id and citymeta.meta_key = '_shipping_city'
	left join wp_postmeta as pcodemeta on wp_posts.ID = pcodemeta.post_id and pcodemeta.meta_key = '_shipping_postcode'
	left join wp_postmeta as cntrymeta on wp_posts.ID = cntrymeta.post_id and cntrymeta.meta_key = '_shipping_country'
	left join wp_postmeta as statemeta on wp_posts.ID = statemeta.post_id and statemeta.meta_key = '_shipping_state' 
	left join wp_postmeta as paymentmeta on wp_posts.ID = paymentmeta.post_id and paymentmeta.meta_key = '_payment_method_title' 
	left join wp_postmeta as mailmeta on wp_posts.ID = mailmeta.post_id and mailmeta.meta_key = '_billing_phone' where wp_posts.id='".$_REQUEST['id']."'
	";
	

$result_add = $conn->query($q);
$result_add = $result_add->fetch_assoc();

$email = $result_add? ($result_add['email']? $result_add['email'] : ($row1c? $row1c['email'] : '')) : '' ;
$fname = $result_add? ($result_add['first_name']? $result_add['first_name'] : ($row1c? $row1c['first_name'] : '')) : '';
$lname = $result_add? ($result_add['last_name']? $result_add['last_name'] : ($row1c? $row1c['last_name'] : '')) : '';
$add1 = $result_add? ($result_add['address']? $result_add['address'] : ($row1c? $row1c['address'] : '')) : '';
$add2 = $result_add? ($result_add['address2']? $result_add['address2'] : ($row1c? $row1c['address2'] : '')) : '';
$country = $result_add? ($result_add['country']? $result_add['country'] : ($row1c? $row1c['country'] : '')) : '';
$city = $result_add? ($result_add['city']? $result_add['city'] : ($row1c? $row1c['city'] : '')) : '';
$state = $result_add? ($result_add['state']? $result_add['state'] : ($row1c? $row1c['state'] : '')) : '';
$zip = $result_add? ($result_add['postcode']? $result_add['postcode'] : ($row1c? $row1c['postcode'] : '')) : '';
$phone = $result_add? ($result_add['phone']? $result_add['phone'] : ($row1c? $row1c['phone'] : '')) : '';
$paymentmethod = $result_add? $result_add['paymentmethod'] : '';

$emai = $email?$email:'';
$fname = $fname?$fname:'';
$lname = $lname?$lname:'';
$add1 = $add1?$add1:'';
$add2 = $add2?$add2:'';
$country = $country?$country:'';
$city = $city?$city:'';
$state = $state?$state:'';
$zip = $zip?$zip:'';
$phone = $phone?$phone:'';


$display_name = $email.' '.$fname . ' ' . $lname;
if(trim($display_name)=='')
 $display_name='Default';

$invoice=array(
	'email'=>$row4['email'],
	'address'=>$row4['address'],
	'tele'=>$row4['tel'],
	'fax'=>$row4['fax'],
	'term'=>$row4['terms'],
	'id'=>$result['ID'],
	'date'=>$result['post_date'],
	'time'=>$result['time'],
	'customer'=>$display_name,
	'c_address'=>$add1,
	'c_address2'=>$add2,
	'country'=>$country,
	'city'=>$city,
	'state'=>$state,
	'postcode'=>$zip,
	'phone'=>$phone,
	'note'=>$result_note?$result_note['meta_value']:'',
	'line_items'=>$line_items,
	'shipping'=>number_format($shipping,2),
	'fee'=>number_format($fee,2),
	'discount' => number_format($discount, 2),
	'total_tax'=>number_format($total_tax,2),
	'subtotal'=> number_format($subtotal,2),
	'gtotal' => number_format(($subtotal - $discount) + $shipping + $fee+$total_tax,2),
	'paymentmethod'=> $paymentmethod
);
echo(json_encode($invoice));
}
else {
	echo 'No id set';
}
?>

