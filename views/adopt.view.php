<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopter</title>
    <link rel="stylesheet" href="style/adopt.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="script/adopt.js" defer></script>
    <script src="script/app.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'partials/header.php'; ?>

    <main>
        <section class="adoption-section">
            <h1 class="title">Adopter un compagnon</h1>
            <p class="message">Découvrez nos adorables animaux prêts à trouver un nouveau foyer.</p>
            <div class="animal-grid">
                <?php
                include 'config/auth.php';
                include 'config/db_connect.php';
                $query = "SELECT * FROM animals";
                $stmt = $pdo->query($query);
                while ($animal = $stmt->fetch()) {
                    echo '<div class="animal-card" data-animal-id="' . $animal['id'] . '">';
                    if (isAuthorized()) {
                        echo '<div class="action-buttons">
                                <button class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                                <button class="delete-btn"><i class="fas fa-trash-alt"></i></button>
                            </div>';
                    }

                    echo '<img src="' . $animal['photo'] . '" alt="' . $animal['name'] . '">
                        <div class="animal-info">
                            <h3>' . $animal['name'] . '</h3>
                            <p>Description : ' . $animal['description'] . '</p>
                            <button class="adopt-btn">Adopter</button>
                        </div>
                    </div>';
                }
                ?>
            </div>
            <?php if (isAuthorized()) {
                echo '<button class="add-btn" onclick="openPopup()">+</button>';
            }
            ?>

        </section>
    </main>
    <div id="adoptionForm" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Demande d'adoption pour <span class="animal-name"></span></h2>
            <form action="controllers/process_adoption.php" method="POST">
                <input type="hidden" id="animal-id" name="animal_id">

                <div class="form-group">
                    <label>Nom complet :</label>
                    <input type="text" name="adopter_name" required>
                </div>

                <div class="form-group">
                    <label>Email :</label>
                    <input type="email" name="adopter_email" required>
                </div>

                <div class="form-group">
                    <label>Téléphone :</label>
                    <input type="tel" name="adopter_phone" required>
                </div>

                <div class="form-group">
                    <label>Type de logement :</label>
                    <select name="housing" required>
                        <option value="Maison">Maison</option>
                        <option value="Appartement">Appartement</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Avez-vous un jardin ?</label>
                    <select name="garden" required>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Avez-vous d'autres animaux ?</label>
                    <textarea name="other_pets"></textarea>
                </div>

                <div class="form-group">
                    <label>Pourquoi souhaitez-vous adopter cet animal ?</label>
                    <textarea name="motivation" required></textarea>
                </div>

                <div class="form-group">
                    <label>Vos disponibilités pour une rencontre :</label>
                    <textarea name="availability" required></textarea>
                </div>

                <button type="submit">Envoyer ma demande</button>
            </form>
        </div>
    </div>


    <div id="popupForm" class="popup-form">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Ajouter une annonce</h2>
            <form id="addAnimalForm" action="controllers/add_animal.php" method="POST" enctype="multipart/form-data">
                <label for="animal-name">Nom de l'animal:</label>
                <input type="text" id="animal-name" name="animal-name" required>

                <label for="animal-description">Description:</label>
                <textarea id="animal-description" name="animal-description" rows="4" required></textarea>

                <label for="animal-photo">Photo:</label>
                <input type="file" id="animal-photo" name="animal-photo" accept="image/*" required>

                <button type="submit">Ajouter</button>
            </form>
        </div>
    </div>

    <div id="editPopupForm" class="popup-form">
        <div class="popup-content">
            <span class="close-edit-btn" onclick="closeEditPopup()">&times;</span>
            <h2>Éditer l'annonce</h2>
            <form id="editAnimalForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="edit-animal-id" name="edit-animal-id">
                <label for="edit-animal-name">Nom de l'animal:</label>
                <input type="text" id="edit-animal-name" name="edit-animal-name" required>

                <label for="edit-animal-description">Description:</label>
                <textarea id="edit-animal-description" name="edit-animal-description" rows="4" required></textarea>

                <label for="edit-animal-photo">Photo:</label>
                <input type="file" id="edit-animal-photo" name="edit-animal-photo" accept="image/*">

                <button type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>

    <div id="successPopup" style="display: none;">
        <p id="successMessage">Animal ajouté avec succès !</p>
    </div>


    <?php include 'partials/footer.php'; ?>

</body>

</html>