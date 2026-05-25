<?php

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Bik extends Constraint
{
    public const INVALID_CHARACTERS_ERROR = '2a6efd25-e8a9-42c2-b49f-fe0bb96e7c0f';
    public const INVALID_LENGTH_ERROR = 'd58e4a4b-c5d9-4970-b136-bd0f3ef09faf';

    public function __construct(
        public readonly string $charactersMessage = 'БИК может состоять только из цифр',
        public readonly string $lengthMessage = 'БИК может состоять только из 9 цифр',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct(null, $groups, $payload);
    }
}
