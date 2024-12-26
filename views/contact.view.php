<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous contacter</title>
    <link rel="stylesheet" href="../style/contact.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../script/contact.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
</head>

<body>

    <?php include '../partials/header.php'; ?>
    <main>
        <form class="form" method="POST" action="../controllers/submit_contact.php">
            <p class="title">Contactez-nous</p>
            <p class="message">Remplissez le formulaire ci-dessous et nous vous répondrons dès que possible.</p>
            <div class="flex">
                <label>
                    <input class="input" type="text" name="first_name" placeholder="Prénom" required="">
                </label>
                <label>
                    <input class="input" type="text" name="last_name" placeholder="Nom" required="">
                </label>
            </div>
            <label>
                <input class="input" type="email" name="email" placeholder="Email" required="">
            </label>
            <label>
                <input class="input" type="text" name="subject" placeholder="Sujet" required="">
            </label>
            <label>
                <textarea class="input" name="message" placeholder="Message" required=""></textarea>
            </label>
            <button class="submit" type="submit">Envoyer</button>
        </form>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif ?>
    </main>
    <?php include '../partials/footer.php'; ?>

</body>

</html>