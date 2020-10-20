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

class OgrnValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Ogrn|Constraint $constraint
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
                ->setCode(Ogrn::INVALID_CHARACTERS_ERROR)
                ->addViolation()
            ;

            return;
        }

        if (strlen($value) !== 13) {
            $this->context
                ->buildViolation($constraint->lengthMessage)
                ->setCode(Ogrn::INVALID_LENGTH_ERROR)
                ->addViolation()
            ;

            return;
        }

        $n13 = (int) substr(bcsub(substr($value, 0, -1), bcmul(bcdiv(substr($value, 0, -1), '11', 0), '11')), -1);
        if ($n13 !== (int) $value[12]) {
            $this->context
                ->buildViolation($constraint->checksumMessage)
                ->setCode(Ogrn::INVALID_CHECKSUM_ERROR)
                ->addViolation()
            ;
        }
    }
}