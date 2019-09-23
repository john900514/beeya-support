<?php

namespace App\Services;

use App\Places;
use Geocoder\ProviderAggregator;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;
use Http\Adapter\Guzzle6\Client;
use Illuminate\Support\Facades\Log;

class GeocoderService
{
    protected $geocoder, $places;
    public function __construct(Places $places, Client $client, ProviderAggregator $agg)
    {
        $adapter  = $client;
        $geocoder = $agg;
        $providers = [];
        switch(env('SEARCH_MODE'))
        {
            case 'google':
                $providers = [
                    new \Geocoder\Provider\GoogleMaps\GoogleMaps($adapter,null, 'AIzaSyDkq3oJJjiylINQYBnoG8imBiTR7uN52WQ'),
                ];
                break;
            case 'Here':
                $providers[] = new \Geocoder\Provider\Here\Here($adapter,'2J6UjZPIfV53uYfvYthm','l2NkXSZ_sFxl0Boc4EF0aQ');
                break;

            default:
                // @todo - use our own database eventually
                // for now, use Here
                $providers[] = new \Geocoder\Provider\Here\Here($adapter,'2J6UjZPIfV53uYfvYthm','l2NkXSZ_sFxl0Boc4EF0aQ');
        }

        $geocoder->registerProviders($providers);

        $this->geocoder = $geocoder;
        $this->places = $places;
    }

    private function getProvider()
    {
        switch(env('SEARCH_MODE'))
        {
            case 'google':
                $results = 'google_maps';
                break;

            case 'here':
            default:
                $results = env('SEARCH_MODE');
        }

        return $results;
    }

    private function storeOrUpdateLocation($data)
    {
        $results = false;

        $places = $this->places->where('name', '=', $data['name'])->get();

        if(count($places) > 0)
        {
            $places = $places->where('lat', '=', number_format($data['lat'],2))
                ->where('long', '=', number_format($data['long'],2))
                ;//->get();

            if(count($places) > 0)
            {
                foreach ($places as $place)
                {
                    $place->update(['misc' => $data['misc']]);
                }
            }
            else
            {
                $place = $this->places->save($data);
            }
        }
        else
        {
            $place = new $this->places($data);
            $place->save();
        }

        $results = $place->toArray();

        return $results;
    }

    public function autocomplete($place)
    {
        $results = [];

        try
        {
            /*
            $locations =  $this->geocoder
                ->geocodeQuery(GeocodeQuery::create($place));

            if(count($locations) > 0)
            {
                foreach ($locations as $location)
                {
                    $geo = $location->getCoordinates();
                    $lat = $geo->getLatitude();
                    $long = $geo->getLongitude();
                    $name = $location->getLocationName();

                    if(is_null($name))
                    {
                        $name = $place;
                        $fullname = $name;
                        $misc = $location->getAdditionalData();

                        if(count($misc) > 0)
                        {
                            $fullname = '';
                            foreach ($misc as $col => $ad)
                            {
                                if(!$fullname == '')
                                {
                                    $fullname .= ', '.$ad;
                                }
                                else
                                {
                                    $fullname = $ad;
                                }
                            }

                        }

                    }
                    else
                    {
                        $fullname = $name;
                    }

                    // @todo - store this shit into the DB
                    $results[] = $fullname;
                }
            }
            */
            $places = $this->places->where('name', 'like', '%' . $place . '%')->get();

            if(count($places) > 0)
            {
                foreach($places as $loc)
                {
                    $results[] = $loc->name;
                }
            }

        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
        }

        return $results;
    }

    public function query($place)
    {
        $results = [];

        try
        {
            $locations =  $this->geocoder->geocodeQuery(GeocodeQuery::create($place));

            if(count($locations) > 0)
            {
                $location = $locations->first();

                $geo = $location->getCoordinates();
                $lat = $geo->getLatitude();
                $long = $geo->getLongitude();

                // store this shit into the DB
                $this->storeOrUpdateLocation([
                    'lat' => $lat,
                    'long' => $long,
                    'name' => $place,
                    'misc' => json_encode($location->toArray())
                ]);

                $results = [
                    'lat' => $lat,
                    'long' => $long
                ];

            }
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
        }

        return $results;
    }


}
