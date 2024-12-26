<?php
// config/auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isAuthorized() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}
?>