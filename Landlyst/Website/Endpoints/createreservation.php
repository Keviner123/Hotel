<?php
 /**
 * Create a reservation with a given arrival date and depature date.
 */
session_start();

include_once('../DatabaseConnect.php'); 

$GuestNumber = $_SESSION['GuestNumber'];
$ArrivalDate = $_POST['ArrivalDate'];
$Depaturedate = $_POST['Depaturedate'];


$query = "INSERT INTO `reservation` (`ReservationNumber`, `HotelNumber`, `GuestNumber`, `ArrivalDate`, `Depaturedate`) 
VALUES (NULL, '1', '".$GuestNumber."', '".$ArrivalDate."', '".$Depaturedate."')";


$result = mysqli_query($conn, $query);

print(mysqli_insert_id($conn));
?>