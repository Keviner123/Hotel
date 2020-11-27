<?php
include_once('../DatabaseConnect.php'); 

$Email = $_POST['Email'];
$Password = $_POST['Password'];




$sql = "SELECT * FROM `guest` WHERE `Email`= '".$_POST['Email']."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();



print_r($row["Email"]);

?>