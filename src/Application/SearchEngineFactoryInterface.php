<?php


namespace App\Application;


use App\Domain\Model\Hit\SearchEngineName;

interface SearchEngineFactoryInterface
{
    public function get(SearchEngineName $searchEngine): SearchEngineInterface;
}