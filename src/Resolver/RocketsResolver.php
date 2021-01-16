<?php

namespace App\Resolver;

use App\Repository\RocketRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;


final class RocketsResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var RocketRepository
     */
    private $rocketRepository;

    /**
     *
     * @param RocketRepository $rocketRepository
     */
    public function __construct(RocketRepository $rocketRepository)
    {
        $this->rocketRepository = $rocketRepository;
    }

    /**
     * @return \App\Entity\Rocket
     */
    public function resolve()
    {
        return $this->rocketRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Rockets',
        ];
    }
}