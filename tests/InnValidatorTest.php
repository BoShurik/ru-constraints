<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 15:31
 */

namespace BoShurik\Constraints\Ru\Tests;

use BoShurik\Constraints\Ru\Inn;
use BoShurik\Constraints\Ru\InnValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class InnValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        return new InnValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Inn());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Inn());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(new \stdClass(), new Inn());
    }

    /**
     * @dataProvider getValid
     */
    public function testValid($value)
    {
        $this->validator->validate($value, new Inn());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalid
     */
    public function testInvalid($value, $code)
    {
        $constraint = new Inn([
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
            ['0000000000'],
            ['000000000000'],
            ['7827004526'],
            ['760307073214'],
        ];
    }

    public function getInvalid()
    {
        return [
            ['qwerty', Inn::INVALID_CHARACTERS_ERROR],
            ['000000000', INN::INVALID_LENGTH_ERROR],
            ['012345678', INN::INVALID_LENGTH_ERROR],
            ['123456789', INN::INVALID_LENGTH_ERROR],
            ['0123456789', INN::INVALID_CHECKSUM_ERROR],
            ['1234567890', INN::INVALID_CHECKSUM_ERROR],
            ['00000000000', INN::INVALID_LENGTH_ERROR],
            ['01234567890', INN::INVALID_LENGTH_ERROR],
            ['12345678901', INN::INVALID_LENGTH_ERROR],
            ['012345678901', INN::INVALID_CHECKSUM_ERROR],
            ['123456789012', INN::INVALID_CHECKSUM_ERROR],
            ['0000000000000', INN::INVALID_LENGTH_ERROR],
            ['0123456789012', INN::INVALID_LENGTH_ERROR],
            ['1234567890123', INN::INVALID_LENGTH_ERROR],
            ['8827004526', INN::INVALID_CHECKSUM_ERROR],
            ['7837004526', INN::INVALID_CHECKSUM_ERROR],
            ['7827104526', INN::INVALID_CHECKSUM_ERROR],
            ['7827005526', INN::INVALID_CHECKSUM_ERROR],
            ['7827004536', INN::INVALID_CHECKSUM_ERROR],
            ['860307073214', INN::INVALID_CHECKSUM_ERROR],
            ['761307073214', INN::INVALID_CHECKSUM_ERROR],
            ['760317073214', INN::INVALID_CHECKSUM_ERROR],
            ['760307173214', INN::INVALID_CHECKSUM_ERROR],
            ['760307074214', INN::INVALID_CHECKSUM_ERROR],
            ['760307073224', INN::INVALID_CHECKSUM_ERROR],
        ];
    }
}