<?php
session_start();

include_once('../DatabaseConnect.php'); 

$RoomNumber = $_POST['RoomNumber'];
$GuestNumber = $_SESSION['GuestNumber'];


function CheckIfUserHasReserver($RoomNumber, $GuestNumber, $conn){
    $stmt = $conn -> prepare("
    SELECT
        *
    FROM
        reservationroomlines
    INNER JOIN reservation ON reservationroomlines.ReservationNumber = reservation.ReservationNumber
    WHERE
        reservation.GuestNumber = ? AND reservationroomlines.RoomNumber = ?
    ");

    $stmt->bind_param("ss", $GuestNumber, $RoomNumber);
    $stmt-> execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return(TRUE);
    } else{
        return(FALSE);
    }
}

if(CheckIfUserHasReserver($RoomNumber, $GuestNumber, $conn)){
    $stmt = $conn->prepare("UPDATE reservationroomlines SET CheckoutDate = ? WHERE RoomNumber = ?");
    $CheckoutDate = date('Y-m-d H:i:s');
    $stmt->bind_param("ss", $CheckoutDate,$RoomNumber);
    $stmt->execute();
}
?>