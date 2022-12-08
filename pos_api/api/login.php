<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require '../db.php';
require 'phppass.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    // // wordpress' username that his password going to compare
    $user = $_POST['username'];
    $user_name = htmlspecialchars($user, ENT_QUOTES);
    // // plain password to compare
    $password = $_POST['password'];
    $hasher = new PasswordHash(8, TRUE);
    // get user_name's hashed password from wordpress database
    $queryx = "select id, user_pass, display_name from wp_users where user_login='$user_name'"; //user_pass
    $result4 = $conn->query($queryx);
    $row4 = $result4->fetch_assoc();
    $passnya = $row4 ? $row4['user_pass'] : '';
    // compare plain password with hashed password
    if ($hasher->CheckPassword($password, $passnya)) {
        $data = array(
            'status' => 200,
            'id' => $row4['id'], 
            'name' => $_POST['username'],
            'display_name' => $row4['display_name'],
        );
        echo json_encode($data);
    } else {
        echo json_encode(array('status' => 404));
    }
} else {
    echo json_encode(array('status' => 400));
}
?>