<?php
include 'config/db_connect.php';
include 'config/auth.php';

if (!isAuthorized()) {
    http_response_code(403);
    die(json_encode(['success' => false, 'error' => 'Accès non autorisé']));
}

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['animal-name'];
    $description = $_POST['animal-description'];

    $uploadDir = '../uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $fileExtension = pathinfo($_FILES['animal-photo']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        echo json_encode(['success' => false, 'error' => 'Format de fichier non supporté.']);
        exit;
    }


    if (!getimagesize($_FILES['animal-photo']['tmp_name'])) {
        echo json_encode(['success' => false, 'error' => 'Le fichier n\'est pas une image valide.']);
        exit;
    }

    $photoPath = 'uploads/' . uniqid() . '_' . basename($_FILES['animal-photo']['name']);

    if (move_uploaded_file($_FILES['animal-photo']['tmp_name'], $photoPath)) {
        $stmt = $pdo->prepare("INSERT INTO animals (name, description, photo) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $description, $photoPath])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'insertion en base de données.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'upload de l\'image.']);
    }
}
