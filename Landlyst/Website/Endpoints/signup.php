<?php
include_once('../DatabaseConnect.php'); 

function random_alphanumeric_string($length) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($chars), 0, $length);
}

$Password = $_POST['Password'];
$Email = $_POST['Email'];

$salt = random_alphanumeric_string(10);
$Password = crypt($Password,$salt);

$stmt = $conn -> prepare("SELECT * FROM guest WHERE Email=? LIMIT 1");

$stmt->bind_param("s", $Email);
$stmt-> execute();

$result =  $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    print(FALSE);
} else {
	$stmt = $conn -> prepare('INSERT INTO guest (Password, Salt, Email) VALUES (?,?,?)');
	$stmt->bind_param("sss", $Password, $salt, $Email);
	$stmt-> execute();
	print(TRUE);
}

?>