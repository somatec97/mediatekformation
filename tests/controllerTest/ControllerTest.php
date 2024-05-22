<?php


namespace App\Tests\controllerTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of ControllerTest
 *
 * @author BEN BAHA
 */
class ControllerTest extends WebTestCase{
    public function testAccessPage() {
       $client = static::createClient();
       $client->request('GET', '/');
       $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
    }
}
