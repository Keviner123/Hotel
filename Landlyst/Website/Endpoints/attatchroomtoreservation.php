<?php
session_start();

include_once('../DatabaseConnect.php'); 

$ReservationNumber = $_POST['ReservationNumber'];
$RoomNumber = $_POST['RoomNumber'];


$query = "INSERT INTO `reservationroomlines` (`RoomNumber`, `ReservationNumber`) 
VALUES ($RoomNumber, $ReservationNumber)";


$result = mysqli_query($conn, $query);

print(TRUE);
?>