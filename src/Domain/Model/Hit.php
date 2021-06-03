<?php

namespace App\Domain\Model;

use App\Domain\Model\Hit\Domain;
use App\Domain\Model\Hit\HitId;
use App\Domain\Model\Hit\SearchEngineName;
use App\Domain\Model\Hit\SearchTerm;
use DateTimeImmutable;

class Hit
{
    private string $id;
    private string $searchEngine;
    private string $searchedTerm;
    private string $domain;
    private DateTimeImmutable $createdAt;

    public function __construct(HitId $id, SearchEngineName $searchEngine, SearchTerm $searchedTerm, Domain $domain)
    {
        $this->id = $id;
        $this->searchEngine = $searchEngine;
        $this->searchedTerm = $searchedTerm;
        $this->domain = $domain;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): HitId
    {
        return HitId::fromString($this->id);
    }

    public function getSearchEngine(): SearchEngineName
    {
        return SearchEngineName::fromString($this->searchEngine);
    }

    public function getSearchedTerm(): SearchTerm
    {
        return SearchTerm::fromString($this->searchedTerm);
    }

    public function getDomain(): Domain
    {
        return Domain::fromString($this->domain);
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}