<?php


namespace App\Domain\Model\Hit;

use App\Domain\ValueObject\Uuid;

class HitId extends Uuid
{
    public static function fromString(string $value): self
    {
        return new self($value);
    }
}