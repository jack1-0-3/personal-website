<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        echo json_encode(['success'=>false]); exit;
    }

    require 'db_connect.php';

    $blog_post_id = intval($_POST['blog_post_id']);
    $content = trim($_POST['content']);
    $user_email = $_SESSION['email'];
    $stmt = $conn->prepare("INSERT INTO replies (blog_post_id, email, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $blog_post_id, $user_email, $content);
    $stmt->execute();

    echo json_encode(['success'=>true]);
?>