<?php
include 'config/db_connect.php';
include 'config/auth.php';  

// Vérification de l'authentification
if (!isAuthorized()) {
    http_response_code(403);
    die('Accès non autorisé');
}

// Ensuite votre code existant
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animalId = $_POST['animal-id'];
    $name = $_POST['edit-animal-name'];
    $description = $_POST['edit-animal-description'];

    if (isset($_FILES['edit-animal-photo']) && $_FILES['edit-animal-photo']['error'] === 0) {
        $photo = 'uploads/' . basename($_FILES['edit-animal-photo']['name']);
        move_uploaded_file($_FILES['edit-animal-photo']['tmp_name'], $photo);
    } else {
        $photo = $_POST['current-photo'];
    }

    $query = "UPDATE animals SET name = ?, description = ?, photo = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $success = $stmt->execute([$name, $description, $photo, $animalId]);

    echo json_encode(['success' => $success]);
}
?>