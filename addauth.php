<?php
session_start();
include_once 'conn.php';
$matricule = $_SESSION['matricule'];
$from = $_POST['from'];
$to = $_POST['to'];
$description = $_POST['description'];

$insert = "INSERT INTO `authorization`( `from`, `to`, `description`, `matricule`) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($insert); 
    $stmt->bind_param("ssss",  $from, $to, $description, $matricule);
    $stmt->execute();
    header("location:authorizationdemandhistory.php");
    die();

$stmt->close();
$conn->close();
