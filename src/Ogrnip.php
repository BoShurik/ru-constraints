<?php

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Ogrnip extends Constraint
{
    public const INVALID_CHARACTERS_ERROR = 'ed045b90-e842-4e2a-b321-47ce56b0b0f5';
    public const INVALID_LENGTH_ERROR = '01b3cfc0-1bb4-4880-b7bd-ec265accd97d';
    public const INVALID_CHECKSUM_ERROR = '786bed94-0a84-479f-a59c-5f916fb62821';

    public function __construct(
        public readonly string $charactersMessage = 'ОГРНИП может состоять только из цифр',
        public readonly string $lengthMessage = 'ОГРНИП может состоять только из 15 цифр',
        public readonly string $checksumMessage = 'Неправильное контрольное число',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct(null, $groups, $payload);
    }
}
