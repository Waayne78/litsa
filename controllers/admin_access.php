<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si déjà connecté, rediriger vers la page d'adoption
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    header('Location: adopt.view.php');
    exit;
}

// Code secret dans l'URL
if (!isset($_GET['key']) || $_GET['key'] !== 'admin_K9p#mX2$vL') {
    // Si pas de code ou mauvais code, rediriger vers l'accueil
    header('Location: ../index.php');
    exit;
}

// Si bon code secret, rediriger vers login
header('Location: ../views/login.view.php');
exit;
