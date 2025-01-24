<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'config/constants.php';  
?>

<header>
    <a href="<?= BASE_PATH ?>/accueil">
        <img src="assets/logo1.png" alt="Logo" class="logo">
    </a>
    <nav>
        <div class="menu-toggle" id="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul id="menu">
            <li><a href="<?= BASE_PATH ?>/accueil">ACCUEIL</a></li>
            <li><a href="<?= BASE_PATH ?>/adopter">ADOPTER</a></li>
            <li><a href="<?= BASE_PATH ?>/contact">CONTACT</a></li>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <li><a href="<?= BASE_PATH ?>/logout">DÉCONNEXION</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
    
    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('active');
    });
</script>
