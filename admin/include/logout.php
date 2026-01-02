<?php 
session_start();
$_SESSION['role']='';
header("Location: ../index.php");
?>