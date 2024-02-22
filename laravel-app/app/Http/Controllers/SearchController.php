<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\Contracts\SearchServiceContract;

class SearchController extends Controller
{
    private $searchService;

    function __construct(SearchServiceContract $searchService)
    {
        $this->searchService = $searchService;
    }

    function __invoke(SearchRequest $request)
    {
        return $this->searchService->getSearch($request->all());
    }
}
