<?php
use PHPUnit\Framework\TestCase;
use App\Entity\Produto;

class produtoTest extends TestCase {

    // Verifica os métodos get e set
    public function testGetSetNome()
    {
        $produto = new Produto();
        $nome = "Gabinete";
        $produto->setNome($nome);

        $this->assertEquals($nome, $produto->getNome());
    }

    public function testGetSetPreco()
    {
        $produto = new Produto();
        $preco = 300;
        $produto->setPreco($preco);

        $this->assertEquals($preco, $produto->getPreco());
    }

    // Testes Funcionais
    public function testSetNomeVazio()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('O campo de nome é obrigatório');

        $produto = new Produto();
        $nome = "";

        $produto->setNome($nome);
    }

    public function testSetPrecoNegativo()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('O preço não pode ser negativo');

        $produto = new Produto();
        $preco = -10;

        $produto->setPreco($preco);
    }
}