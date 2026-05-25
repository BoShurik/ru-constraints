<?php

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Ogrn extends Constraint
{
    public const INVALID_CHARACTERS_ERROR = '6681bb57-c132-4d7a-abdd-a20ff626af35';
    public const INVALID_LENGTH_ERROR = '8cdd6b87-a1e5-4f26-bb8f-c725709c9690';
    public const INVALID_CHECKSUM_ERROR = '55208d65-1147-45fe-9743-ee0cefafa926';

    public function __construct(
        public readonly string $charactersMessage = 'ОГРН может состоять только из цифр',
        public readonly string $lengthMessage = 'ОГРН может состоять только из 13 цифр',
        public readonly string $checksumMessage = 'Неправильное контрольное число',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct(null, $groups, $payload);
    }
}
