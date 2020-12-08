<?php
session_start();

include_once('../DatabaseConnect.php'); 

$RoomNumber = $_POST['RoomNumber'];
$GuestNumber = $_SESSION['GuestNumber'];


function CheckIfUserHasReserver($RoomNumber, $GuestNumber, $conn){
    $query = "
    SELECT
        *
    FROM
        reservationroomlines
    INNER JOIN reservation ON reservationroomlines.ReservationNumber = reservation.ReservationNumber
    WHERE
        reservation.GuestNumber = '".$GuestNumber."' AND reservationroomlines.RoomNumber = '".$RoomNumber."'";
    $result = mysqli_query($conn, $query);
    
    if ($result->num_rows > 0) {
        return(TRUE);
    } else{
        return(FALSE);
    }
}

if(CheckIfUserHasReserver($RoomNumber, $GuestNumber, $conn)){
    $query = "DELETE FROM reservationroomlines WHERE RoomNumber=".$RoomNumber;
    $result = mysqli_query($conn, $query);
}
?>