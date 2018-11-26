<?php

//Recupéeration du conteneur

$container = $app->getContainer();

//definition des  clefs du container

$container['BASE_DIR'] = dirname(__DIR__);

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig($c->get('BASE_DIR').'/templates', [
        'cache' => false,
        'debug' => true
    ]);

    // Instantiate and add Slim specific extension
    $router = $c->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};




$container[\App\Controller\ProjetController::class] = function ($c){
 return new \App\Controller\ProjetController($c->get('view'));
};


