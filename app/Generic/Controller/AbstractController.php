<?php
namespace Generic\Controller;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Views\Twig;

abstract class AbstractController
{
    /**
     * @var Twig
     */
    protected $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    public function notFound(): ResponseInterface
    {
        $response = new Response(404);
        return $this->twig->render($response, 'errors/error404.twig');
    }

    /**
     * Test si la chaine passéé
     * est non_vide
     * poséde au moins : 5 caracters
     * @param string $str
     * @param int|null $maxLenght
     * @return bool
     */

    protected function validateTextInput(string $str, ?int $maxLenght = 55): bool
    {
        if($str =='' || strlen($str)<5 || strlen($str)>$maxLenght ){

            return false;
        }
            return true;
    }


}












