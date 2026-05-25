<?php

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Kpp extends Constraint
{
    public const INVALID_LENGTH_ERROR = 'cd361248-c25e-4b27-83d2-bd2de908d7e5';
    public const INVALID_FORMAT_ERROR = 'd5d40c20-6ce6-4b26-a293-8e332fa6ad44';

    public function __construct(
        public readonly string $lengthMessage = 'КПП может состоять только из 9 знаков (цифр или заглавных букв латинского алфавита от A до Z)',
        public readonly string $formatMessage = 'Неправильный формат КПП',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct(null, $groups, $payload);
    }
}
