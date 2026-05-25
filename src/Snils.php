<?php

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Snils extends Constraint
{
    public const INVALID_CHARACTERS_ERROR = '637a1f13-6dde-4c30-8e79-04f85db99391';
    public const INVALID_LENGTH_ERROR = '0e549a72-989a-43e0-892b-7398a27cd1fd';
    public const INVALID_CHECKSUM_ERROR = 'c7427637-5c7d-4af4-b273-e02e98e92a1d';

    public function __construct(
        public readonly string $charactersMessage = 'СНИЛС может состоять только из цифр',
        public readonly string $lengthMessage = 'СНИЛС может состоять только из 11 цифр',
        public readonly string $checksumMessage = 'Неправильное контрольное число',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct(null, $groups, $payload);
    }
}
