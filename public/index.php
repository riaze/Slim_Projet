<?php

// Autoloader
require dirname(__DIR__) . '/vendor/autoload.php' ;

// Récupération de la configuration
$config = require dirname(__DIR__) . '/config/config.php';

// Création de l'application
$app = new \Slim\App($config);

// Paramétrage du container
require dirname(__DIR__) . '/config/container.php';

// Paramétrage des routes
require dirname(__DIR__) . '/config/routing.php';

// Envoi de la réponse au navigateur
$app->run();