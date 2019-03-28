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
class Bik extends Constraint
{
    const INVALID_CHARACTERS_ERROR = '2a6efd25-e8a9-42c2-b49f-fe0bb96e7c0f';
    const INVALID_LENGTH_ERROR = 'd58e4a4b-c5d9-4970-b136-bd0f3ef09faf';

    public $charactersMessage = 'БИК может состоять только из цифр';

    public $lengthMessage = 'БИК может состоять только из 9 цифр';
}