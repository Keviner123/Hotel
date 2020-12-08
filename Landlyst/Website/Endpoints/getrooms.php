<?php
session_start();

include_once('../DatabaseConnect.php'); 


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



function GetRoomAttributesPrice($Room, $SQLConnection){
    $sql = "select
    m.RoomAttributeRate
from
    roomattribute m
    inner join roomattributes am on m.RoomAttritubeNumber = am.RoomAttritubeNumber
    inner join room a on am.RoomNumber = a.RoomNumber
where
    a.RoomNumber = ".$Room;
    $result = $SQLConnection->query($sql);
    $rows = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row['RoomAttributeRate'];
        }
    }
    return array_sum($rows);
}

function GetRoomAttributes($Room, $SQLConnection)
    {
        $sql =
            "
            select
                m.RoomAttributeName
            from
                roomattribute m
                inner join roomattributes am on m.RoomAttritubeNumber = am.RoomAttritubeNumber
                inner join room a on am.RoomNumber = a.RoomNumber
            where
                a.RoomNumber = " . $Room;
        $result = $SQLConnection->query($sql);
        $Attributes = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($Attributes,$row['RoomAttributeName']);
            }
        }
        return($Attributes);
    }



function GetRoomBookings($SQLConnection)
{
    $Bookings = array();

    $sql = "
    SELECT *
    FROM reservationroomlines
    INNER JOIN reservation
    ON reservationroomlines.ReservationNumber = reservation.ReservationNumber;
    ";
    $result = $SQLConnection->query($sql);
    $Attributes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($Bookings, new Booking($row["RoomNumber"],$row["ArrivalDate"],$row["DepatureDate"]));
        }
    }
    return($Bookings);
}

function GetBookedRooms($Bookings, $ArrivalDate, $DepatureDate){
    foreach ($Bookings as $Booking => $BookingContent) {
        if ((strtotime($BookingContent->ArrivalDate) <= strtotime($DepatureDate)) && 
        (strtotime($BookingContent->DepatureDate) >= strtotime($ArrivalDate))) {
        } else{
            unset($Bookings[$Booking]); 
        }
    }
    return($Bookings);
}

function FilterBookedRooms($Bookings, $Rooms){

    
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
    // return($Rooms);
}

$sql = 'SELECT * FROM `room` WHERE room.MaxGuests >= '.$_POST["MaxGuests"];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Attributes = (GetRoomAttributes($row['RoomNumber'], $conn));
        $AttributesPrices = (GetRoomAttributesPrice($row['RoomNumber'], $conn));
        array_push($Rooms, new Room($row['RoomNumber'], $row['RoomName'], $row['Rate'],$row['MaxGuests'], $Attributes, $AttributesPrices));
    }
}




$Bookings = GetRoomBookings($conn);
$Bookings = GetBookedRooms($Bookings, $_POST["ArrivalDate"], $_POST["Depaturedate"]);
$Rooms = FilterBookedRooms($Bookings, $Rooms);

$conn->close();

echo json_encode($Rooms);
