<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


// Définit les routes et leurs correspondances
$routes = [
    '/accueil' => 'index.php',  // Page d'accueil
    '/adopter' => 'views/adopt.view.php',
    '/contact' => 'views/contact.view.php',
    '/nous-aider' => 'views/donation.view.php',
    '/admin' => 'views/login.view.php',
];

(array_key_exists($uri, array: $routes)) ? require $routes[$uri] : require 'views/404.view.php';