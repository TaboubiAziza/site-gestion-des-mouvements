<?php
include_once 'conn.php';
$service = $_POST['service'];
$update = "UPDATE `service` SET `service`=?  WHERE `service`=?";
$stmt = $conn->prepare($update);
$stmt->bind_param("ss", $service, $service);
$stmt->execute();
echo "Service updated.";
header("Location: services.php");
$stmt->close();
$conn->close();
?>