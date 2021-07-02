<?php
include_once 'conn.php';
$matricule = $_POST['matricule'];
$cin = $_POST['cin'];
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$role = $_POST['role'];
$cnsscnpsnum = $_POST['cnsscnpsnum'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$entrydate = $_POST['entrydate'];
$position = $_POST['position'];
$employment = $_POST['employment'];
$corps = $_POST['corps'];
$status = $_POST['status'];
$direction = $_POST['direction'];
$entity = $_POST['entity'];
$place = $_POST['place'];
$service = $_POST['service'];
$affiliate = $_POST['affiliate'];
$leavebalance = $_POST['leavebalance'];
$authorizationbalance = $_POST['authorizationbalance'];

$select = "SELECT matricule FROM " . USERS_TBL . " WHERE matricule = ? LIMIT 1";
$insert = "INSERT INTO " . USERS_TBL . " (matricule, cin, email, password, name, lastname, role, cnsscnpsnum, gender, birthdate, entrydate, position, employment, corps, status, direction, entity, place, service, affiliate, leavebalance, authorizationbalance ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?)";
$stmt = $conn->prepare($select);
$stmt->bind_param("s", $matricule);
$stmt->execute();
$stmt->bind_result($matricule);
$stmt->store_result();
$rnum = $stmt->num_rows;
if ($rnum == 0) {
    $stmt->close();
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("ssssssisssssssssssssii", $matricule, $cin, $email, $password, $name, $lastname, $role, $cnsscnpsnum, $gender, $birthdate, $entrydate, $position, $employment, $corps, $status, $direction, $entity, $place, $service, $affiliate, $leavebalance, $authorizationbalance);
    $stmt->execute();
    echo "User added.";
    header("Location:manageemployees.php");
    die();
} else {
    echo "This user already exists.";
}
$stmt->close();
$conn->close();
