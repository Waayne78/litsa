<?php
session_start();
include '../config/db_connect.php';
include '../config/auth.php';  // Ajout de l'authentification

// Vérification de l'authentification
if (!isAuthorized()) {
    http_response_code(403);
    die(json_encode(['success' => false, 'error' => 'Accès non autorisé']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['animal-name'];
    $description = $_POST['animal-description'];

    $uploadDir = 'uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Validation de l'image uploadée
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = pathinfo($_FILES['animal-photo']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        echo json_encode(['success' => false, 'error' => 'Format de fichier non supporté.']);
        exit;
    }

    if ($_FILES['animal-photo']['size'] > 2 * 1024 * 1024) {
        echo json_encode(['success' => false, 'error' => 'La taille de l\'image est trop grande.']);
        exit;
    }

    if (!getimagesize($_FILES['animal-photo']['tmp_name'])) {
        echo json_encode(['success' => false, 'error' => 'Le fichier n\'est pas une image valide.']);
        exit;
    }

    // Déplacement de l'image après validation
    $targetFile = $uploadDir . basename($_FILES['animal-photo']['name']);

    if (move_uploaded_file($_FILES['animal-photo']['tmp_name'], $targetFile)) {
        // Insertion dans la base de données
        $stmt = $pdo->prepare("INSERT INTO animals (name, description, photo) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $description, $targetFile])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'insertion en base de données.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'upload de l\'image.']);
    }
}
