<?php 
session_start();

    $admin_name = $_SESSION['name'];
    $admin_id = $_SESSION['id'];
    $detils = "$admin_name logged out";
    $aq = mysqli_query($db, "INSERT INTO `audit_log` ( `admin_id`, `action_type`, `detail`) VALUES ( '$admin_id', 'logout', '$detils');");
$_SESSION['role']='';
header("Location: ../index.php");
?>