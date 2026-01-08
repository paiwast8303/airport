<?php 
include '../config.php';

$gate_name = clear($_POST['gate_namess']);
$terminal = clear($_POST['Terminal']);
$status = clear($_POST['Status']);

$add_query = mysqli_query($db , "INSERT INTO `gate` (`id`, `gate`, `terminal_id`, `status`) VALUES (NULL, '$gate_name', '$terminal', '$status');");


if($add_query){
    session_start();
    $admin_name = $_SESSION['name'];
    $admin_id = $_SESSION['id'];
    $detils = "$admin_name added new gate $gate_name";
    $aq = mysqli_query($db, "INSERT INTO `audit_log` ( `admin_id`, `action_type`, `detail`) VALUES ( '$admin_id', 'add', '$detils');");

    if($aq){
        header("Location: ../../gate_manager.php?success=Gate added successfully");
    }else{ 
        header("Location: ../../gate_manager.php?error=Failed to add gate");
    }
}else{
    header("Location: ../../gate_manager.php?error=Failed to add gate");
}
?>
