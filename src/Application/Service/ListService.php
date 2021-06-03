<?php


namespace App\Application\Service;


use App\Domain\Dto\DomainHitCount;
use App\Domain\Model\Hit\SearchEngineName;
use App\Domain\Repository\HitRepositoryInterface;

class ListService
{
    private HitRepositoryInterface $hitRepository;

    public function __construct(HitRepositoryInterface $hitRepository)
    {
        $this->hitRepository = $hitRepository;
    }

    /** @return DomainHitCount[] */
    public function list(string $searchEngineName): array
    {
        $searchEngineName = SearchEngineName::fromString($searchEngineName);

        return $this->hitRepository->allGroupedByDomain($searchEngineName);
    }
}