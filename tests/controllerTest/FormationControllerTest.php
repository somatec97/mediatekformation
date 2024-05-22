<?php

namespace App\Tests\controllerTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of FormationControllerTest
 *
 * @author BEN BAHA
 */
class FormationControllerTest extends WebTestCase {
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/formations');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    public function testFindAllContain()
    {
        $client = static::createClient();
        $client->request('GET', '/formations/name/playlist', ['recherche' => 'valeur']);

        $this->assertStringContainsString('valeur', $client->getResponse()->getContent());

    }
    
}
