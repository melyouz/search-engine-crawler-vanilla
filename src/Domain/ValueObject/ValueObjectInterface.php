<?php


namespace App\Domain\ValueObject;


interface  ValueObjectInterface
{
    public function sameValueAs(ValueObjectInterface $other): bool;

    public function value();

    public function __toString(): string;
}