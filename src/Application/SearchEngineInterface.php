<?php


namespace App\Application;


use App\Domain\Model\Hit\Domain;
use App\Domain\Model\Hit\SearchTerm;

interface SearchEngineInterface
{
    /** @return Domain[] */
    public function getDomains(SearchTerm $searchTerm): array;
}