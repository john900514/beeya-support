<?php

namespace App\Http\Controllers\API;

use App\Click as Clicks;
use App\GameSessions;
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

    public function update_clicks(GameSessions $sesh)
    {
        $results = ['success' => false, 'reason' => 'Could not update session'];

        $data = $this->request->all();
        /**
         * Steps
         * 1. Update the amount of clicks in the application round, the job and location
         * 2. @todo - update the device
         * 3. @todo - cut a new clicks record with the click data
         */
        $sesh = $sesh->where('game_token', '=', $data['gameid'])->first();

        if(!is_null($sesh))
        {
            $round = "round{$data['round']}";
            $sesh->$round = $data['clickNo'];
            $sesh->job = $data['job'];
            $sesh->location = $data['location'];
            $sesh->total_results = $data['totalRecords'];
            $sesh->save();

            $click = new Clicks($data['clickData']);
            $click->save();

            $results = ['success' => true];
        }

        return response()->json($results);
    }
}
