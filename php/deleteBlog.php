<?php
    session_start();
    include './db_connect.php';

    if (!isset($_SESSION['email']) || $_SESSION['email'] !== ADMIN_EMAIL) {
        echo json_encode(['success'=>false]);
        exit;
    }

    $blog_id = intval($_POST['blog_id']);

    // Delete replies associated with blog post
    $conn->query("DELETE FROM replies WHERE blog_post_id = $blog_id");

    // Delete the blog post
    $stmt = $conn->prepare("DELETE FROM blog_posts WHERE id = ?");
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();

    echo json_encode(['success'=>true]);
?>