<?php

namespace App\Resolver;

use App\Repository\TeamRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;


final class TeamResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     *
     * @param TeamRepository $teamRepository
     */
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * @return \App\Entity\Team
     */
    public function resolve(int $id)
    {
        return $this->teamRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Team',
        ];
    }
}