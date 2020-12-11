<?php
 /**
 * Gets the available rooms along with their price and attributes.
 */
session_start();
include_once('../DatabaseConnect.php'); 


/**
 * Rooms in the hotel
 */
class Room {
    public $RoomNumber;
    public $RoomName;
    public $Rate;
    public $MaxGuests;
  
    function __construct($RoomNumber, $RoomName, $Rate, $MaxGuests, $Attributes, $AttributesPrice) {
      $this->RoomNumber = $RoomNumber;
      $this->RoomName = $RoomName;
      $this->Rate = $Rate;
      $this->MaxGuests = $MaxGuests;
      $this->Attributes = $Attributes;
      $this->AttributesPrices = $AttributesPrice;
    }
}

/**
 * Booking of room 
 */
class Booking {
    public $RoomNumber;
    public $ArrivalDate;
    public $DepatureDate;
  
    function __construct($RoomNumber, $ArrivalDate, $DepatureDate) {
      $this->RoomNumber = $RoomNumber;
      $this->ArrivalDate = $ArrivalDate;
      $this->DepatureDate = $DepatureDate;
    }
}
  

$Rooms = array();
$Bookings = array();


/**
 * GetRoomAttributesPrice
 * Get the prices of attributesa on a given hotel room
 * @param  mixed $Room Room id
 * @param  mixed $SQLConnection Connection string
 */
function GetRoomAttributesPrice($Room, $SQLConnection)
{
    $stmt = $SQLConnection -> prepare("
    select
    m.RoomAttributeRate
    from
        roomattribute m
        inner join roomattributes am on m.RoomAttritubeNumber = am.RoomAttritubeNumber
        inner join room a on am.RoomNumber = a.RoomNumber
    where
        a.RoomNumber = ?
    ");

    $stmt->bind_param("s", $Room);
    $stmt-> execute();
    $result =  $stmt->get_result();

    $rows = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row['RoomAttributeRate'];
        }
    }
    return array_sum($rows);
}

/**
 * GetRoomAttributes
 * Get the room attributes for a given hotel room
 * @param  mixed $Room Room id
 * @param  mixed $SQLConnection Connection string
 */
function GetRoomAttributes($Room, $SQLConnection)
{
    $stmt = $SQLConnection -> prepare("
    SELECT
        m.RoomAttributeName 
    FROM
        roomattribute m 
        INNER JOIN
        roomattributes am 
        ON m.RoomAttritubeNumber = am.RoomAttritubeNumber 
        INNER JOIN
        room a 
        ON am.RoomNumber = a.RoomNumber 
    WHERE
        a.RoomNumber = ?
    ");

    $stmt->bind_param("s", $Room);
    $stmt-> execute();
    $result =  $stmt->get_result();

    $Attributes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($Attributes,$row['RoomAttributeName']);
        }
    }
    return($Attributes);
}

/**
 * GetRoomBookings
 * Get all the current booked rooms
 * @param  mixed $SQLConnection Connection string
 */
function GetRoomBookings($SQLConnection)
{
    $Bookings = array();

    $stmt = $SQLConnection -> prepare("
    SELECT *
    FROM reservationroomlines
    INNER JOIN reservation
    ON reservationroomlines.ReservationNumber = reservation.ReservationNumber;
    ");
    $stmt-> execute();
    $result =  $stmt->get_result();

    $Attributes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($Bookings, new Booking($row["RoomNumber"],$row["ArrivalDate"],$row["DepatureDate"]));
        }
    }
    return($Bookings);
}


/**
 * FindOverlappingRooms
 * Removes all the reservations in the database that overlaps with the dates
 * @param  mixed $Bookings List of booked rooms in the database
 * @param  mixed $ArrivalDate From date
 * @param  mixed $DepatureDate To date
 */
function FindOverlappingRooms($Bookings, $ArrivalDate, $DepatureDate)
{
    foreach ($Bookings as $Booking => $BookingContent) {
        if ((strtotime($BookingContent->ArrivalDate) <= strtotime($DepatureDate)) && 
        (strtotime($BookingContent->DepatureDate) >= strtotime($ArrivalDate))) {
        } else{
            unset($Bookings[$Booking]); 
        }
    }
    return($Bookings);
}

/**
 * FilterBookedRooms
 * Filter the available rooms away from the user
 * @param  mixed $Bookings Overlapping bookings
 * @param  mixed $Rooms Hotel rooms
 * @return void
 */
function FilterBookedRooms($Bookings, $Rooms)
{
    foreach ($Rooms as $Room => $RoomContent){
        foreach ($Bookings as $Booking => $BookingContent) {
            if($RoomContent->RoomNumber == $BookingContent->RoomNumber){
                unset($Rooms[$Room]); 
            }
        }    
    }


    $TempRooms = array();

    foreach ($Rooms as $Room){
        array_push($TempRooms, $Room);
    }

    return($TempRooms);
}


// Get all the hotel rooms where the users specified amount of guets match.
$stmt = $conn -> prepare('SELECT * FROM `room` WHERE room.MaxGuests >= ?');
$stmt->bind_param("s", $_POST["MaxGuests"]);
$stmt-> execute();
$result =  $stmt->get_result();

//If there are any matches, we go ahead and get the attributes and attribute prices on those rooms
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Attributes = (GetRoomAttributes($row['RoomNumber'], $conn));
        $AttributesPrices = (GetRoomAttributesPrice($row['RoomNumber'], $conn));
        array_push($Rooms, new Room($row['RoomNumber'], $row['RoomName'], $row['Rate'],$row['MaxGuests'], $Attributes, $AttributesPrices));
    }
}

//Get all the currently booked rooms
$Bookings = GetRoomBookings($conn);

//Find all the reservations in the database that overlaps with the users input
$Bookings = FindOverlappingRooms($Bookings, $_POST["ArrivalDate"], $_POST["Depaturedate"]);

//Match those reservations up agains the rooms, and remove the reserved rooms.
$Rooms = FilterBookedRooms($Bookings, $Rooms);

$conn->close();

echo json_encode($Rooms);