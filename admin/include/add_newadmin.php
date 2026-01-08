<?php 
include 'config.php';

 $fname = clear($_POST['fname']);
$lname = clear($_POST['lname']);
$Email = clear($_POST['Email']);
$password = clear($_POST['password']);
$role = clear($_POST['role']);
$status = clear($_POST['status']);
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$add_query = mysqli_query($db , "INSERT INTO `admin` (`id`, `fname`, `lname`, `Email`, `passwords`, `role`, `statuss`, `created_at`) VALUES (NULL, '$fname', '$lname', '$Email', '$password_hash', '$role', '$status', current_timestamp());");
if($add_query){
    session_start();
    $admin_name = $_SESSION['name'];
    $admin_id = $_SESSION['id'];
    $detils = "$admin_name added new admin $fname";
    $aq = mysqli_query($db, "INSERT INTO `audit_log` ( `admin_id`, `action_type`, `detail`) VALUES ( '$admin_id', 'add', '$detils');");

    if($aq){
        header("Location: ../admin_manager.php?success=Admin added successfully");
    }else{ 
        header("Location: ../admin_manager.php?error=Failed to add admin");
    }
}else{
    header("Location: ../admin_manager.php?error=Failed to add admin");
}
?>