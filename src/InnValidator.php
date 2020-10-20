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

class InnValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Inn|Constraint $constraint
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
                ->setCode(Inn::INVALID_CHARACTERS_ERROR)
                ->addViolation()
            ;

            return;
        }

        $length = strlen($value);
        if (!in_array($length, [10, 12])) {
            $this->context
                ->buildViolation($constraint->lengthMessage)
                ->setCode(Inn::INVALID_LENGTH_ERROR)
                ->addViolation()
            ;

            return;
        }

        if ($length === 10) {
            $n10 = $this->checksum($value, [2, 4, 10, 3, 5, 9, 4, 6, 8]);
            if ($n10 !== (int) $value[9]) {
                $this->context
                    ->buildViolation($constraint->checksumMessage)
                    ->setCode(Inn::INVALID_CHECKSUM_ERROR)
                    ->addViolation()
                ;

                return;
            }
        } else {
            $n11 = $this->checksum($value, [7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
            $n12 = $this->checksum($value, [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
            if (($n11 !== (int) $value[10]) || ($n12 !== (int) $value[11])) {
                $this->context
                    ->buildViolation($constraint->checksumMessage)
                    ->setCode(Inn::INVALID_CHECKSUM_ERROR)
                    ->addViolation()
                ;

                return;
            }
        }
    }

    /**
     * @param string $value
     * @param array $coefficients
     * @return int
     */
    private function checksum(string $value, array $coefficients): int
    {
        $n = 0;
        foreach ($coefficients as $i => $k) {
            $n += $k * (int) $value[$i];
        }
        return $n % 11 % 10;
    }
}