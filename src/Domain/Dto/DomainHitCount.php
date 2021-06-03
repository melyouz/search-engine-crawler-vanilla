<?php


namespace App\Domain\Dto;

use App\Domain\Model\Hit\Domain;
use InvalidArgumentException;

class DomainHitCount implements \JsonSerializable
{
    private const MIN_COUNT = 1;

    private Domain $domain;
    private int $count;

    public function __construct(Domain $domain, int $count)
    {
        $this->countValidationGuard($count);

        $this->domain = $domain;
        $this->count = $count;
    }

    private function countValidationGuard(int $count): void
    {
        if ($count < self::MIN_COUNT) {
            throw new InvalidArgumentException(sprintf('Count must be greater or equal to %d.', self::MIN_COUNT));
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(Domain::fromString($data['domain']), $data['count']);
    }

    public function jsonSerialize(): array
    {
        return ['domain' => $this->getDomain()->value(), 'count' => $this->getCount()];
    }

    public function getDomain(): Domain
    {
        return $this->domain;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}