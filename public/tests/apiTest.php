<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class apiTest extends WebTestCase
{

    public function testGetProdutosCollection(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/produtos');
        
        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetProduto(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/produtos/1');
        
        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCreateProduto(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/produtos', [], [], ['CONTENT_TYPE' => 'application/json'], '{"nome": "Produto 1", "preco": 10}');
        
        $this->assertResponseStatusCodeSame(201);
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testUpdateProduto(): void
    {
        $client = static::createClient();
        $client->request('PUT', '/api/produtos/1', [], [], ['CONTENT_TYPE' => 'application/json'], '{"nome": "Produto Atualizado", "preco": 15}');
        
        $this->assertResponseIsSuccessful();
    }

    public function testDeleteProduto(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/produtos/1');
        
        $this->assertResponseStatusCodeSame(204);
    }

}
