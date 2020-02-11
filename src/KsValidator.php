<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 14:20
 */

namespace BoShurik\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\LogicException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class KsValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Ks|Constraint $constraint
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
                ->setCode(Ks::INVALID_CHARACTERS_ERROR)
                ->addViolation()
            ;

            return;
        }

        if (strlen($value) !== 20) {
            $this->context
                ->buildViolation($constraint->lengthMessage)
                ->setCode(Ks::INVALID_LENGTH_ERROR)
                ->addViolation()
            ;

            return;
        }

        $object = $this->context->getObject();
        if (!is_object($object)) {
            throw new LogicException('Can\'t access validated object to get BIK value');
        }

        // TODO: symfony/property-access?
        $method = $constraint->bikField;
        if (method_exists($object, $method)) {
            $bik = $object->$method();
        } else {
            $bik = $object->$method;
        }

        if ($bik === null) {
            $this->context
                ->buildViolation($constraint->bikMessage)
                ->setCode(Ks::INVALID_BIK_ERROR)
                ->addViolation()
            ;

            return;
        }

        $checkString = '0' . substr((string) $bik, -5, 2) . $value;
        $checksum = 0;
        foreach ([7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1] as $i => $k) {
            $checksum += $k * ((int) $checkString[$i] % 10);
        }

        if ($checksum % 10 !== 0) {
            $this->context
                ->buildViolation($constraint->checksumMessage)
                ->setCode(Ks::INVALID_CHECKSUM_ERROR)
                ->addViolation()
            ;
        }
    }
}