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


$user_check_query = "SELECT * FROM guest WHERE Email='$Email' LIMIT 1";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);


if ($user) {
    print(FALSE);
} else {
	$query = "INSERT INTO guest (Password, Salt, Email) 
			VALUES ( '".$Password."', '".$salt."', '".$Email."')";

	mysqli_query($conn, $query);
	print(TRUE);
}

?>