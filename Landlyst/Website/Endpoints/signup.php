<?php
include_once('../DatabaseConnect.php'); 

$Firstname = $_POST['Firstname'];
$Lastname = $_POST['Lastname'];
$PhoneNumber = $_POST['PhoneNumber'];
$Password = $_POST['Password'];
$Salt = $_POST['Salt'];
$Email = $_POST['Email'];



$query = "INSERT INTO guest (Firstname, Lastname, PhoneNumber, Password, Salt, Email) 
		VALUES ( '".$Firstname."', '".$Lastname."', '".$PhoneNumber."', '".$Password."', '".$Salt."', '".$Email."')";


mysqli_query($conn, $query);
print(TRUE);

?>