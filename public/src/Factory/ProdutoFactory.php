<?php

namespace App\Factory;

use App\Entity\Produto;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Produto>
 *
 * @method        Produto|Proxy                    create(array|callable $attributes = [])
 * @method static Produto|Proxy                    createOne(array $attributes = [])
 * @method static Produto|Proxy                    find(object|array|mixed $criteria)
 * @method static Produto|Proxy                    findOrCreate(array $attributes)
 * @method static Produto|Proxy                    first(string $sortedField = 'id')
 * @method static Produto|Proxy                    last(string $sortedField = 'id')
 * @method static Produto|Proxy                    random(array $attributes = [])
 * @method static Produto|Proxy                    randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Produto[]|Proxy[]                all()
 * @method static Produto[]|Proxy[]                createMany(int $number, array|callable $attributes = [])
 * @method static Produto[]|Proxy[]                createSequence(iterable|callable $sequence)
 * @method static Produto[]|Proxy[]                findBy(array $attributes)
 * @method static Produto[]|Proxy[]                randomRange(int $min, int $max, array $attributes = [])
 * @method static Produto[]|Proxy[]                randomSet(int $number, array $attributes = [])
 */
final class ProdutoFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'nome' => self::faker()->text(100),
            'preco' => self::faker()->randomFloat(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Produto $produto): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Produto::class;
    }
}
