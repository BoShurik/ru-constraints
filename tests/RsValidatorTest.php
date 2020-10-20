<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 15:32
 */

namespace BoShurik\Constraints\Ru\Tests;

use BoShurik\Constraints\Ru\Rs;
use BoShurik\Constraints\Ru\RsValidator;
use BoShurik\Constraints\Ru\Tests\Fixtures\BikModel;
use Symfony\Component\Validator\Exception\LogicException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class RsValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new RsValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, $this->createConstraint());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', $this->createConstraint());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(new \stdClass(), $this->createConstraint());
    }

    public function testInaccessibleBik()
    {
        $this->expectException(LogicException::class);

        $this->validator->validate('00000000000000000000', $this->createConstraint());
    }

    public function testEmptyBik()
    {
        $this->setObject(new BikModel());
        $this->validator->validate('00000000000000000000', $this->createConstraint());

        $this->buildViolation('message')
            ->setCode(Rs::INVALID_BIK_ERROR)
            ->assertRaised()
        ;
    }

    /**
     * @dataProvider getValid
     */
    public function testValid($value, $bik)
    {
        $this->setObject(new BikModel($bik));
        $this->validator->validate($value, $this->createConstraint());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalid
     */
    public function testInvalid($value, $bik, $code)
    {
        $this->setObject(new BikModel($bik));
        $this->validator->validate($value, $this->createConstraint());

        $this->buildViolation('message')
            ->setCode($code)
            ->assertRaised()
        ;
    }

    public function getValid()
    {
        return [
            ['00000000000000000000', '000000000'],
            ['40702810900000002851', '044030827'],
        ];
    }

    public function getInvalid()
    {
        return [
            ['0000000000000000000', '000000000', Rs::INVALID_LENGTH_ERROR],
            ['0123456789012345678', '000000000', Rs::INVALID_LENGTH_ERROR],
            ['1234567890123456789', '000000000', Rs::INVALID_LENGTH_ERROR],
            ['01234567890123456789', '000000000', Rs::INVALID_CHECKSUM_ERROR],
            ['12345678901234567890', '000000000', Rs::INVALID_CHECKSUM_ERROR],
            ['000000000000000000000', '000000000', Rs::INVALID_LENGTH_ERROR],
            ['012345678901234567890', '000000000', Rs::INVALID_LENGTH_ERROR],
            ['123456789012345678901', '000000000', Rs::INVALID_LENGTH_ERROR],
            ['50702810900000002851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40802810900000002851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40703810900000002851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40702820900000002851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40702810000000002851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40702810901000002851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40702810900010002851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40702810900000102851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40702810900000003851', '044030827', Rs::INVALID_CHECKSUM_ERROR],
            ['40702810900000002861', '044030827', Rs::INVALID_CHECKSUM_ERROR]
        ];
    }

    private function createConstraint(): Rs
    {
        return new Rs([
            'bikField' => 'bik',
            'charactersMessage' => 'message',
            'lengthMessage' => 'message',
            'bikMessage' => 'message',
            'checksumMessage' => 'message',
        ]);
    }
}