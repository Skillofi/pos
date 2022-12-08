<?php
$servername = "localhost";
//$username = "georblgb_db";
//$password = "YL2-a1.p3qLY";
//$dbname = "georblgb_db";

$dbname="georblgb_live";
$username = "georblgb_live";
$password="Xbn)kdIRoPJ+";
define( 'DB_NAME', 'georblgb_live' );


$conn = new mysqli($servername, $username, $password, $dbname);
$conn1 = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
/*
$servername1 = "localhost";
$username1 = "cellizfu_db1";
$password1 = "dsLK{[(XaDId";
$dbname1 = "cellizfu_db1";

$conn1 = new mysqli($servername1, $username1, $password1, $dbname1);
if ($conn1->connect_error) 
{
    die("Connection failed: " . $conn1->connect_error);
}
*/

?>