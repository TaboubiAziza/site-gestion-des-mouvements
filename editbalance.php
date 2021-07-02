<?php

include_once 'conn.php';
$matricule = $_POST['matricule'];
$leavebalance = $_POST['leavebalance'];
$authorizationbalance = $_POST['authorizationbalance'];
$sql = "UPDATE user SET leavebalance='$leavebalance', authorizationbalance='$authorizationbalance' where matricule=$matricule";
if (mysqli_query($conn, $sql)) {
  exit(header("location: balances.php"));
} else {
  echo "ERREUR";
} 

?>