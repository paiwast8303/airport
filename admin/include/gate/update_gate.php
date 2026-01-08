<?php 
include '../config.php';

if(isset($_POST['gate_name']) && isset($_POST['status']) && isset($_POST['terminal']) && isset($_POST['id'])){
    $gate_name = clear($_POST['gate_name']);
    $status = clear($_POST['status']);
    $terminal = clear($_POST['terminal']);
    $id = clear($_POST['id']);
    
    $update_query = mysqli_query($db , "UPDATE `gate` SET `gate` = '$gate_name', `terminal_id` = '$terminal', `status` = '$status' WHERE `gate`.`id` = $id;");
    if($update_query){
        session_start();
        $admin_name = $_SESSION['name'];
        $admin_id = $_SESSION['id'];
        $detils = "$admin_name updated gate $gate_name";
        $aq = mysqli_query($db, "INSERT INTO `audit_log` ( `admin_id`, `action_type`, `detail`) VALUES ( '$admin_id', 'edit', '$detils');");
        if($aq){
            header("Location: ../../gate_manager.php?success=Gate updated successfully");
        }else{
            header("Location: ../../gate_manager.php?error=Failed to update gate");
        }
    }else{
        header("Location: ../../gate_manager.php?error=Failed to update gate");
    }
}else{
    header("Location: ../../gate_manager.php?error=Missing required fields");
}
