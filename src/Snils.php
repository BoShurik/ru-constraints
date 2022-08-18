<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 14:11
 */

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
#[\Attribute]
class Snils extends Constraint
{
    const INVALID_CHARACTERS_ERROR = '637a1f13-6dde-4c30-8e79-04f85db99391';
    const INVALID_LENGTH_ERROR = '0e549a72-989a-43e0-892b-7398a27cd1fd';
    const INVALID_CHECKSUM_ERROR = 'c7427637-5c7d-4af4-b273-e02e98e92a1d';

    public $charactersMessage = 'СНИЛС может состоять только из цифр';

    public $lengthMessage = 'СНИЛС может состоять только из 11 цифр';

    public $checksumMessage = 'Неправильное контрольное число';
}