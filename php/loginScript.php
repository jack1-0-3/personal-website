<?php
    session_start();
    
    include './db_connect.php';

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $pass1 = isset($_POST['password']) ? $_POST['password'] : '';
    $error_message = ''; // Initialize error message

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = "SELECT * FROM USERS WHERE email='$email' AND password='$pass1'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['email'] = $user['email'];
            header("Location: ../php/addEntry.php");
            exit();
        } else {
            $error_message = "Invalid email or password."; // Set error message
        }
    }
?>