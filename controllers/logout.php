<?php

session_destroy();

include 'config/constants.php';

header('Location: ' . BASE_PATH . '/accueil');
exit;
