<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 14:10
 */

namespace BoShurik\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Ks extends Constraint
{
    const INVALID_CHARACTERS_ERROR = '0cf6ce0b-40d4-4275-b3ad-ac8dd447d2ed';
    const INVALID_LENGTH_ERROR = 'ed77bba0-057e-49ad-a9fa-30dc5733dad2';
    const INVALID_BIK_ERROR = '9ca93c74-5894-4b84-a885-d85e89910fac';
    const INVALID_CHECKSUM_ERROR = 'adf482e6-aada-40ab-afdc-c5eede3c9188';

    public $bikField;

    public $charactersMessage = 'К/С может состоять только из цифр';

    public $lengthMessage = 'К/С может состоять только из 20 цифр';

    public $bikMessage = 'Неизвестный БИК';

    public $checksumMessage = 'Неправильное контрольное число';

    /**
     * @inheritDoc
     */
    public function getRequiredOptions()
    {
        return ['bikField'];
    }
}