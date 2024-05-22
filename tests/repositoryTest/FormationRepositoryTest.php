<?php



namespace App\Tests\repositoryTest;
use App\Entity\Formation;
use App\Repository\FormationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of FormationRepositoryTest
 *
 * @author BEN BAHA
 */
class FormationRepositoryTest extends KernelTestCase{
     const TITLE= "php";

    /**
     * 
     * @return FormationRepository
     */
    public function recupRepository(): FormationRepository {
        self::bootKernel();
        $repository=self::getContainer()->get(FormationRepository::class);
        return $repository;

    }
     /**
     * 
     * @return Formation
     */
    public function newFormation(): Formation{
       return (new Formation())
                ->setTitle(self::TITLE)
                //->setDescription("nouvelle formation")
                //->setPlaylist("newply")
                ->setPublishedAt(new DateTime("now"));
    }
    public function testNbFormations(){
        $repository = $this->recupRepository();
        $nbFormations = $repository->count([]);
        $this->assertEquals(241, $nbFormations);
    }
     public function testAddFormation(){
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $nbFormations = $repository->count([]);
        $repository->add($formation, true);
        $this->assertEquals($nbFormations + 1, $repository->count([]), "erreur lors de l'ajout!!");
    }
     public function testRemoveFormation(){
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $repository->add($formation, true);
        $nbFormations = $repository->count([]);
        $repository->remove($formation, true);
        $this->assertEquals($nbFormations - 1, $repository->count([]), "erreur lors de la suppression!!");        
    }
     public function testFindByContainValue(){
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $repository->add($formation, true);
        $formations = $repository->findByContainValue("title", "UML");
        $this->assertEquals("UML : Diagramme de paquetages", $formations[0]->getTitle());
    }
    
}
