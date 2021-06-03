<?php


namespace App\Domain\Repository;

use App\Domain\Dto\DomainHitCount;
use App\Domain\Model\Hit;
use App\Domain\Model\Hit\HitId;
use App\Domain\Model\Hit\SearchEngineName;

interface HitRepositoryInterface
{
    /** @return DomainHitCount[] */
    public function allGroupedByDomain(SearchEngineName $searchEngineName): array;

    public function save(Hit $hit): void;

    public function nextIdentity(): HitId;
}