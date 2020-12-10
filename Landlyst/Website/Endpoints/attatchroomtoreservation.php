<?php
session_start();

include_once('../DatabaseConnect.php'); 

$ReservationNumber = $_POST['ReservationNumber'];
$RoomNumber = $_POST['RoomNumber'];

$stmt = $conn -> prepare('INSERT INTO reservationroomlines (RoomNumber, ReservationNumber) VALUES (?,?)');
$stmt -> bind_param('ii', $RoomNumber, $ReservationNumber);
$stmt-> execute();

print(TRUE);
?>