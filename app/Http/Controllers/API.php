<?php

namespace App\Http\Controllers;

use App\Mail\leadassign;
use App\Models\assign;
use App\Models\assign_lead;
use App\Models\lead;
use App\Models\message;
use App\Models\properties;
use App\Models\proptype;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class API extends Controller
{
    //
    public function post_recieve_lead(Request $request)
    {
        if ($request->api_key == env('API_KEY')) {
            $lead = new lead();
            $lead->client_name = $request->name;
            $lead->client_phn = $request->mobile;
            $lead->client_em = $request->email;

            $props = properties::all();
            $property = null;
            foreach ($props as $prop) {
                $property = properties::where('propname', $request->project)->first();
                if (strtolower($prop->propname)==strtolower($request->project)) {
                    $property = properties::where('propname', $prop->propname)->get()->first();
                    // dd($property);
                    $lead->property_name = $property->propname;
                    $lead->address = $property->address;
                    $lead->state = $property->state;
                    $lead->district = $property->district;
                    $lead->prop_type = $property->prop_type;
                    $lead->lead_from = $request->source;
                    $lead->assigned_areaman = $property->areamanager;
                    $lead->assigned_man = $property->salesmanager;
                    $lead->assigned_exe = $property->salesexecutive;
                    $lead->status = 1;
                    $lead->save();

                    $assign = new assign();
                    $assign->property_name = $request->project;
                    $assign->property_id = $prop->id;
                    $assign->areamanager = $prop->areamanager;
                    $assign->salesmanager = $prop->salesmanager;
                    $assign->salesexecutive = $prop->salesexecutive;
                    $assign->save();

                    $message= new message();
                    $message->sender_id = 1;
                    $message->sender_name = User::where('id', 1)->first()->name;
                    $message->reciever_id = $property->salesmanager;
                    $message->message = 'You have an automatic assigned lead from '. $request->source;
                    $message->save();
                    User::where('id', $property->salesmanager)->update([
                        'notification' => DB::raw('notification+1')
                    ]);

                    $message= new message();
                    $message->sender_id = 1;
                    $message->sender_name = User::where('id', 1)->first()->name;
                    $message->reciever_id = $property->areamanager;
                    $message->message = 'You have an automatic assigned lead from '. $request->source;
                    $message->save();
                    User::where('id', $property->areamanager)->update([
                        'notification' => DB::raw('notification+1')
                    ]);

                    $assigns = (explode(",", $property->salesexecutive));
                    $details = [
                        'subject' => $lead->client_name."'s Lead has been assigned. ".$lead->property_name,
                        'usrname' => User::where('id', $property->salesmanager)->first()->name,
                        'property_name' => $property->propname,
                        'client_name' => $request->name,
                        'client_phn' => $request->mobile,
                        'url' => URL::to('/').'/login'
                    ];

                    Mail::to(User::where('id', $property->areamanager)->first()->email)->send(new leadassign($details));
                    Mail::to(User::where('id', $property->salesmanager)->first()->email)->send(new leadassign($details));

                    foreach($assigns as $assi){
                        $lead = new assign_lead();
                        $lead->client_name = $request->name;
                        $lead->client_phn = $request->mobile;
                        $lead->client_em = $request->email;
                        $lead->property_name = $property->propname;
                        $lead->address = $property->address;
                        $lead->state = $property->state;
                        $lead->district = $property->district;
                        $lead->prop_type = $property->prop_type;
                        $lead->lead_from = $request->source;
                        $lead->assigned_man = $property->salesmanager;
                        $lead->assigned_exe = $assi;
                        $lead->status = 1;
                        $lead->save();
            
                        $message= new message();
                        $message->sender_id = 1;
                        $message->sender_name = User::where('id', 1)->first()->name;
                        $message->reciever_id = $assi;
                        $message->message = 'You have an automatic assigned lead from '. $request->source;
                        $message->save();
                        User::where('id', $assi)->update([
                            'notification' => DB::raw('notification+1')
                        ]);
                        
                        $details = [
                            'subject' => $lead->client_name."'s Lead has been assigned. ".$lead->property_name,
                            'usrname' => User::where('id', $property->salesmanager)->first()->name,
                            'property_name' => $property->propname,
                            'client_name' => $request->name,
                            'client_phn' => $request->mobile,
                            'url' => URL::to('/').'/login'
                        ];
                        
                        Mail::to(User::where('id', $assi)->first()->email)->send(new leadassign($details));

                        Http::post('https://discord.com/api/webhooks/948846406498656287/P85LaQVSEkJCZW40HdBVeT1K56dgTPqBAFqekqfkm3AW8WzecEgxNOc7Sn5lJ3rRp32v', [
                            'content' => "Lead punched in CRM using API.",
                            'embeds' => [
                                [
                                    'title' => "Client name -> ".$request->name,
                                    'description' => "Property name ->".$request->project,
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                    }
                    break;
                }
            }


            if (!$property) {
                $sale_exes = User::where('salesexecutive', true)->get();
                $sale_exes_cnt = array();
                $sale_exes_id = array();
                foreach ($sale_exes as $sale_exe) {
                    $lead_cnt = assign_lead::whereDate('created_at', Carbon::today())->where('assigned_exe', $sale_exe->id)->get()->count();
                    array_push($sale_exes_cnt, (int)$lead_cnt);
                    array_push($sale_exes_id, (int)$sale_exe->id);
                }
                $least_cnt = min($sale_exes_cnt);
                $least_cnt_exe = $sale_exes_id[array_search($least_cnt, $sale_exes_cnt)];

                $sale_mans = User::where('salesmanager', true)->get();
                $sale_mans_cnt = array();
                $sale_mans_id = array();
                foreach ($sale_mans as $sale_man) {
                    $lead_cnt = lead::whereDate('created_at', Carbon::today())->where('assigned_man', $sale_man->id)->get()->count();
                    array_push($sale_mans_cnt, (int)$lead_cnt);
                    array_push($sale_mans_id, (int)$sale_man->id);
                }
                $least_cnt = min($sale_mans_cnt);
                $least_cnt_man = $sale_mans_id[array_search($least_cnt, $sale_mans_cnt)];

                $sale_area = User::where('areamanager', true)->get();
                $sale_area_cnt = array();
                $sale_area_id = array();
                foreach ($sale_area as $sale_area) {
                    $lead_cnt = lead::whereDate('created_at', Carbon::today())->where('assigned_areaman', $sale_area->id)->get()->count();
                    array_push($sale_area_cnt, (int)$lead_cnt);
                    array_push($sale_area_id, (int)$sale_area->id);
                }
                $least_cnt = min($sale_area_cnt);
                $least_cnt_area = $sale_area_id[array_search($least_cnt, $sale_area_cnt)];

                $prop = new properties();
                $prop->propname = $request->project;
                $prop->address = "Automatically added by api!";
                $prop->district = $request->City;
                $prop->state = 'unavailable';
                $prop->prop_type = proptype::where('id', 1)->first()->prop_type;
                $prop->owner = 'unavailable';
                $prop->status = 1;
                $prop->areamanager = $least_cnt_area;
                $prop->salesmanager = $least_cnt_man;
                $prop->salesexecutive = $least_cnt_exe;
                $prop->save();
                
                $assign = new assign();
                $assign->property_name = $request->project;
                $assign->property_id = $prop->id;
                $assign->areamanager = $prop->areamanager;
                $assign->salesmanager = $prop->salesmanager;
                $assign->salesexecutive = $prop->salesexecutive;
                $assign->save();
                
                

                // create a lead now

                $property = properties::where('propname', $prop->propname)->get()->first();
                // dd($property);
                $lead = new lead();
                $lead->client_name = $request->name;
                $lead->client_phn = $request->mobile;
                $lead->client_em = $request->email;
                $lead->property_name = $property->propname;
                $lead->address = $property->address;
                $lead->state = $property->state;
                $lead->district = $property->district;
                $lead->prop_type = $property->prop_type;
                $lead->lead_from = $request->source;
                $lead->assigned_areaman = $property->areamanager;
                $lead->assigned_man = $property->salesmanager;
                $lead->assigned_exe = $property->salesexecutive;
                $lead->status = 1;
                $lead->save();

                $lead = new assign_lead();
                $lead->client_name = $request->name;
                $lead->client_phn = $request->mobile;
                $lead->client_em = $request->email;
                $lead->property_name = $property->propname;
                $lead->address = $property->address;
                $lead->state = $property->state;
                $lead->district = $property->district;
                $lead->prop_type = $property->prop_type;
                $lead->lead_from = $request->source;
                $lead->assigned_man = $property->salesmanager;
                $lead->assigned_exe = $property->salesexecutive;
                $lead->status = 1;
                $lead->save();

                // $lead = new lead();
                // $lead->client_name = $request->name;
                // $lead->client_phn = $request->mobile;
                // $lead->client_em = $request->email;
                // $lead->property_name = $prop->propname;
                // $lead->address = "Address is unavailable for this lead as added by api.";;
                // $lead->state = 'unavailable';
                // $lead->district = $request->City;
                // $lead->prop_type = proptype::where('id', 1)->first()->prop_type;
                // $lead->lead_from = $request->source;
                // $lead->assigned_areaman = $least_cnt_area;
                // $lead->assigned_man = $least_cnt_man;
                // $lead->assigned_exe = $least_cnt_exe;
                // $lead->status = 1;
                // $lead->save();

                $message= new message();
                $message->sender_id = 1;
                $message->sender_name = User::where('id', 1)->first()->name;
                $message->reciever_id = $property->salesexecutive;
                $message->message = 'You have an automatic assigned lead from '. $request->source;
                $message->save();
                User::where('id', $property->salesexecutive)->update([
                    'notification' => DB::raw('notification+1')
                ]);

                $message= new message();
                $message->sender_id = 1;
                $message->sender_name = User::where('id', 1)->first()->name;
                $message->reciever_id =$property->salesmanager;
                $message->message = 'You have an automatic assigned lead from '. $request->source;
                $message->save();
                User::where('id', $property->salesmanager)->update([
                    'notification' => DB::raw('notification+1')
                ]);

                $message= new message();
                $message->sender_id = 1;
                $message->sender_name = User::where('id', 1)->first()->name;
                $message->reciever_id = $property->areamanager;
                $message->message = 'You have an automatic assigned lead from '. $request->source;
                $message->save();
                User::where('id', $property->areamanager)->update([
                    'notification' => DB::raw('notification+1')
                ]);

                $details = [
                    'subject' => $lead->client_name."'s Lead has been assigned. ".$lead->property_name,
                    'usrname' => User::where('id', $least_cnt_man)->first()->name,
                    'property_name' => $prop->propname,
                    'client_name' => $request->name,
                    'client_phn' => $request->mobile,
                    'url' => URL::to('/').'/login'
                ];

                Mail::to(User::where('id', $property->areamanager)->first()->email)->send(new leadassign($details));
                Mail::to(User::where('id', $property->salesmanager)->first()->email)->send(new leadassign($details));
                Mail::to(User::where('id', $property->salesexecutive)->first()->email)->send(new leadassign($details));

                Http::post('https://discord.com/api/webhooks/948846406498656287/P85LaQVSEkJCZW40HdBVeT1K56dgTPqBAFqekqfkm3AW8WzecEgxNOc7Sn5lJ3rRp32v', [
                    'content' => "Lead punched in CRM using API and a newproperty is being generated.",
                    'embeds' => [
                        [
                            'title' => "Client name -> ".$request->name,
                            'description' => "Property name ->".$request->project,
                            'color' => '7506394',
                        ]
                    ],
                ]);
            }
            

            // $lead->property_name = $request->project;
            // $lead->address = "Automatically generated lead!";
            // $lead->state = "Unavailable";
            // $lead->district = $request->City;
            // $lead->prop_type = "Unavailable";
            // $lead->lead_from = $request->source;
            // $lead->assigned_areaman = "not assigned";
            // $lead->assigned_man = "not assigned";
            // $lead->assigned_exe = "not assigned";
            // $lead->status = 1;
            // $lead->save();
            return response()->json(["status" => "Successfully authenticated and lead punched"]);
        }
        else{
            return response()->json(["status" => "Authentication unsuccessful"]);
        }
    }

    public function get_recieve_lead($api_key, $email, $mobile, $name, $project, $City, $source)
    {
        // dd($api_key);
        $api_key = explode('=', $api_key);
        $email = explode('=', $email);
        $mobile = explode('=', $mobile);
        $name = explode('=', $name);
        $project = explode('=', $project);
        $City = explode('=', $City);
        $source = explode('=', $source);

        echo gettype($api_key[1]) ;
        echo (gettype(env('API_KEY')));

        if ($api_key == env('API_KEY')) {
            $lead = new lead();
            $lead->client_name = $name[1];
            $lead->client_phn = $mobile[1];
            $lead->client_em = $email[1];
            $lead->property_name = $project[1];
            $lead->address = "Automatically generated lead!";
            $lead->state = "Unavailable";
            $lead->district = $City[1];
            $lead->prop_type = "Unavailable";
            $lead->lead_from = $source[1];
            $lead->assigned_areaman = "not assigned";
            $lead->assigned_man = "not assigned";
            $lead->assigned_exe = "not assigned";
            $lead->status = 1;
            $lead->save();
            dd('test');
            Http::post('https://discord.com/api/webhooks/945220567911518260/o_vu_PC3L9Icm7ofjJF0h8pFfpFOv-E2T3bE2DG1-MXTU7ehezq9grZiBmWitxjgDjyk', [
                'content' => "Lead punched in CRM using API.",
                'embeds' => [
                    [
                        'title' => "Client name -> ".$name[1],
                        'description' => "Property name ->".$project[1],
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
