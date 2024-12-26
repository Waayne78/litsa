<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Litsa et ses loulous</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <header>
        <a href="">
            <img src="assets/logo1.png" alt="Logo" class="logo">
        </a>
        <nav>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul>
                <li><a href="index.php">ACCUEIL</a></li>
                <li><a href="views/adopt.view.php">ADOPTER</a></li>
                <li><a href="views/contact.view.php">CONTACT</a></li>
                <li><a href="views/donation.view.php">NOUS AIDER</a></li>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <li><a href="controllers/logout.php">DECONNEXION</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <section id="hero">
            <div class="hero-content">
                <div class="left">
                    <div class="godmother-card">
                        <img src="assets/marraine.jpg" alt="Marraine">
                        <div class="godmother-text">
                            <p><strong>Laura Fouache</strong> <br> Marraine de l'association</p>
                        </div>
                    </div>
                    <h1 class="title"><span>Litsa</span> et ses loulous</h1>
                    <h2>Une chance pour les amoureux des animaux</h2>
                    <p>Litsa et ses loulous est une association récemment fondée, dédiée à l'adoption de chiens et de
                        chats.
                        Notre mission est de fournir un soutien exceptionnel aux adoptants et d'assurer le bien-être de
                        chaque animal.</p>
                </div>

                <div class="right">
                    <img src="assets/picture.png" alt="Chien et chat">
                </div>
            </div>
        </section>
        <section id="video-section">
            <h1>Présentation de l'association</h1>
            <video id="video" controls>
                <source src="assets/presentation.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </section>
        <section id="home" class="section-content">
            <h2>Découvrez les membres de notre association : </h2>

        </section>
        <section class="articles">
            <div class="member-card">
                <img src="assets/img1.jpg" alt="Animal Name">
                <div class="animal-info">
                    <h3>Annie Fouache</h3>
                    <p>Présidente de l'association.</p>
                </div>
            </div>
            <div class="member-card">
                <img src="assets/img2.jpg" alt="Animal Name">
                <div class="animal-info">
                    <h3>Cindirella Pinheiro</h3>
                    <p>Responsable du pôle communication.</p>
                </div>
            </div>
            <div class="member-card">
                <img src="assets/mahé.jpg" alt="Animal Name">
                <div class="animal-info">
                    <h3>Phillipe Mahé</h3>
                    <p>Bénévole de l'association.</p>
                </div>
            </div>
            <div class="member-card">
                <img src="assets/img3.jpg" alt="Animal Name">
                <div class="animal-info">
                    <h3>Inès Fouache</h3>
                    <p>Trésorier de l'association.</p>
                </div>
            </div>
        </section>
    </main>
    <?php
    include 'partials/footer.php';
    ?>
</body>

</html>