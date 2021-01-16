<?php

namespace App\Resolver;

use App\Entity\Astronaut;
use App\Repository\RocketRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;


final class RocketResolver implements ResolverInterface, AliasedInterface
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

    public function resolveInAstronaut(Astronaut $astronaut, $args, $context, $info)
    {
        return $this->rocketRepository->findByAstronaut($astronaut->getId());
    }

    /**
     * @return \App\Entity\Rocket
     */
    public function resolve(int $id)
    {
        return $this->rocketRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Rocket',
        ];
    }
}