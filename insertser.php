<?php
session_start();

include_once 'conn.php';
$service = $_POST['service'];
$select = "SELECT * FROM `service` WHERE `service` = ? LIMIT 1 ";
$insert = "INSERT INTO `service`(`service`) VALUES (?)";
$stmt = $conn->prepare($select);
$stmt->bind_param("s", $service);
$stmt->execute();
$stmt->bind_result($service);
$stmt->store_result();
$rnum = $stmt->num_rows;
if ($rnum == 0) {
    $stmt->close();
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("s", $service);
    $stmt->execute();
    header("location:services.php");
    die();
} else {
    echo " ERREUR.";
}

$stmt->close();
$conn->close();
?>