<?php


namespace App\Application\Service;


use App\Application\SearchEngineFactoryInterface;
use App\Domain\Model\Hit;
use App\Domain\Model\Hit\SearchEngineName;
use App\Domain\Model\Hit\SearchTerm;
use App\Domain\Repository\HitRepositoryInterface;

class SearchService
{
    private SearchEngineFactoryInterface $searchEngineFactory;
    private HitRepositoryInterface $hitRepository;

    public function __construct(SearchEngineFactoryInterface $searchEngineFactory, HitRepositoryInterface $hitRepository)
    {
        $this->searchEngineFactory = $searchEngineFactory;
        $this->hitRepository = $hitRepository;
    }

    public function search(string $searchEngineName, string $searchTerm): void
    {
        $searchEngineName = SearchEngineName::fromString($searchEngineName);
        $searchTerm = SearchTerm::fromString($searchTerm);

        $searchEngine = $this->searchEngineFactory->get($searchEngineName);
        $domains = $searchEngine->getDomains($searchTerm);

        foreach ($domains as $domain) {
            $hitId = $this->hitRepository->nextIdentity();
            $hit = new Hit($hitId, $searchEngineName, $searchTerm, $domain);
            $this->hitRepository->save($hit);
        }
    }
}