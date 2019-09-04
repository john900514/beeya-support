<?php

namespace App\Services;

use Ixudra\Curl\Facades\Curl;

class BeeyaSearchGateway
{
    public function __construct()
    {

    }

    public function getResults($job, $location, $page = 1)
    {
        $results = [];

        $api_url = 'https://admin.beeya.com/beeya/rest/ext/jobs/v1';
        $api_key = 'emFpZDp6YWlkQDEyMzQ';

        $payload = [
            'jobTitle' => $job,
            'location' => $location,
            'radius_miles' => env('SEARCH_RADIUS', 25),
            'page' => $page,
            'jobs_per_page' => env('MAX_PAGE_RESULTS', 16),
            'days_ago' => env('MAX_AD_AGE', 21)
        ];

        $response = Curl::to($api_url)
            ->withContentType('application/json')
            ->withHeader("Authorization: Basic $api_key")
            ->withData($payload)
            ->asJson(true)
            ->get();

        if($response)
        {
            $results = [
                'records' => $response['serviceResult']['records'],
                'total' => $response['serviceResult']['totalRecords']
            ];
        }

        return $results;
    }
}
