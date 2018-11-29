<?php
namespace App\Controller\Admin;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Generic\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class ProjectAdminController extends AbstractController
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * ProjectAdminController constructor.
     * @param Twig $twig
     * @param ProjectRepository $projectRepository
     */
    public function __construct(Twig $twig, ProjectRepository $projectRepository)
    {
        parent::__construct($twig);
        $this->projectRepository = $projectRepository;
    }

    /**
     * Liste les projets en BACK
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function liste(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Récupération les projets
        $projects = $this->projectRepository->findAll();
        // Renvoyer les projets à la vue TWIG
        return $this->twig->render($response, 'admin/project/index.twig', [
            "projects" => $projects
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function show(ServerRequestInterface $request, ResponseInterface $response, array $args) {
        $projet = $this->projectRepository->findById($args['index']);

        // On teste si on a un projet à cet id
        if(is_null($projet)) {
            return $this->notFound();
        }

        return $this->twig->render($response, 'admin/project/show.twig', [
            "projet" => $projet
        ]);
    }

    public function addprojets(ServerRequestInterface $request, ResponseInterface $response):ResponseInterface {
        /*$projet = $this->projectRepository->findById($args['index']);

        // On teste si on a un projet à cet id
        if(is_null($projet)) {
            return $this->notFound();
        }*/

        return $this->twig->render($response, 'admin/project/addprojet.twig');
    }

    public function createCheck(ServerRequestInterface $request, ResponseInterface $response) {

       $posts = $request->getParsedBody();
        /*var_dump($posts);*/
       $valid = $this->isValid($posts);
       /*var_dump($valid);*/
        if($valid) {
            // On construit une projet à partir des variables posts
            $projet = Project::getInstanceFromPost($posts);

            /*var_dump($projet);
            die('Objet Project construit à partir des variables posts ($_POST)');*/

            // On insert le projet en BDD
            /*$this->projectRepository->insert($posts);*/
            $this->projectRepository->insert($projet);
        } else {
            throw new \Exception('Données invalides');
        }

        die('On debug');


    }

    public function isValid(array $arrayPosts): bool
    {

        if (!$this->validateTextInput($arrayPosts['nom'])) {
            return false;
        }
        if (!$this->validateTextInput($arrayPosts['url'])) {
            return false;
        }
        if (!$this->validateTextInput($arrayPosts['image'])) {
            return false;
        }
        if (!$this->validateTextInput($arrayPosts['description'], 2000)) {
            return false;
        }
        try {
            $dateToTest = new \DateTime($arrayPosts['programmed-at']);
        } catch (\Exception $e) {
           return false;
        }

        if(isset($sarrayPosts['is-published']) && $arrayPosts['is-published'] !=='on'){
            return false;
        }
        /*var_dump($dateToTest);*/
        return true;
    }


}










