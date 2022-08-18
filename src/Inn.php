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
class Inn extends Constraint
{
    const INVALID_CHARACTERS_ERROR = '2d61d696-31af-458f-a81c-1bb97cf34a98';
    const INVALID_LENGTH_ERROR = '9892e32a-0747-4d72-8f79-320338ac2840';
    const INVALID_CHECKSUM_ERROR = '24b948d5-8ac8-4a85-a6be-283e6706019c';

    public $charactersMessage = 'ИНН может состоять только из цифр';

    public $lengthMessage = 'ИНН может состоять только из 10 или 12 цифр';

    public $checksumMessage = 'Неправильное контрольное число';
}