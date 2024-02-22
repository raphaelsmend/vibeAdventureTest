<?php

namespace App\Services\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

interface SearchServiceContract
{
    /**
     * @param array $fields
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSearch(array $fields): JsonResponse|GuzzleException;
}
