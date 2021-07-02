<?php
session_start();

include_once 'conn.php';
$name = $_POST['name'];
$date = $_POST['date'];
$mat = $_SESSION['matricule'];
$select = "SELECT date FROM holiday WHERE date = ? LIMIT 1 ";
$insert = "INSERT INTO holiday(name, date, matricule) VALUES (?, ?, ?)";
$stmt = $conn->prepare($select);
$stmt->bind_param("s", $date);
$stmt->execute();
$stmt->bind_result($date);
$stmt->store_result();
$rnum = $stmt->num_rows;
if ($rnum == 0) {
    $stmt->close();
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("sss", $name, $date, $mat);
    $stmt->execute();
    echo "Holiday added.";
    header("location:calendar.php");
    die();
} else {
    echo " ERREUR.";
}

$stmt->close();
$conn->close();
?>