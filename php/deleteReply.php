<?php
    session_start();

    require 'db_connect.php';

    if (!isset($_SESSION['email']) || $_SESSION['email'] !== ADMIN_EMAIL) {
        echo json_encode(['success'=>false]); exit;
    }

    $reply_id = intval($_POST['reply_id']);
    $stmt = $conn->prepare("DELETE FROM replies WHERE id=?");
    $stmt->bind_param("i", $reply_id);
    $stmt->execute();

    echo json_encode(['success'=>true]);
?>