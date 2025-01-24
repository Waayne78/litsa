<?php
include 'config/db_connect.php';
include 'config/constants.php';


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM admins WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['is_admin'] = true;
        header('Location: ' . BASE_PATH . '/adopter');
        exit;
    } else {
        $error = 'Identifiant ou mot de passe incorrect.';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion Administration</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/signup.css">
    <link rel="stylesheet" href="style/footer.css">
    
</head>

<body>
    <?php include 'partials/header.php'; ?>
    <div class="login-form">
        <h2>Connexion Administration</h2>
        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST">
            <div>
                <label>Identifiant:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label>Mot de passe:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
    <?php include 'partials/footer.php'; ?>
</body>

</html>