<?php
include_once 'conn.php';
$id_holiday = $_GET['id_holiday'];
$sql = "DELETE FROM holiday WHERE id_holiday='$id_holiday'";
if (mysqli_query($conn, $sql)) {
    header("location:calendar.php");
} else {
    echo "Erreur";
}
?>