<?php
namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controleur de l'accueil
 *
 * @author emds
 */
class AccueilController extends AbstractController{
      
    /**
     * @var FormationRepository
     */
    private $repository;
    /**
     * le chemin vers la page d'accueil
     */
    private const PAGEACCUEIL = "pages/accueil.html.twig";


    /**
     * 
     * @param FormationRepository $repository
     */
    public function __construct(FormationRepository $repository) {
        $this->repository = $repository;
    }   
    
    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function index(): Response{
        $formations = $this->repository->findAllLasted(2);
        return $this->render(self::PAGEACCUEIL, [
            'formations' => $formations
        ]); 
    }
    
    /**
     * @Route("/cgu", name="cgu")
     * @return Response
     */
    public function cgu(): Response{
        return $this->render("pages/cgu.html.twig"); 
    }
}
