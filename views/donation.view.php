<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faire un Don </title>
    <link rel="stylesheet" href="style/don.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php
    include 'partials/header.php';
    ?>
    <main>
        <section class="donation-section">
            <h1 class="title">Faire un Don</h1>
            <p class="message">Votre générosité aide à sauver des vies et à trouver des foyers pour nos amis à quatre
                pattes.</p>
            <div class="donation-options">
                <div class="donation-card">
                    <h3>Don Unique</h3>
                    <p>Faites un don unique pour aider nos animaux.</p>
                    <button class="donate-btn">Donner</button>
                </div>
                <div class="donation-card">
                    <h3>Don Mensuel</h3>
                    <p>Contribuez régulièrement et aidez de manière continue.</p>
                    <button class="donate-btn">Donner Mensuellement</button>
                </div>

            </div>
            <form class="donation-form" action="controllers/donation_handler.php" method="POST">
                <h2>Formulaire de Don</h2>
                <label>
                    <span>Nom</span>
                    <input class="input" type="text" name="name" required>
                </label>
                <label>
                    <span>Email</span>
                    <input class="input" type="email" name="email" required>
                </label>
                <label>
                    <span>Montant du Don (€)</span>
                    <input class="input" type="number" name="amount" min="1" required>
                </label>
                <button class="submit" type="submit">Faire un Don</button>
            </form>

        </section>
    </main>
    <?php
    include 'partials/footer.php';
    ?>
</body>

</html>