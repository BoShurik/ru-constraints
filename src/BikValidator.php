<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 14:19
 */

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class BikValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Bik|Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (preg_match('/[^0-9]/', $value)) {
            $this->context
                ->buildViolation($constraint->charactersMessage)
                ->setCode(Bik::INVALID_CHARACTERS_ERROR)
                ->addViolation()
            ;
        } elseif (strlen($value) !== 9) {
            $this->context
                ->buildViolation($constraint->lengthMessage)
                ->setCode(Bik::INVALID_LENGTH_ERROR)
                ->addViolation()
            ;
        }
    }
}