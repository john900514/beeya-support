<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\BeeyaSearchGateway;
use App\Http\Controllers\Controller;

class SearchResultsController extends Controller
{
    protected $beeya, $request;

    public function __construct(Request $request, BeeyaSearchGateway $beeya)
    {
        $this->request = $request;
        $this->beeya = $beeya;
    }

    public function get()
    {
        $results = ['success' => false, 'reason' => 'No results found'];

        $data = $this->request->all();

        $page = array_key_exists('page', $data) ? $data['page'] : 1 ;

        // @todo - if session_id is passed in be sure to log the results
        $response = $this->beeya->getResults($data['jobTitle'], $data['jobLocation'], $page);

        if(count($response) > 0)
        {
            $results = ['success' => true, 'results' => $response];
        }

        return response()->json($results);
    }
}
