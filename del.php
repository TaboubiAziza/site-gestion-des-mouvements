<?php
include_once 'conn.php';

$matricule=$_GET['matricule'];
$sql="DELETE FROM " . USERS_TBL . " WHERE matricule='$matricule'";
if(mysqli_query($conn,$sql)){
    header("location:manageemployees.php");
}else {
    echo "Erreur";
}
