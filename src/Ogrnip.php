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
class Ogrnip extends Constraint
{
    const INVALID_CHARACTERS_ERROR = 'ed045b90-e842-4e2a-b321-47ce56b0b0f5';
    const INVALID_LENGTH_ERROR = '01b3cfc0-1bb4-4880-b7bd-ec265accd97d';
    const INVALID_CHECKSUM_ERROR = '786bed94-0a84-479f-a59c-5f916fb62821';

    public $charactersMessage = 'ОГРНИП может состоять только из цифр';

    public $lengthMessage = 'ОГРНИП может состоять только из 15 цифр';

    public $checksumMessage = 'Неправильное контрольное число';
}