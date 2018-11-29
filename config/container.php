<?php

use App\Controller\Admin\ProjectAdminController;
use App\Controller\ProjectController;
use App\Repository\ProjectRepository;
use Generic\Database\Database;
use Psr\Container\ContainerInterface;

// Récupération du conteneur
$container = $app->getContainer();

/*******************************************/
/********        Par défaut          *******/
/*******************************************/

// Définition du chemin racine
$container['BASE_DIR'] = dirname(__DIR__);

// Définition de TWIG
$container['view'] = function (ContainerInterface $container) {
    $view = new \Slim\Views\Twig($container->get('BASE_DIR') .'/templates', [
        'cache' => false,
        'debug'=> true
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};
$container[Database::class] = function(ContainerInterface $c) {
    // Récupération des paramètres (config.php)
    $settings = $c->get('settings');
    // On retourne une instance de la classe Database
    return new Database(
        $settings['db_host'],
        $settings['db_name'],
        $settings['db_user'],
        $settings['db_pass']
    );
};

/*******************************************/
/********        Contrôleurs         *******/
/*******************************************/
$container[ProjectController::class] = function(ContainerInterface $container) {
    return new ProjectController(
        $container->get('view'),
        $container->get(ProjectRepository::class)
    );
};
$container[ProjectAdminController::class] = function(ContainerInterface $container) {
    return new ProjectAdminController(
        $container->get('view'),
        $container->get(ProjectRepository::class)
    );
};

/*******************************************/
/********        Repository          *******/
/*******************************************/
$container[ProjectRepository::class] = function (ContainerInterface $c) {
    return new ProjectRepository(
        $c->get(Database::class)
    );
};












