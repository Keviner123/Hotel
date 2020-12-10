<?php
session_start();

include_once('../DatabaseConnect.php'); 

$stmt = $conn -> prepare("SELECT * FROM guest WHERE Email = ?");
$stmt->bind_param("s", $_POST['Email']);
$stmt-> execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(crypt($_POST['Password'],$row['Salt']) == $row['Password']){
    print(TRUE);
    $_SESSION['GuestNumber'] = $row['GuestNumber'];
    $_SESSION['Email'] = $row['Email'];
} else {
    print(false);
}
?>