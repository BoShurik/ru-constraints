<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 14:10
 */

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
#[\Attribute]
class Kpp extends Constraint
{
    const INVALID_LENGTH_ERROR = 'cd361248-c25e-4b27-83d2-bd2de908d7e5';
    const INVALID_FORMAT_ERROR = 'd5d40c20-6ce6-4b26-a293-8e332fa6ad44';

    public $lengthMessage = 'КПП может состоять только из 9 знаков (цифр или заглавных букв латинского алфавита от A до Z)';

    public $formatMessage = 'Неправильный формат КПП';
}