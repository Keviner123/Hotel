<?php
session_start();

include_once('../DatabaseConnect.php'); 

$Email = $_POST['Email'];
$Password = $_POST['Password'];

$query = "SELECT * FROM `guest` WHERE `Email`= '".$Email."'";

$result = mysqli_query($conn, $query);
$row = $result->fetch_assoc();

if(crypt($Password,$row[Salt]) == $row['Password']){
    print(TRUE);
    $_SESSION['GuestNumber'] = $row['GuestNumber'];
    $_SESSION['Email'] = $row['Email'];

} else {
    print(FALSE);
}
?>