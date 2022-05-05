<?php


namespace App\Validator;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class OrderValidator implements ValidatorInterface
{
    /**
     * @param array $request
     * @return ConstraintViolationListInterface
     */
    public function validation(array $request): ConstraintViolationListInterface
    {
        $fields = [
            'name'                  => [new NotBlank(), new NotNull()],
            'email'                 => [new NotBlank(), new NotNull(), new Email()],
            'address'               => [new NotBlank(), new NotNull()],
            'astrologer_service_id' => [new NotBlank(), new NotNull()],
        ];

        return Validation::createValidator()->validate($request, new Collection(['fields' => $fields]) );
    }
}