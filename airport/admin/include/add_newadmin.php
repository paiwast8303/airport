<?php 
include 'config.php';

$fname = clear($_POST['fname']);
$lname = clear($_POST['lname']);
$Email = clear($_POST['Email']);
$password = clear($_POST['password']);
$role = clear($_POST['role']);
$status = clear($_POST['status']);

$add_query = mysqli_query($db , "INSERT INTO `admin` (`id`, `fname`, `lname`, `Email`, `passwords`, `role`, `statuss`, `created_at`) VALUES (NULL, '$fname', '$lname', '$Email', '$password', '$role', '$status', current_timestamp());");
if($add_query){
    header("Location: ../admin_manager.php?success=Admin added successfully");
}else{
    header("Location: ../admin_manager.php?error=Failed to add admin");
}




?>