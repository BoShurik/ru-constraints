<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 15:31
 */

namespace BoShurik\Constraints\Ru\Tests;

use BoShurik\Constraints\Ru\Bik;
use BoShurik\Constraints\Ru\BikValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class BikValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new BikValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Bik());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Bik());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(new \stdClass(), new Bik());
    }

    /**
     * @dataProvider getValid
     */
    public function testValid($value)
    {
        $this->validator->validate($value, new Bik());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalid
     */
    public function testInvalid($value, $code)
    {
        $constraint = new Bik([
            'charactersMessage' => 'message',
            'lengthMessage' => 'message',
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
            ['000000000'],
            ['012345678'],
            ['123456789'],
        ];
    }

    public function getInvalid()
    {
        return [
            ['qwerty', Bik::INVALID_CHARACTERS_ERROR],
            ['01234567', Bik::INVALID_LENGTH_ERROR],
            ['12345678', Bik::INVALID_LENGTH_ERROR],
            ['0123456789', Bik::INVALID_LENGTH_ERROR],
            ['1234567890', Bik::INVALID_LENGTH_ERROR],
        ];
    }
}