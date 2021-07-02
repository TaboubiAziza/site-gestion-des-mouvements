<?php
session_start();
include_once 'conn.php';
$matricule = $_SESSION["matricule"];
$id_type_leave = $_POST['id_type_leave'];
$from = $_POST['from'];
$to = $_POST['to'];
$description = $_POST['description'];

if (!empty($_FILES['justification']['name'])) {

    $file = $_FILES['justification']['name'];
    $allowTypes = array('jpg', 'png', 'jpeg');
    $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowTypes)) {

        $path = 'imagesconge/';
        $file_name = time() . uniqid(rand()) . "." . $fileType;
        $path .= $file_name;
        $tmp = $_FILES['justification']['tmp_name'];
        move_uploaded_file($tmp, $path);
    } else {
        exit('Choose file as image');
    }

}

$insert = "INSERT INTO leavee (`from`, `to`, `description`, `justification`, `matricule`, `id_type_leave`) VALUES (?,?,?,?,?,?)";
$stmt = $conn->prepare($insert);
$stmt->bind_param("sssssi", $from, $to, $description, $file_name, $matricule, $id_type_leave);
$stmt->execute();
header('Location: leavedemandhistory.php');
$stmt->close();
$conn->close();
