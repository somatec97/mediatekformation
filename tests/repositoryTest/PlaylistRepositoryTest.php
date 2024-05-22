<?php


namespace App\Tests\repositoryTest;
use App\Entity\Formation;
use App\Entity\Playlist;
use App\Repository\PlaylistRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of PlaylistRepositoryTest
 *
 * @author BEN BAHA
 */
class PlaylistRepositoryTest extends KernelTestCase {
    /**
     * 
     * @return PlaylistRepository
     */
    public function recupRepository(): PlaylistRepository {
        self::bootKernel();
        $repository=self::getContainer()->get(PlaylistRepository::class);
        return $repository;

    }
    /**
     * 
     * @return Playlist
     */
    public function newPlaylist(): Playlist{
       return (new Playlist())
                ->setName("newply")
               ->setDescription("new playlist");
    }
    public function testNbPlaylists(){
        $repository = $this->recupRepository();
        $nbPlaylists = $repository->count([]);
        $this->assertEquals(28, $nbPlaylists);
    }
    public function testAddPlaylist(){
        $repository = $this->recupRepository();
        $playlist = $this->newPlaylist ();
        $nbPlaylists = $repository->count([]);
        $repository->add($playlist, true);
        $this->assertEquals($nbPlaylists + 1, $repository->count([]), "erreur lors de l'ajout!!");
    }
    public function testRemovePlaylist(){
        $repository = $this->recupRepository();
        $playlist = $this->newPlaylist();
        $repository->add($playlist, true);
        $nbPlaylists = $repository->count([]);
        $repository->remove($playlist, true);
        $this->assertEquals($nbPlaylists - 1, $repository->count([]), "erreur lors de la suppression!!");        
    }
    
}
