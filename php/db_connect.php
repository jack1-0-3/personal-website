<?php
    define('ADMIN_EMAIL', 'jack.lawrence103@gmail.com');

    $servername = "127.0.0.1";
    $username = "root";
    $database_password = "root";
    $database_name = "portfolio";

    // Creates connection
    $conn = new mysqli($servername, $username, $database_password, $database_name);
    
    // Checks connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>