<?php



namespace App\Tests\controllerTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PlaylistControllerTest
 *
 * @author BEN BAHA
 */
class PlaylistControllerTest extends WebTestCase{
    public function testShowOne()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlists/playlist/24');
        $this->assertStringContainsString('Cours UML', $client->getResponse()->getContent());

    }
    public function testSort(){
    $client = static::createClient();
    $client->request('GET', '/playlists/tri/name/ASC');

    $this->assertStringContainsString('name', $client->getResponse()->getContent());
    $this->assertStringContainsString('ASC', $client->getResponse()->getContent());
    }
}
