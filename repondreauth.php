<?php
include_once 'conn.php';

$id = $_GET['id'];
$rep = $_GET['rep'];
$sender = $_GET['sender']; //User matricule

if ($rep == 1) {
  $status = "accepted";
} else {
  $status = "rejected";
}

//Update user authorizationbalance
$sql = "UPDATE user SET authorizationbalance = (authorizationbalance - 2) where matricule='$sender'";
mysqli_query($conn, $sql);

$sql = "UPDATE authorization SET status='$status' where id='$id' ";
if (mysqli_query($conn, $sql)) {
  exit(header("location: respondauthorization.php"));
} else {
  echo "ERREUR";
}
