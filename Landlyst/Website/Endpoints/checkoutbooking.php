<?php
 /**
 * Check the user out of a room
 */

session_start();

include_once('../DatabaseConnect.php'); 

$RoomNumber = $_POST['RoomNumber'];
$GuestNumber = $_SESSION['GuestNumber'];


/**
 * CheckIfUserHasReserver
 *
 * @param  mixed $RoomNumber The room room number that the user wants to check out of
 * @param  mixed $GuestNumber The users id
 * @param  mixed $conn The connection string
 * @return bool Returns if the user really owns the reserved room.
 */
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