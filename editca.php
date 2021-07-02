<?php
include_once 'conn.php';
$name = $_POST['name'];
$date = $_POST['date'];
$id_holiday = $_POST['id_holiday'];
$update = "UPDATE holiday SET name=?, date=?  WHERE id_holiday=?";
$stmt = $conn->prepare($update);
$stmt->bind_param("ssi", $name, $date, $id_holiday);
$stmt->execute();
echo "Calendar updated.";
header("Location: calendar.php");
$stmt->close();
$conn->close();
?>