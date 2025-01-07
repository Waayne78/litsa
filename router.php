<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$basePath = '/php/cinema/appphp/E-Shop/organization';
$uri = str_replace($basePath, '', $uri);

if ($uri === '' || $uri === '/') {
    $uri = '/accueil';
}

$routes = [
    '/accueil' => 'views/index.view.php',
    '/adopter' => 'views/adopt.view.php',
    '/contact' => 'views/contact.view.php',
    '/nous-aider' => 'views/donation.view.php',
    '/admin' => 'views/login.view.php',
    '/logout' => 'controllers/logout.php',
    '/delete_animal' => 'controllers/delete_animal.php',
    '/add_animal' => 'controllers/add_animal.php',
    '/edit_animal' => 'controllers/edit_animal.php',
    '/process_adoption' => 'controllers/process_adoption.php',
    '/process_donation' => 'controllers/donation_handler.php',

];

if (array_key_exists($uri, $routes)) {
    $path = __DIR__ . '/' . $routes[$uri];
    if (file_exists($path)) {
        require $path;
    } else {
        require __DIR__ . '/views/404.view.php';
    }
} else {
    require __DIR__ . '/views/404.view.php';
}