<?php
include 'config.php';
$id = clear($_POST['id']);
$fname = clear($_POST['fname']);
$lname = clear($_POST['lname']);
$Email = clear($_POST['Email']);
$password = clear($_POST['password']);
$role = clear($_POST['role']);
$status = clear($_POST['status']);

$update_query = mysqli_query($db , "UPDATE `admin` SET `fname` = '$fname', `lname` = '$lname', `Email` = '$Email', `passwords` = '$password', `role` = '$role', `statuss` = '$status' WHERE `admin`.`id` = $id;");
if($update_query){
    header("Location: ../admin_manager.php?success=Admin updated successfully");
}else{
    header("Location: ../admin_manager.php?error=Failed to update admin");
}

 ?>