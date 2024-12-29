<?php

session_destroy();

// Inclure le fichier constants.php pour accéder à la constante BASE_PATH
include 'config/constants.php';

// Redirection après déconnexion
header('Location: ' . BASE_PATH . '/accueil');
exit;
