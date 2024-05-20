<?php



namespace App\Controller\admin;

use App\Entity\Categorie;
use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Description of AdminCategoriesController
 *
 * @author BEN BAHA
 */
class AdminCategoriesController extends AbstractController {
    /**
     * 
     * @var FormationRepository
     */
    private $formationRepository;
    
    /**
     * 
     * @var CategorieRepository
     */
    private $categorieRepository;
    /**
     * 
     * @param FormationRepository $formationRepository
     * @param CategorieRepository $categorieRepository
     */
    function __construct(FormationRepository $formationRepository, CategorieRepository $categorieRepository) {
        $this->formationRepository = $formationRepository;
        $this->categorieRepository= $categorieRepository;
    }
    /**
     * @Route("/admin/categories", name="admin.categories")
     * @return Response
     */
    public function index(): Response{
        $formations = $this->formationRepository->findAll();
        $categories = $this->categorieRepository->findAll();
        return $this->render("admin/admin.categories.html.twig", [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }
     /**
     * @Route("/admin/categorie/suppr/{id}", name="admin.categories.suppr")
     * @param Categorie $categorie
     * @return Response
     */
    public function suppr(Categorie $categorie): Response {
       $em= $this->getDoctrine()->getManager();
        $formations= $categorie->getFormations();
         if(Count($formations)>0){
             $this->addFlash('erreur', 'impossible de supprimer cette catégorie elle est ratachée a une formation ou plus!!');
         }
         else{
             $em->remove($categorie);
             $em->flush();
            $this->categorieRepository->remove($categorie, true);
            return $this->redirectToRoute('admin.categories');
         } 
        
    }
     /**
     * @Route("/admin/categorie/ajout", name="admin.categorie.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request): Response {
       $em=$this->getDoctrine()->getManager();
       $nameCategorie = $request->request->get('name');
       $existCategorie= $em->getRepository(Categorie::class)->findOneBy(['name'=>$nameCategorie]);
        if($existCategorie){
            $this->addFlash('error', 'cette catégorie existe déjà!!');
        }
        else{
            $categorie = new Categorie();
            $categorie->setName($nameCategorie);
            $em->persist($categorie);
            $this->categorieRepository->add($categorie, true);
            $this->addFlash('success', 'la catégorie '.$categorie->getName().' a été ajoutée avec succès!!');
        }
        return $this->redirectToRoute('admin.categories');   
        
    }
       
}
