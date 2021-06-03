<?php


namespace App\Domain\Model\Hit;


use App\Domain\ValueObject\AbstractStringValueObject;
use Assert\Assertion;

class SearchTerm extends AbstractStringValueObject
{
    public static function fromString(string $value): self
    {
        Assertion::notBlank($value);
        Assertion::maxLength($value, self::MAX_LENGTH);

        return new self($value);
    }
}