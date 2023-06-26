<?php
use ApiPlatform\Metadata\ApiResource;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

#[ApiResource]
class controllerTest extends WebTestCase
{
    // Teste do controlador Index
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/produto/');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
        // $this->assertSelectorTextContains('h1', 'Produtos');
    }

    // Teste do controlador New
    public function testNew()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/produto/new');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Salvar')->form();
        $form['produto[nome]'] = 'Produto Teste';
        $form['produto[preco]'] = '10';

        $client->submit($form);

        $this->assertResponseRedirects('/produto/');
    }

    // Teste do controlador Show
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/produto/1');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $this->assertSelectorTextContains('h1', 'Detalhes do Produto');
        $this->assertSelectorTextContains('.produto-nome', 'Nome do Produto');
        $this->assertSelectorTextContains('.produto-preco', 'Preço do Produto');
    }

    // Teste do controlador Edit
    public function testEdit()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/produto/1/edit');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $this->assertSelectorTextContains('h1', 'Editar Produto');

        $form = $crawler->selectButton('Salvar')->form();
        $form['produto[nome]'] = 'Teste';
        $form['produto[preco]'] = '99';

        $client->submit($form);

        $this->assertResponseRedirects('/produto/1');
    }

    // Teste do controlador Delete
    public function testDelete()
    {
        $client = static::createClient();
        $csrfToken = $client->getContainer()->get('security.csrf.token_manager')->getToken('delete1');

        $client = static::createClient();
        $session = $client->getContainer()->get('session');
        $sessionId = 'meu_id_de_sessao';
        $session->setId($sessionId);
        $session->start();

        $client->request('POST', '/produto/1', [
            '_method' => 'DELETE',
            '_token' => $csrfToken,
        ]);

        $this->assertResponseRedirects('/produto');
    }

    // Testes Funcionais
    public function testCreateProductWithEmptyName()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('O campo de nome é obrigatório');

        $client = static::createClient();
        $crawler = $client->request('GET', '/product/create');

        $form = $crawler->selectButton('Salvar')->form();
        $form['produto[nome]'] = '';

        $client->submit($form);
    }

    public function testCreateProductWithNegativePrice()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('O preço não pode ser negativo');

        $client = static::createClient();
        $crawler = $client->request('GET', '/product/create');

        $form = $crawler->selectButton('Salvar')->form();
        $form['produto[preco]'] = '-10';

        $client->submit($form);
    }

    public function testEditProductWithEmptyName()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('O campo de nome é obrigatório');

        $client = static::createClient();
        $crawler = $client->request('GET', '/product/1/edit');

        $form = $crawler->selectButton('Salvar')->form();
        $form['produto[nome]'] = '';

        $client->submit($form);
    }

    public function testEditProductWithNegativePrice()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('O preço não pode ser negativo');

        $client = static::createClient();
        $crawler = $client->request('GET', '/product/1/edit');

        $form = $crawler->selectButton('Salvar')->form();
        $form['produto[preco]'] = '-10';

        $client->submit($form);
    }
}