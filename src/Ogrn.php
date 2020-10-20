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
class Ogrn extends Constraint
{
    const INVALID_CHARACTERS_ERROR = '6681bb57-c132-4d7a-abdd-a20ff626af35';
    const INVALID_LENGTH_ERROR = '8cdd6b87-a1e5-4f26-bb8f-c725709c9690';
    const INVALID_CHECKSUM_ERROR = '55208d65-1147-45fe-9743-ee0cefafa926';

    public $charactersMessage = 'ОГРН может состоять только из цифр';

    public $lengthMessage = 'ОГРН может состоять только из 13 цифр';

    public $checksumMessage = 'Неправильное контрольное число';
}