<?php

namespace App\Http\Controllers;

use App\Models\lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class API extends Controller
{
    //
    public function recieve_lead(Request $request)
    {

        // return $request;
        if ($request->api_key == env('API_KEY')) {
            $lead = new lead();
            $lead->client_name = $request->name;
            $lead->client_phn = $request->mobile;
            $lead->client_em = $request->email;
            $lead->property_name = $request->project;
            $lead->address = "Automatically generated lead!";
            $lead->state = "Unavailable";
            $lead->district = $request->City;
            $lead->prop_type = "Unavailable";
            $lead->lead_from = $request->source;
            $lead->assigned_areaman = "not assigned";
            $lead->assigned_man = "not assigned";
            $lead->assigned_exe = "not assigned";
            $lead->status = 1;
            $lead->save();

            Http::post('https://discord.com/api/webhooks/945220567911518260/o_vu_PC3L9Icm7ofjJF0h8pFfpFOv-E2T3bE2DG1-MXTU7ehezq9grZiBmWitxjgDjyk', [
                'content' => "Lead punched in CRM using API.",
                'embeds' => [
                    [
                        'title' => "Client name -> ".$request->name,
                        'description' => "Property name ->".$request->project,
                        'color' => '7506394',
                    ]
                ],
            ]);

            return response()->json(["status" => "Successfully authenticated and lead punched"]);
        }
        else{
            return response()->json(["status" => "Authentication unsuccessful"]);
        }
    }

    public function calculate()
    {

        // Data comes in as POST Request.

        $response = app(CO2Helper::class)->calculate(
            $age = request('age'),
            $country = request('country'),
            $server = request('server'),
            $server_type = request('server_type'),
            $traffic = request('traffic')
        );
        return response()->json($response);
    }
}
