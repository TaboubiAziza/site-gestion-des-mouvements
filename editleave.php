<?php
include_once 'conn.php';
$type = $_POST['type'];
$max_nbr_day = $_POST['max_nbr_day'];
$id_type_leave = $_POST['id_type_leave'];

$update = "UPDATE type_leave SET type=?, max_nbr_day=?  WHERE id_type_leave=?";
$stmt = $conn->prepare($update);
$stmt->bind_param("sii", $type, $max_nbr_day, $id_type_leave);
$stmt->execute();
echo "User updated.";
header("Location:leavetypes.php");
$stmt->close();
$conn->close();
