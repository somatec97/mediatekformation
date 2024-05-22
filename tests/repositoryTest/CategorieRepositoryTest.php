<?php



namespace App\Tests\repositoryTest;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of CategorieRepositoryTest
 *
 * @author BEN BAHA
 */
class CategorieRepositoryTest extends KernelTestCase{
    public function recupRepository(): CategorieRepository{
        self::bootKernel();
        $repository = self::getContainer()->get(CategorieRepository::class);
        return $repository;
    }
    public function newCategorie(): Categorie{
        $categorie = (new Categorie())
                ->setName("CATEGORIE TEST");
        return $categorie;
    }
    public function testAddCategorie(){
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $nbCategories = $repository->count([]);
        $repository->add($categorie, true);
        $this->assertEquals($nbCategories + 1, $repository->count([]), "erreur lors de l'ajout");
    }
     public function testNbCategories(){
        $repository = $this->recupRepository();
        $nbCategories = $repository->count([]);
        $this->assertEquals(12, $nbCategories);
    }
    public function testRemoveCategorie(){
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $repository->add($categorie, true);
        $nbCategories = $repository->count([]);
        $repository->remove($categorie, true);
        $this->assertEquals($nbCategories - 1, $repository->count([]), "erreur lors de la suppression");
    }
}
