<?php


namespace App\Infrastructure\SearchEngine;


use App\Application\SearchEngineFactoryInterface;
use App\Application\SearchEngineInterface;
use App\Domain\Model\Hit\SearchEngineName;
use InvalidArgumentException;

class SearchEngineFactory implements SearchEngineFactoryInterface
{
    private GoogleSearchEngine $googleSearchEngine;
    private BingSearchEngine $bingSearchEngine;
    private DuckduckgoSearchEngine $duckduckgoSearchEngine;

    public function __construct(GoogleSearchEngine $googleSearchEngine, BingSearchEngine $bingSearchEngine, DuckduckgoSearchEngine $duckduckgoSearchEngine)
    {
        $this->googleSearchEngine = $googleSearchEngine;
        $this->bingSearchEngine = $bingSearchEngine;
        $this->duckduckgoSearchEngine = $duckduckgoSearchEngine;
    }

    public function get(SearchEngineName $searchEngine): SearchEngineInterface
    {
        switch ($searchEngine->value()) {
            case SearchEngineName::BING:
                return $this->bingSearchEngine;
            case SearchEngineName::GOOGLE:
                return $this->googleSearchEngine;
            case SearchEngineName::DUCKDUCKGO:
                return $this->duckduckgoSearchEngine;
            default:
                throw new InvalidArgumentException(sprintf('Unhandled search engine "%s"', $searchEngine));
        }
    }
}