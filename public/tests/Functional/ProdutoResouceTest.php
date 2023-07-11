<?php

namespace App\Tests\Functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class ProdutoResourceTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    public function testGetProdutosCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/produtos');

        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }

    public function testGetProduto(): void
    {
        $response = static::createClient()->request('GET', '/api/produtos/1');

        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }

    public function testCreateProduto(): void
    {
        $response = static::createClient()->request('POST', '/api/produtos', [], [], ['CONTENT_TYPE' => 'application/json'], '{"nome": "Produto 1", "preco": 10}');

        $this->assertResponseStatusCodeSame(201);
        $this->assertJson($response->getContent());
    }

    public function testUpdateProduto(): void
    {
        $response = static::createClient()->request('PUT', '/api/produtos/1', [], [], ['CONTENT_TYPE' => 'application/json'], '{"nome": "Produto Atualizado", "preco": 15}');

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteProduto(): void
    {
        $response = static::createClient()->request('DELETE', '/api/produtos/1');

        $this->assertResponseStatusCodeSame(204);
    }
}
