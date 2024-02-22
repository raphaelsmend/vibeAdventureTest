<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SearchRequestTest extends TestCase
{
    public function test_search_request_successful_response(): void
    {
        $response = $this->post(route('search'),[
            'term' => 'en',
            'locale' => 'en-US',
            'limit' => '30',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'locations'
        ]);
    }

    public function test_search_request_unsuccessful_response(): void
    {
        $response = $this->post(route('search'));

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }
}
