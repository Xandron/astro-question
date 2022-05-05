<?php


namespace App\Validator;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class AstrologerValidator implements ValidatorInterface
{
    /**
     * @param array $request
     * @return ConstraintViolationListInterface
     */
    public function validation(array $request): ConstraintViolationListInterface
    {
        $constrains = [
            new NotBlank(),
            new NotNull()
        ];

        return Validation::createValidator()->validate($request, $constrains);
    }
}