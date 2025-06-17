<?php

if(!$open_connect = 1) {
    die(header("Location: form_login.php"));
    exit;
} else {
    include_once 'connect.php';
}
// connect.php
// Database connection settings
$hostname = 'localhost'; // MySQL server hostname
$username = 'root'; // MySQL username
$password = ''; // MySQL password
$database = 'buzz';
$port = NULL; // Default MySQL port
$socket = NULL; // Optional, specify if needed
$connect = mysqli_connect($hostname, $username, $password, $database, $port, $socket);     

if(!$connect) {
    die("เชื่อมต่อล้มเหลว: " . mysqli_connect_error($connect));
} else {
    // Set the character set to UTF-8
    mysqli_set_charset($connect, 'utf8');
}
?>s