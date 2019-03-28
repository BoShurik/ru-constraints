<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 15:31
 */

namespace BoShurik\Constraints\Tests;

use BoShurik\Constraints\Ks;
use BoShurik\Constraints\KsValidator;
use BoShurik\Constraints\Tests\Fixtures\BikModel;
use Symfony\Component\Validator\Exception\LogicException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class KsValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new KsValidator();
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
            ->setCode(Ks::INVALID_BIK_ERROR)
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
            ['30101810200000000827', '044030827'],
        ];
    }

    public function getInvalid()
    {
        return [
            ['0000000000000000000', '000000000', Ks::INVALID_LENGTH_ERROR],
            ['0123456789012345678', '000000000', Ks::INVALID_LENGTH_ERROR],
            ['1234567890123456789', '000000000', Ks::INVALID_LENGTH_ERROR],
            ['01234567890123456789', '000000000', Ks::INVALID_CHECKSUM_ERROR],
            ['12345678901234567890', '000000000', Ks::INVALID_CHECKSUM_ERROR],
            ['000000000000000000000', '000000000', Ks::INVALID_LENGTH_ERROR],
            ['012345678901234567890', '000000000', Ks::INVALID_LENGTH_ERROR],
            ['123456789012345678901', '000000000', Ks::INVALID_LENGTH_ERROR],
            ['40101810200000000827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30201810200000000827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30102810200000000827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30101820200000000827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30101810400000000827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30101810201000000827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30101810200010000827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30101810200000100827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30101810200000001827', '044030827', Ks::INVALID_CHECKSUM_ERROR],
            ['30101810200000000837', '044030827', Ks::INVALID_CHECKSUM_ERROR]
        ];
    }

    private function createConstraint(): Ks
    {
        return new Ks([
            'bikField' => 'bik',
            'charactersMessage' => 'message',
            'lengthMessage' => 'message',
            'bikMessage' => 'message',
            'checksumMessage' => 'message',
        ]);
    }
}