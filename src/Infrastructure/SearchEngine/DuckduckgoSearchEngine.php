<?php


namespace App\Infrastructure\SearchEngine;


use App\Application\SearchEngineInterface;
use App\Domain\Model\Hit\SearchTerm;

class DuckduckgoSearchEngine implements SearchEngineInterface
{
    use HtmlFetcherTrait;
    use UrlGuesserTrait;

    private string $url;

    public function __construct(string $duckduckgoUrl)
    {
        $this->url = $duckduckgoUrl;
    }

    public function getDomains(SearchTerm $searchTerm): array
    {
        $links = $this->fetchLinks($this->url, ['q' => $searchTerm->value()], '#links a.result__url');
        if (empty($links)) {
            return [];
        }

        return $this->guessDomains($links, 'uddg');
    }
}