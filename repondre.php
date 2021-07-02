<?php
include_once 'conn.php';
$id = $_GET['id'];
$rep = $_GET['rep'];
$sender = $_GET['sender']; //User matricule
$diff_days = $_GET['diff'];

if ($rep == 1) {
  $status = "accepted";
} else {
  $status = "rejected";
}

//Update user leavebalance
$sql = "UPDATE user SET leavebalance = (leavebalance - $diff_days ) where matricule='$sender'";
mysqli_query($conn, $sql);

$sql = "UPDATE leavee SET status='$status' where id=$id";
if (mysqli_query($conn, $sql)) {
  exit(header("location: respondleaves.php"));
} else {
  echo "ERREUR";
}
