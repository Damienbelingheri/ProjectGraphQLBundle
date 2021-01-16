<?php

namespace App\Mutation;

use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use App\Entity\Astronaut;
use App\Entity\Team;
use App\Repository\AstronautRepository;
use App\Repository\GradeRepository;
use App\Repository\TeamRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Validator\InputValidator;
use Overblog\GraphQLBundle\Validator\ValidationNode;

final class AstronautMutation  implements MutationInterface, AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em, AstronautRepository $astronautRepository, TeamRepository $teamRepository, GradeRepository $gradeRepository)
    {
        $this->em = $em;
        $this->astronautRepository = $astronautRepository;
        $this->teamRepository = $teamRepository;
        $this->gradeRepository = $gradeRepository;
    }

    public function resolve(Argument $args,InputValidator $validator)
    #public function resolve(string $pseudo)
    {

        $input = $args['input'];
        // create new Astronaut
        $astronaute = new Astronaut();
  
        $grade = $this->gradeRepository->find($input['grade']);
        $team = $this->teamRepository->find($input['team']);
      
        if (!$team || !$grade){

            return ['content' =>'invalidate data'];
        }

        $astronaute->setPseudo($input['pseudo']);
        $astronaute->setGrade($grade);
        $astronaute->setTeam($team);

        $this->em->persist($astronaute);
        $this->em->flush();

        return ['content' => 'on est bon'];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewAstronaut',
        ];
    }

}


