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

    public function resolve(Argument $args)
    #public function resolve(string $pseudo)
    {

        
        //dd('coucou');
        $input = $args['input'];
        // create new Astronaut
        $astronaute = new Astronaut();
        $astronaute->setPseudo($input['pseudo']);
        
        $grade = $this->gradeRepository->find($input['grade']);
        $astronaute->setGrade($grade);

        $team = $this->teamRepository->find($input['team']);
        $astronaute->setTeam($team);

        

        $this->em->persist($astronaute);
        $this->em->flush();

        return ['content' => 'on est bon'];
    }

    public function getAll(){

        return [1,2];
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


