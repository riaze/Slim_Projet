<?php

use App\Controller\ProjetController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;



//autoloader
require dirname(__DIR__).'/vendor/autoload.php';
$config = require dirname(__DIR__).'/config/config.php';

//creation d l'application
$app = new \Slim\App($config
    /*/[
        'setting' =>[
            'displayErrorDetails'=>true,
        ],

    ]*/


);

//paramétrage du container

require dirname(__DIR__).'/config/container.php';

require dirname(__DIR__).'/config/routing.php';




// routage

/*$app ->get('/contact', function(ServerRequestInterface $request, ResponseInterface $response){

    $response->getBody()->write('<h1>page de contact</h1>');
})->setName('contact');

$app ->get('/', function(ServerRequestInterface $request, ResponseInterface $response){

    $response->getBody()->write('<h1>page d\'Accueil</h1>');

})->setName('homepage');

$app->group('/projet', function() {

    $this->get('/liste', ProjetController::class.':list')->setName('product_list');

   $this->get('/{index:\d+}', ProjetController::class.':show')->setName('product_show');*/




    /*$this->get('/liste', function(RequestInterface $request, ResponseInterface $response, array $args){
        $response->getBody()->write('Liste des projets');
        return $response;
    })->setName('product_list');

    $this->get('/{index:\d+}', function (RequestInterface $request, ResponseInterface $response, $args) {
        $response->getBody()->write('Détail du produit ' . $args['index']);
        return $response;
    })->setName('product_show');


});*/



/*$app ->get('/projets/{index:\d+}', function(ServerRequestInterface $request, ResponseInterface $response, array $args){

    $response->getBody()->write("<h1>projet {$args['index']}</h1>");

})->setName('front_pages');*/



// Envoi de réponse à navigator

$app->run();