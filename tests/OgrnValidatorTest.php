<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 15:32
 */

namespace BoShurik\Constraints\Tests;

use BoShurik\Constraints\Ogrn;
use BoShurik\Constraints\OgrnValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class OgrnValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new OgrnValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Ogrn());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Ogrn());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(new \stdClass(), new Ogrn());
    }

    /**
     * @dataProvider getValid
     */
    public function testValid($value)
    {
        $this->validator->validate($value, new Ogrn());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalid
     */
    public function testInvalid($value, $code)
    {
        $constraint = new Ogrn([
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
            ['0000000000000'],
            ['1027812400868'],
        ];
    }

    public function getInvalid()
    {
        return [
            ['qwerty', Ogrn::INVALID_CHARACTERS_ERROR],
            ['000000000000', Ogrn::INVALID_LENGTH_ERROR],
            ['012345678901', Ogrn::INVALID_LENGTH_ERROR],
            ['123456789012', Ogrn::INVALID_LENGTH_ERROR],
            ['0123456789012', Ogrn::INVALID_CHECKSUM_ERROR],
            ['1234567890123', Ogrn::INVALID_CHECKSUM_ERROR],
            ['00000000000000', Ogrn::INVALID_LENGTH_ERROR],
            ['01234567890123', Ogrn::INVALID_LENGTH_ERROR],
            ['12345678901234', Ogrn::INVALID_LENGTH_ERROR],
            ['2027812400868', Ogrn::INVALID_CHECKSUM_ERROR],
            ['1037812400868', Ogrn::INVALID_CHECKSUM_ERROR],
            ['1027912400868', Ogrn::INVALID_CHECKSUM_ERROR],
            ['1027813400868', Ogrn::INVALID_CHECKSUM_ERROR],
            ['1027812410868', Ogrn::INVALID_CHECKSUM_ERROR],
            ['1027812400968', Ogrn::INVALID_CHECKSUM_ERROR],
            ['1027812400869', Ogrn::INVALID_CHECKSUM_ERROR],
        ];
    }
}