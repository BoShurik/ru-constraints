<?php

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Inn extends Constraint
{
    public const INVALID_CHARACTERS_ERROR = '2d61d696-31af-458f-a81c-1bb97cf34a98';
    public const INVALID_LENGTH_ERROR = '9892e32a-0747-4d72-8f79-320338ac2840';
    public const INVALID_CHECKSUM_ERROR = '24b948d5-8ac8-4a85-a6be-283e6706019c';

    public function __construct(
        public readonly string $charactersMessage = 'ИНН может состоять только из цифр',
        public readonly string $lengthMessage = 'ИНН может состоять только из 10 или 12 цифр',
        public readonly string $checksumMessage = 'Неправильное контрольное число',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct(null, $groups, $payload);
    }
}
