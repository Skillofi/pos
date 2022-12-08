<?php
require '../db.php';


if (isset($_POST['username']) && isset($_POST['password']))
{

 $user = $_POST['username'];

 $password = $_POST['password'];

if($user='pos_user' && $password=='Pos123!@#'){
    $d= array(
        'id'=>'pos_user',
        'name'=>$_POST['username']

    );
    echo json_encode($d);
} else {
    echo -1;
}

 }
else {
	echo -2;
}

?>