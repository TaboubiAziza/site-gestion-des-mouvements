<?php
include_once 'conn.php';
$service = $_GET['service'];
$sql = "DELETE FROM `service` WHERE `service`='$service'";
if (mysqli_query($conn, $sql)) {
    header("location:services.php");
} else {
    echo "Erreur";
}
?>