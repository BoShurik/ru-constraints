<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 15:32
 */

namespace BoShurik\Constraints\Tests;

use BoShurik\Constraints\Ogrnip;
use BoShurik\Constraints\OgrnipValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class OgrnipValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new OgrnipValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Ogrnip());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Ogrnip());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(new \stdClass(), new Ogrnip());
    }

    /**
     * @dataProvider getValid
     */
    public function testValid($value)
    {
        $this->validator->validate($value, new Ogrnip());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalid
     */
    public function testInvalid($value, $code)
    {
        $constraint = new Ogrnip([
            'charactersMessage' => 'message',
            'lengthMessage' => 'message',
            'checksumMessage' => 'message',
        ]);

        $this->validator->validate($value, $constraint);

        $this->buildViolation('message')
            ->setCode($code)
            ->assertRaised()
        ;
    }

    public function getValid()
    {
        return [
            ['000000000000000'],
            ['307760324100018'],
        ];
    }

    public function getInvalid()
    {
        return [
            ['qwerty', Ogrnip::INVALID_CHARACTERS_ERROR],
            ['00000000000000', Ogrnip::INVALID_LENGTH_ERROR],
            ['01234567890123', Ogrnip::INVALID_LENGTH_ERROR],
            ['12345678901234', Ogrnip::INVALID_LENGTH_ERROR],
            ['012345678901234', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['123456789012345', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['0000000000000000', Ogrnip::INVALID_LENGTH_ERROR],
            ['0123456789012345', Ogrnip::INVALID_LENGTH_ERROR],
            ['1234567890123456', Ogrnip::INVALID_LENGTH_ERROR],
            ['407760324100018', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['308760324100018', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['307770324100018', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['307760424100018', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['307760325100018', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['307760324110018', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['307760324100118', Ogrnip::INVALID_CHECKSUM_ERROR],
            ['307760324100019', Ogrnip::INVALID_CHECKSUM_ERROR],
        ];
    }
}