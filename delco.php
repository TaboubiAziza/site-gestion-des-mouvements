<?php
include_once 'conn.php';
$id_type_leave = $_GET['id_type_leave'];
$sql = "DELETE FROM type_leave WHERE id_type_leave='$id_type_leave'";
if (mysqli_query($conn, $sql)) {
    header("location:leavetypes.php");
} else {
    echo "Erreur";
}
