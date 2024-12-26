<?php
session_start();
include '../config/db_connect.php';
include '../config/auth.php';  // Ajout de l'authentification

// Vérification de l'authentification
if (!isAuthorized()) {
    http_response_code(403);
    die(json_encode(['success' => false, 'error' => 'Accès non autorisé']));
}

// Votre code existant
if (isset($_GET['id'])) {
    $animalId = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM animals WHERE id = ?");
    if ($stmt->execute([$animalId])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Échec de la suppression de l\'animal.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID de l\'animal non fourni.']);
}
?>