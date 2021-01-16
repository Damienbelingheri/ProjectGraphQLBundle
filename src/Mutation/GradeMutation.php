<?php

namespace App\Mutation;

use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use App\Entity\Grade;
use App\Repository\GradeRepository;
use App\Repository\TeamRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Validator\InputValidator;

final class GradeMutation implements MutationInterface, AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em, GradeRepository $gradeRepository)
    {
        $this->em = $em;
        $this->gradeRepository = $gradeRepository;
    }



    public function resolve(Argument $args)
    #public function resolve(string $pseudo)
    {
        // ...

        return ['content' => 'on est bon'];
    }


    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewGrade',
        ];
    }
}