<?php
include_once 'conn.php';
$id=$_GET['id'];
$req = "SELECT status FROM authorization WHERE id=$id";
$myquery = mysqli_query($conn, $req);
$row = mysqli_fetch_array($myquery);
$status = $row['status'];

if($status=="ongoing"){
$sql="DELETE FROM authorization WHERE id='$id'";
if(mysqli_query($conn,$sql)){
    header("location:authorizationdemandhistory.php");
}else {
    header("location:authorizationdemandhistory.php");
} 
}else{
    header("location:authorizationdemandhistory.php");
}
?>