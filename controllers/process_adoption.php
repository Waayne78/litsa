<?php
header('Content-Type: application/json');
include '../config/db_connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adopterName = htmlspecialchars(trim($_POST['adopter_name'] ?? ''));
    $animalId = filter_input(INPUT_POST, 'animal_id', FILTER_VALIDATE_INT);
    $adopterEmail = filter_input(INPUT_POST, 'adopter_email', FILTER_VALIDATE_EMAIL);
    $adopterPhone = htmlspecialchars(trim($_POST['adopter_phone'] ?? ''));
    $housing = htmlspecialchars(trim($_POST['housing'] ?? ''));
    $garden = htmlspecialchars(trim($_POST['garden'] ?? ''));
    $otherPets = htmlspecialchars(trim($_POST['other_pets'] ?? ''));
    $motivation = htmlspecialchars(trim($_POST['motivation'] ?? ''));
    $availability = htmlspecialchars(trim($_POST['availability'] ?? ''));

    if (empty($adopterName) || !$animalId || !$adopterEmail || empty($adopterPhone)) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs requis doivent être remplis.']);
        exit;
    }

    try {
        $animalQuery = "SELECT name FROM animals WHERE id = ?";
        $stmt = $pdo->prepare($animalQuery);
        $stmt->execute([$animalId]);
        $animal = $stmt->fetch();

        if (!$animal) {
            echo json_encode(['success' => false, 'message' => 'Animal non trouvé.']);
            exit;
        }

        $animalName = $animal['name'];

        $query = "INSERT INTO adoption_requests (animal_id, adopter_name, adopter_email, adopter_phone, message, housing, garden, other_pets, availability, status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$animalId, $adopterName, $adopterEmail, $adopterPhone, $motivation, $housing, $garden, $otherPets, $availability]);

        // Envoi de l'email à l'admin
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'milanemh79@gmail.com';
        $mail->Password = 'tbvn fqjs kujd aucm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('milanemh79@gmail.com', 'Milane Mehalebi');
        $mail->addAddress('milanemh79@gmail.com', 'Admin');
        $mail->isHTML(true);
        $mail->Subject = 'Nouvelle demande d\'adoption';
        $mail->Body = "
        <h3>Nouvelle demande d'adoption reçue</h3>
        <p><strong>Nom de l'animal :</strong> $animalName</p>
        <p><strong>Nom du demandeur :</strong> $adopterName</p>
        <p><strong>Email :</strong> $adopterEmail</p>
        <p><strong>Téléphone :</strong> $adopterPhone</p>
        <p><strong>Type de logement :</strong> $housing</p>
        <p><strong>Présence d'un jardin :</strong> $garden</p>
        <p><strong>Autres animaux :</strong> $otherPets</p>
        <p><strong>Motivation :</strong> $motivation</p>
        <p><strong>Disponibilités :</strong> $availability</p>
    ";

        $mail->send();

        $clientSubject = "Confirmation de votre demande d'adoption";
        $clientMessage = "
        Nous avons bien reçu votre demande d'adoption pour l'animal suivant :
        <p><strong>Nom de l'animal :</strong> $animalName</p>
        Merci de l'intérêt que vous portez à nos animaux. Nous vous contacterons bientôt.
        ";

        $mail->clearAddresses();
        $mail->addAddress($adopterEmail);
        $mail->Subject = $clientSubject;
        $mail->Body = nl2br($clientMessage);
        $mail->send();

        // Retour de la réponse JSON
        echo json_encode(['success' => true, 'message' => 'Votre demande a été envoyée avec succès.']);
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Une erreur est survenue lors du traitement de votre demande.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
}
