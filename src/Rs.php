<?php

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Rs extends Constraint
{
    public const INVALID_CHARACTERS_ERROR = '4b246ead-4b5f-4fc2-858b-fcab08e7f1a6';
    public const INVALID_LENGTH_ERROR = '2d49d3bb-9ddd-4ccb-976d-f7070064b154';
    public const INVALID_BIK_ERROR = '068ba901-130a-4b4c-a447-21ec17b81857';
    public const INVALID_CHECKSUM_ERROR = 'ec8a11b6-8d8d-4ee0-9800-1ba948150cdb';

    public function __construct(
        public readonly string $bikField,
        public readonly string $charactersMessage = 'Р/С может состоять только из цифр',
        public readonly string $lengthMessage = 'Р/С может состоять только из 20 цифр',
        public readonly string $bikMessage = 'Неизвестный БИК',
        public readonly string $checksumMessage = 'Неправильное контрольное число',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct(null, $groups, $payload);
    }
}
