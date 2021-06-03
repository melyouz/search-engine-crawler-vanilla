<?php


namespace App\Presentation\Api\Controller;


use App\Application\Service\ListService;
use App\Application\Service\SearchService;
use App\Infrastructure\Http\JsonResponse;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class SearchController
{
    private SearchService $searchService;
    private ListService $listService;

    public function __construct(SearchService $searchService, ListService $listService)
    {
        $this->searchService = $searchService;
        $this->listService = $listService;
    }

    public function __invoke(Request $request): Response
    {
        $searchEngineName = $request->getParam('se', null);
        $searchTerm = $request->getParam('s', null);

        if (!$searchEngineName || !$searchTerm) {
            return new JsonResponse(['message' => 'Please, specify a search engine and introduce a search term.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->searchService->search($searchEngineName, $searchTerm);

        $data = $this->listService->list($searchEngineName);

        return new JsonResponse($data, Response::HTTP_OK);
    }
}