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

class KppValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Kpp|Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (strlen($value) !== 9) {
            $this->context
                ->buildViolation($constraint->lengthMessage)
                ->setCode(Kpp::INVALID_LENGTH_ERROR)
                ->addViolation()
            ;

            return;
        }

        if (!preg_match('/^[0-9]{4}[0-9A-Z]{2}[0-9]{3}$/', $value)) {
            $this->context
                ->buildViolation($constraint->formatMessage)
                ->setCode(Kpp::INVALID_FORMAT_ERROR)
                ->addViolation()
            ;

            return;
        }
    }
}