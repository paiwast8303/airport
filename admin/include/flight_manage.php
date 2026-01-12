<?php 
include 'config.php';

if(isset($_POST['submit_add'])) {
    $flight_no = clear($_POST['flight_no']);
    $airline_id = clear($_POST['airline_id']);
    $gate_id = clear($_POST['gate_id']);
    $type = clear($_POST['type']);
    $origin_id = clear($_POST['origin_id']);
    $destination_id = clear($_POST['destination_id']);
    $statuss = clear($_POST['statuss']);
    $date = clear($_POST['date']);
    $boarding_time = clear($_POST['boarding_time']);
    $departure_time = clear($_POST['departure_time']);
    $arrival_time = clear($_POST['arrival_time']);

    $insert_query = mysqli_query($db , "INSERT INTO `flight` (`id`, `flight_no`, `airline_id`, `type`, `gate_id`, `origin_id`, `destination_id`, `statuss`, `dates`, `boarding_time`, `departure_time`, `arrival_time`) VALUES (NULL, '$flight_no', '$airline_id', '$type', '$gate_id', '$origin_id', '$destination_id', '$statuss', '$date', '$boarding_time', '$departure_time', '$arrival_time');");

    if($insert_query){
        session_start();
    $admin_name = $_SESSION['name'];
    $admin_id = $_SESSION['id'];
    $detils = "$admin_name added new flight $flight_no";
    $aq = mysqli_query($db, "INSERT INTO `audit_log` ( `admin_id`, `action_type`, `detail`) VALUES ( '$admin_id', 'add', '$detils');");

    if($aq){
        header("Location: ../manage.php?success=Flight added successfully");
    }else{
        header("Location: ../manage.php?error=Failed to add flight");
    }
    }else{
        header("Location: ../manage.php?error=Failed to add flight");
    }
}

if(isset($_POST['submit_update'])) {
    $id = clear($_POST['id']);
    $flight_no = clear($_POST['flight_no']);
    $airline_id = clear($_POST['airline_id']);
    $gate_id = clear($_POST['gate_id']);
    $type = clear($_POST['type']);
    $origin_id = clear($_POST['origin_id']);
    $destination_id = clear($_POST['destination_id']);
    $statuss = clear($_POST['statuss']);
    $date = clear($_POST['date']);
    $boarding_time = clear($_POST['boarding_time']);
    $departure_time = clear($_POST['departure_time']);
    $arrival_time = clear($_POST['arrival_time']);

    $update_query = mysqli_query($db , "UPDATE `flight` SET `flight_no` = '$flight_no', `airline_id` = '$airline_id', `type` = '$type', `gate_id` = '$gate_id', `origin_id` = '$origin_id', `destination_id` = '$destination_id', `statuss` = '$statuss', `dates` = '$date', `boarding_time` = '$boarding_time', `departure_time` = '$departure_time', `arrival_time` = '$arrival_time' WHERE `flight`.`id` = $id;");

    if($update_query){

        session_start();
    $admin_name = $_SESSION['name'];
    $admin_id = $_SESSION['id'];
    $detils = "$admin_name updated flight $flight_no";
    $aqr = mysqli_query($db, "INSERT INTO `audit_log` ( `admin_id`, `action_type`, `detail`) VALUES ( '$admin_id', 'update', '$detils');");

    if($aqr){
        header("Location: ../manage.php?success=Flight updated successfully");
    }else{
        header("Location: ../manage.php?error=Failed to update flight");
    }
    }else{
        header("Location: ../manage.php?error=Failed to update flight");
    }
}

?>