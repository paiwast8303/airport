<?php
include 'config.php';
$id = clear($_POST['id']);
$fname = clear($_POST['fname']);
$lname = clear($_POST['lname']);
$Email = clear($_POST['Email']);
$password = clear($_POST['password']);
$role = clear($_POST['role']);
$status = clear($_POST['status']);

$password_hash = password_hash($password, PASSWORD_BCRYPT);


$update_query = mysqli_query($db , "UPDATE `admin` SET `fname` = '$fname', `lname` = '$lname', `Email` = '$Email', `passwords` = '$password_hash', `role` = '$role', `statuss` = '$status' WHERE `admin`.`id` = $id;");
if($update_query){
     session_start();
    $admin_name = $_SESSION['name'];
    $admin_id = $_SESSION['id'];
    $detils = "$admin_name updated admin $fname";
    $aq = mysqli_query($db, "INSERT INTO `audit_log` ( `admin_id`, `action_type`, `detail`) VALUES ( '$admin_id', 'edit', '$detils');");
    if($aq){
        header("Location: ../admin_manager.php?success=Admin updated successfully");
    }else{ 
        header("Location: ../admin_manager.php?error=Failed to update admin");
    }
    
}else{
    header("Location: ../admin_manager.php?error=Failed to update admin");
}