<?php
session_start();

include_once 'conn.php';

$matricule = $_POST['matricule'];
$password = $_POST['password'];
$req = "select * from " . USERS_TBL . " where matricule='$matricule' AND password='$password'";
$result = mysqli_query($conn, $req);
$num = mysqli_num_rows($result);
if ($num == 1) {
   $row = $result->fetch_assoc();
   $_SESSION["matricule"] = $matricule;
   $_SESSION["role"] =  $row['role'];
   $_SESSION["service"] = $row['service']; 
   header("location:Actualities.php");
   exit();
} else {

   header("location:login.php");
   echo "Try again.";
   exit();
}
