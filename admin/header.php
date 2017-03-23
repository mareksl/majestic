<?php
// Database configuration
require 'config.php';

// Create connection
$conn = new mysqli($conn_server, $conn_user, $conn_pass, $conn_db);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
mysqli_query($conn, 'SET CHARSET utf8');
mysqli_query($conn, 'SET NAMES `utf8` COLLATE `utf8_general_ci`');
session_start();
if (!isset($_SESSION['login_user'])) {
    header('Location: login.php');
}
?>
