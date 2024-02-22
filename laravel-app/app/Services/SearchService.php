<?php

namespace  App\Services;

use App\Services\Contracts\SearchServiceContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class SearchService implements SearchServiceContract
{
    /**
     * @param array $fields
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSearch(array $fields): JsonResponse|GuzzleException
    {
        $client = new Client();
        $headers = [
            'accept' => 'application/json',
            'apikey' => env('TEQUILA_API_KEY'),
        ];

        $queryParams = $this->builQueryParams($fields);
        $response = $client->get('https://api.tequila.kiwi.com/locations/query?' . $queryParams, [
            'headers' => $headers,
        ]);

        $statusCode = $response->getStatusCode();
        $jsonString = $response->getBody()->getContents();
        $jsonData = json_decode($jsonString);

        return response()->json($jsonData, $statusCode);;
    }

    /**
     * @param array $fields
     * @return string
     */
    private function builQueryParams(array $fields): string
    {
        $paramQuery = "";

        foreach ($fields as $fieldName => $fieldValue) {
            if (is_array($fieldValue)) {
                foreach ($fieldValue as $subField) {
                    if ($paramQuery != "") {
                        $paramQuery .= "&";
                    }
                    if (count($fieldValue) > 1) {
                        $paramQuery .= "location_types={$subField}";
                    } else {
                        $paramQuery .= "{$fieldName}={$subField}";
                    }
                }
            } else {
                if ($paramQuery != "") {
                    $paramQuery .= "&";
                }
                $paramQuery .= "{$fieldName}={$fieldValue}";
            }
        }

        return $paramQuery;
    }
}
