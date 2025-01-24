<?php
include 'config/db_connect.php';
include 'config/auth.php';

if (!isAuthorized()) {
    http_response_code(403);
    die(json_encode(['success' => false, 'error' => 'Accès non autorisé']));
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $animalId = (int) $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM animals WHERE id = ?");
    if ($stmt->execute([$animalId])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Échec de la suppression de l\'animal.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'ID de l\'animal non fourni ou invalide.']);
}
