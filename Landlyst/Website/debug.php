<?php

$servername = "localhost";
$username = "php";
$password = "G96ByQgwPe7npnfb";
$dbname = "hotels";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM room";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo $row["RoomName"];
  }
} else {
  echo "0 results";
}
$conn->close();
?>