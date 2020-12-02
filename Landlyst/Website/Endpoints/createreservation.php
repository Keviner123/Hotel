<?php
session_start();

include_once('../DatabaseConnect.php'); 

$GuestNumber = $_SESSION['GuestNumber'];

$query = "INSERT INTO `reservation` (`ReservationNumber`, `HotelNumber`, `GuestNumber`, `ArrivalDate`, `Depaturedate`) 
VALUES (NULL, '1', '".$GuestNumber."', '2020-11-10', '2020-11-11')";


$result = mysqli_query($conn, $query);

print(mysqli_insert_id($conn));
?>