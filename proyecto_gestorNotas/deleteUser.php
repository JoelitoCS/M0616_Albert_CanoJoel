<?php
    session_start();
    require 'config.php';

    if ($_SESSION['user_role'] !== 'admin') exit("Sense permisos");

    $id = (int) $_GET['id'];
    $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: adminUsers.php");
exit;