<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 26/11/2018
 * Time: 13:55
 */

namespace App\Controller;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

class ProjetController
{
    private  $twig;
    public function __construct(Twig $twig)
    {
    $this->twig = $twig;
    }

    public function list(

        RequestInterface $request, ResponseInterface $response, $args){
            return $this->twig->render($response, 'index.twig');

           /* $response->getBody()->write('<h1>Liste des projets<h1>');*/

    }
    public function show(RequestInterface $request, ResponseInterface $response, array $args) {
        /*$response->getBody()->write('<h1>Détail du produit</h1>' . $args['index']);*/
        return $this->twig->render($response, 'project-show.twig',["truc"=>'bindle']);


    }

}