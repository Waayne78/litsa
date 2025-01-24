<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    header('Location: adopt.view.php');
    exit;
}

if (!isset($_GET['key']) || $_GET['key'] !== 'admin_K9pmX2vL') {
    header('Location: ../index.php');
    exit;
}

header('Location: ../views/login.view.php');
exit;
