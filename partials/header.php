<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'config/constants.php';  // Assurez-vous que le chemin est correct ici.
?>

<header>
    <a href="<?= BASE_PATH ?>/accueil">
        <img src="assets/logo1.png" alt="Logo" class="logo">
    </a>
    <nav>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul>
            <li><a href="<?= BASE_PATH ?>/accueil">ACCUEIL</a></li>
            <li><a href="<?= BASE_PATH ?>/adopter">ADOPTER</a></li>
            <li><a href="<?= BASE_PATH ?>/contact">CONTACT</a></li>
            <li><a href="<?= BASE_PATH ?>/nous-aider">NOUS AIDER</a></li>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <li><a href="<?= BASE_PATH ?>/logout">DECONNEXION</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
