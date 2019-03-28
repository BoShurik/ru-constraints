<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 14:11
 */

namespace BoShurik\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Rs extends Constraint
{
    const INVALID_CHARACTERS_ERROR = '4b246ead-4b5f-4fc2-858b-fcab08e7f1a6';
    const INVALID_LENGTH_ERROR = '2d49d3bb-9ddd-4ccb-976d-f7070064b154';
    const INVALID_BIK_ERROR = '068ba901-130a-4b4c-a447-21ec17b81857';
    const INVALID_CHECKSUM_ERROR = 'ec8a11b6-8d8d-4ee0-9800-1ba948150cdb';

    public $bikField;

    public $charactersMessage = 'Р/С может состоять только из цифр';

    public $lengthMessage = 'Р/С может состоять только из 20 цифр';

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