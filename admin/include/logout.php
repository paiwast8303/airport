<?php 
include 'config.php';
session_start();
 
    $admin_name = $_SESSION['name'];
    $admin_names = $_SESSION['names'];
    $admin_id = $_SESSION['id'];
    $detils = "$admin_name $admin_names logged out";
    $aqr = mysqli_query($db, "INSERT INTO `audit_log` ( `admin_id`, `action_type`, `detail`) VALUES ( '$admin_id', 'logout', '$detils');");

    if($aqr){
        $_SESSION['role']='';
    }
   
   header("Location: ../index.php");


?>