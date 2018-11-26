<?php


use App\Controller\ProjetController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/*$app ->get('/contact', function(ServerRequestInterface $request, ResponseInterface $response){

    $response->getBody()->write('<h1>page de contact</h1>');
})->setName('contact');

$app ->get('/', function(ServerRequestInterface $request, ResponseInterface $response){

    $response->getBody()->write('<h1>page d\'Accueil</h1>');

})->setName('homepage');*/

$app->group('/projet', function() {

    $this->get('/liste', ProjetController::class . ':list')->setName('product_list');

    $this->get('/{index:\d+}', ProjetController::class . ':show')->setName('product_show');
});