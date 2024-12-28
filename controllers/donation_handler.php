<?php
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $amount = floatval($_POST['amount']);

    if (!empty($name) && !empty($email) && $amount > 0) {
        try {
            $pdo = new PDO($dsn, $db_user, $db_password, $options);

            $sql = "INSERT INTO donations (name, email, amount) VALUES (:name, :email, :amount)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $name, 'email' => $email, 'amount' => $amount]);

            echo "Merci, $name ! Votre don de $amount € a bien été enregistré.";
        } catch (PDOException $e) {
            die("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    } else {
        echo "Veuillez remplir tous les champs correctement.";
    }
} else {
    echo "Méthode non autorisée.";
}
