<?php

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Ks extends Constraint
{
    public const INVALID_CHARACTERS_ERROR = '0cf6ce0b-40d4-4275-b3ad-ac8dd447d2ed';
    public const INVALID_LENGTH_ERROR = 'ed77bba0-057e-49ad-a9fa-30dc5733dad2';
    public const INVALID_BIK_ERROR = '9ca93c74-5894-4b84-a885-d85e89910fac';
    public const INVALID_CHECKSUM_ERROR = 'adf482e6-aada-40ab-afdc-c5eede3c9188';

    public function __construct(
        public readonly string $bikField,
        public readonly string $charactersMessage = 'К/С может состоять только из цифр',
        public readonly string $lengthMessage = 'К/С может состоять только из 20 цифр',
        public readonly string $bikMessage = 'Неизвестный БИК',
        public readonly string $checksumMessage = 'Неправильное контрольное число',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct(null, $groups, $payload);
    }
}
