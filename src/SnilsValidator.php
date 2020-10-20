<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 14:20
 */

namespace BoShurik\Constraints\Ru;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class SnilsValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Snils|Constraint $constraint
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
                ->setCode(Snils::INVALID_CHARACTERS_ERROR)
                ->addViolation()
            ;

            return;
        }

        if (strlen($value) !== 11) {
            $this->context
                ->buildViolation($constraint->lengthMessage)
                ->setCode(Snils::INVALID_LENGTH_ERROR)
                ->addViolation()
            ;

            return;
        }

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $value[$i] * (9 - $i);
        }
        $check = 0;
        if ($sum < 100) {
            $check = $sum;
        } elseif ($sum > 101) {
            $check = $sum % 101;
            if ($check === 100) {
                $check = 0;
            }
        }
        if ($check !== (int) substr($value, -2)) {
            $this->context
                ->buildViolation($constraint->checksumMessage)
                ->setCode(Snils::INVALID_CHECKSUM_ERROR)
                ->addViolation()
            ;
        }
    }
}