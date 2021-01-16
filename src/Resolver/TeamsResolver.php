<?php

namespace App\Resolver;

use App\Repository\TeamRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;


final class TeamsResolver implements ResolverInterface, AliasedInterface
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
     *
     */
    public function resolve()
    {
        return $this->teamRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Teams',
        ];
    }
}