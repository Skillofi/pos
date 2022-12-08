<?php
header("Access-Control-Allow-Origin: *");
require '../db.php';

// Get the posted data.
// $postdata = file_get_contents("php://input");
if(isset($_POST['terms']))
{
  // Extract the data.
//   $request = json_decode($postdata);
  
  $sqlu1 = "UPDATE setting SET terms='".$_POST['terms']."',email='".$_POST['email']."',address='".$_POST['address']."',tel='".$_POST['tel']."'
  ,fax='".$_POST['fax']."' where id = 1";

  $conn->query($sqlu1);
echo true;
}
else
{
	$sql4  = "SELECT * FROM `setting` where id=1";
	$result4 = $conn->query($sql4);
	$row4 = $result4->fetch_assoc();
	echo json_encode($row4);
					}
?>