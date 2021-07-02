<?php
include_once 'conn.php';
$type = $_POST['type'];
$max_nbr_day = $_POST['max_nbr_day'];
$select = "SELECT type FROM type_leave WHERE type = ? LIMIT 1";
$insert = "INSERT INTO type_leave (type, max_nbr_day) VALUES (?, ?)";
$stmt = $conn->prepare($select);
$stmt->bind_param("s", $type);
$stmt->execute();
$stmt->bind_result($type);
$stmt->store_result();
$rnum = $stmt->num_rows;
if ($rnum == 0) {
    $stmt->close();
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("si", $type, $max_nbr_day);
    $stmt->execute();
    echo "Leave added.";
    header("location:leavetypes.php");
    die();
} else {
    echo "ERREUR.";
}
$stmt->close();
$conn->close();
