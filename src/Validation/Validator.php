<?php

namespace App\Validation;

use App\Repository\GradeRepository;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Overblog\GraphQLBundle\Validator\ValidationNode;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

// ...
class Validator {

    public function __construct(GradeRepository $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }

    public static function validate(ValidationNode $object, ExecutionContextInterface $context, $payload)
    {  

    }

    public function getAll(){
        dd( $this->gradeRepository->findAll());
       // return [1,2];

    }

    public function getAllGrade(){
        
        return $this->gradeRepository->findAll();
    }

}