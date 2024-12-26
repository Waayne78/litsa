<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <a href="">
        <img src="../assets/logo1.png" alt="Logo" class="logo">
    </a>
    <nav>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul>
            <li><a href="../index.php">ACCUEIL</a></li>
            <li><a href="adopt.view.php">ADOPTER</a></li>
            <li><a href="contact.view.php">CONTACT</a></li>
            <li><a href="donation.view.php">NOUS AIDER</a></li>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <li><a href="../controllers/logout.php">DECONNEXION</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>