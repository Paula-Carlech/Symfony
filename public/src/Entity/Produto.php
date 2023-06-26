<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource]
class Produto
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type:'integer')]
    #[Assert\Isbn]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length:100)]
    #[Assert\NotNull]
    private ?string $nome = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotNull]
    private ?float $preco = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        if (empty($nome)) {
            throw new \DomainException('O campo de nome é obrigatório');
        }

        $this->nome = $nome;

        return $this;
    }

    public function getPreco(): ?float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): self
    {
        if ($preco < 0) {
            throw new \DomainException('O preço não pode ser negativo');
        }

        $this->preco = $preco;

        return $this;
    }
}