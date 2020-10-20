<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 15:31
 */

namespace BoShurik\Constraints\Ru\Tests;

use BoShurik\Constraints\Ru\Kpp;
use BoShurik\Constraints\Ru\KppValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class KppValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new KppValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Kpp());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Kpp());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(new \stdClass(), new Kpp());
    }

    /**
     * @dataProvider getValid
     */
    public function testValid($value)
    {
        $this->validator->validate($value, new Kpp());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalid
     */
    public function testInvalid($value, $code)
    {
        $constraint = new Kpp([
            'lengthMessage' => 'message',
            'formatMessage' => 'message',
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
            ['0000AZ000'],
        ];
    }

    public function getInvalid()
    {
        return [
            ['01234567', Kpp::INVALID_LENGTH_ERROR],
            ['12345678', Kpp::INVALID_LENGTH_ERROR],
            ['0123456789', Kpp::INVALID_LENGTH_ERROR],
            ['1234567890', Kpp::INVALID_LENGTH_ERROR],
            ['0000aZ000', Kpp::INVALID_FORMAT_ERROR],
            ['0000A-000', Kpp::INVALID_FORMAT_ERROR],
        ];
    }
}