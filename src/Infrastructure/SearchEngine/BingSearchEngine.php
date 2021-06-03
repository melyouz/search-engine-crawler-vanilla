<?php


namespace App\Infrastructure\SearchEngine;


use App\Application\SearchEngineInterface;
use App\Domain\Model\Hit\SearchTerm;

class BingSearchEngine implements SearchEngineInterface
{
    use HtmlFetcherTrait;
    use UrlGuesserTrait;

    private string $url;

    public function __construct(string $bingUrl)
    {
        $this->url = $bingUrl;
    }

    public function getDomains(SearchTerm $searchTerm): array
    {
        $links = $this->fetchLinks($this->url, ['q' => $searchTerm->value()], '#b_results > li > h2 > a');
        if (empty($links)) {
            return [];
        }

        return $this->guessDomains($links);
    }
}