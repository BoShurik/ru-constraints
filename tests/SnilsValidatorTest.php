<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 15:32
 */

namespace BoShurik\Constraints\Tests;

use BoShurik\Constraints\Snils;
use BoShurik\Constraints\SnilsValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class SnilsValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new SnilsValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Snils());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Snils());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(new \stdClass(), new Snils());
    }

    /**
     * @dataProvider getValid
     */
    public function testValid($value)
    {
        $this->validator->validate($value, new Snils());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalid
     */
    public function testInvalid($value, $code)
    {
        $constraint = new Snils([
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
            ['00000000000'],
            ['08765430300'],
        ];
    }

    public function getInvalid()
    {
        return [
            ['qwerty', Snils::INVALID_CHARACTERS_ERROR],
            ['0000000000', Snils::INVALID_LENGTH_ERROR],
            ['0123456789', Snils::INVALID_LENGTH_ERROR],
            ['1234567890', Snils::INVALID_LENGTH_ERROR],
            ['01234567890', Snils::INVALID_CHECKSUM_ERROR],
            ['12345678901', Snils::INVALID_CHECKSUM_ERROR],
            ['000000000000', Snils::INVALID_LENGTH_ERROR],
            ['012345678901', Snils::INVALID_LENGTH_ERROR],
            ['123456789012', Snils::INVALID_LENGTH_ERROR],
            ['18765430300', Snils::INVALID_CHECKSUM_ERROR],
            ['08865430300', Snils::INVALID_CHECKSUM_ERROR],
            ['08766430300', Snils::INVALID_CHECKSUM_ERROR],
            ['08765440300', Snils::INVALID_CHECKSUM_ERROR],
            ['08765430400', Snils::INVALID_CHECKSUM_ERROR],
            ['08765430301', Snils::INVALID_CHECKSUM_ERROR],
        ];
    }
}