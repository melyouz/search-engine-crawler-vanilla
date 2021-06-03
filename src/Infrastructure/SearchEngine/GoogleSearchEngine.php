<?php


namespace App\Infrastructure\SearchEngine;


use App\Application\SearchEngineInterface;
use App\Domain\Model\Hit\SearchTerm;

class GoogleSearchEngine implements SearchEngineInterface
{
    use HtmlFetcherTrait;
    use UrlGuesserTrait;

    private string $url;

    public function __construct(string $googleUrl)
    {
        $this->url = $googleUrl;
    }

    public function getDomains(SearchTerm $searchTerm): array
    {
        $links = $this->fetchLinks($this->url, ['q' => $searchTerm->value()], '#main > div > div > div:nth-child(1) > a');
        if (empty($links)) {
            return [];
        }

        return $this->guessDomains($links, 'q');
    }
}