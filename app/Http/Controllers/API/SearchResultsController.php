<?php

namespace App\Http\Controllers\API;

use App\Click as Clicks;
use App\GameSessions;
use App\Leads;
use Illuminate\Http\Request;
use App\Services\GeocoderService;
use App\Services\BeeyaSearchGateway;
use App\Http\Controllers\Controller;

class SearchResultsController extends Controller
{
    protected $beeya, $request, $search;

    public function __construct(Request $request, BeeyaSearchGateway $beeya, GeocoderService $search)
    {
        $this->request = $request;
        $this->beeya = $beeya;
        $this->search = $search;
    }

    public function get()
    {
        $results = ['success' => false, 'reason' => 'No results found'];

        $data = $this->request->all();

        $page = array_key_exists('page', $data) ? $data['page'] : 1 ;

        $geocode = [];
        if(env('SEARCH_MODE') == 'google')
        {
            if(array_key_exists('lat', $data) && array_key_exists('long', $data))
            {
                $geocode = [
                    'lat' => $data['lat'],
                    'long' => $data['long']
                ];

                // one-sided call to add the record if not exists
                $this->search->query($data['jobLocation']);
            }
            else
            {
                // use google?
                $geocode = $this->search->query($data['jobLocation']);
            }

        }
        else
        {
            // @todo - if the search engine is default, check the DB before running the line below
            $geocode = $this->search->query($data['jobLocation']);
        }

        // @todo - if session_id is passed in be sure to log the results
        $response = $this->beeya->getResults($data['jobTitle'], $data['jobLocation'], $page, $geocode);

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

    public function create_lead()
    {
        $results = ['success' => false, 'reason' => 'Could not create lead.'];

        $data = $this->request->all();
        /**
         * Steps
         * 1.
         * 2. @todo - fire out the lead to someone
         * 3. Return true with the lead data
         */
        // Create the lead
        $lead = new Leads($data);

        if($lead->save())
        {
            $results = ['success' => true, 'lead' => $lead->toArray()];
        }

        return response()->json($results);
    }

    public function autocomplete()
    {
        $results = ['success' => false, 'reasons' => 'Search Down ):'];

        $data = $this->request->all();

        if(array_key_exists('l', $data))
        {
            $geocode = $this->search->autocomplete($data['l']);

            if(count($geocode) > 0)
            {
                $results = ['success' => true, 'places' => $geocode];
            }
        }

        return response()->json($results);
    }

    public function store_autocomplete()
    {
        $data = $this->request->all();

        foreach ($data['places'] as $idx => $place)
        {
            $this->search->query($place['description']);
        }

        return response([true], 200);
    }
}
