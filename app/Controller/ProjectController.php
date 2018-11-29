<?php
namespace App\Controller;

use App\Repository\ProjectRepository;
use Generic\Controller\AbstractController;
use Generic\Database\Database;
use Psr\Http\Message\ResponseInterface as IResponse;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Slim\Views\Twig;

class ProjectController extends AbstractController
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(Twig $twig, ProjectRepository $projectRepository)
    {
        parent::__construct($twig);
        $this->projectRepository = $projectRepository;
    }

    /**
     * Liste les différents projets
     * @param IRequest $request
     * @param IResponse $response
     * @return IResponse
     */
    public function liste(IRequest $request, IResponse $response) {
        $projets = $this->projectRepository->findAll();

        return $this->twig->render($response, 'index.twig', [
            'projects' => $projets
        ]);
    }

    /**
     * Affiche le détail d'un produit
     * @param IRequest $request
     * @param IResponse $response
     * @param array $args
     * @return IResponse
     */
    public function show(IRequest $request, IResponse $response, array $args) {
        $projet = $this->projectRepository->findById($args['index']);

        // On teste si on a un projet à cet id
        if(is_null($projet)) {
            return $this->notFound();
        }

        return $this->twig->render($response, 'project-show.twig', [
            "projet" => $projet
        ]);
    }
}












