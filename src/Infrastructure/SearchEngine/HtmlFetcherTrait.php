<?php


namespace App\Infrastructure\SearchEngine;

use Symfony\Component\DomCrawler\Crawler;

trait HtmlFetcherTrait
{
    private function fetchHtml(string $url, array $params): ?Crawler
    {
        $fullUrl = sprintf('%s?%s', $url, http_build_query($params));
        if (!$html = file_get_contents($fullUrl)) {
            return null;
        }

        return new Crawler($html);
    }

    private function fetchLinks(string $url, array $params, string $selector): array
    {
        if (!$crawler =  $this->fetchHtml($url, $params)) {
            return [];
        }

        $links = $crawler->filter($selector);

        if (!$links->count()) {
            return [];
        }

        return $links->getIterator()->getArrayCopy();
    }
}