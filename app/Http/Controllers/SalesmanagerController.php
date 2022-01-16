<?php

namespace App\Http\Controllers;

use App\Models\assign;
use App\Models\lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOption\None;

class SalesmanagerController extends Controller
{
    public function index()
    {
        $leads = lead::where('state', Auth::user()->state)->get();
        return view('salesmanager.index', compact('leads'));
    }

    public function profile()
    {
        return view('salesmanager.profile');
    }

    public function calender()
    {
        return view('salesmanager.calender');
    }

    public function message()
    {
        return view('salesmanager.message');
    }

    public function send(Request $request)
    {
        // $username = "info@sagirealty.com";
        // $hash = "481441e1397b934d93426ccb6bbee1ce489ad2d7a5b7bfb9df1e213b34a78f29";
        // $test = "0";
        // $sender = "TXTLCL";
        // $numbers = "919884879805";
        // $message = "MERLIN RISE, KOLKATA'S 1ST EVER SPORTS REPUBLIC, Rajarhat. 2/3BHK@28.8Lacs onward. Book your application Kit: https://bit.ly/3nGfpI2, Ph: 9903491625 Sagi Realty";
        // $message = urlencode($message);
        // $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
        // $ch = curl_init('http://api.textlocal.in/send/?');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch);
        // curl_close($ch);

        $messages = array(
            // Put parameters here such as force or test
            'send_channel' => 'whatsapp',
            'messages' => array(
                array(
                    'number' => 919884879805,
                    'template' => array(
                        'id' => '12345',
                        'merge_fields' => array(
                            'FirstName' => 'Aleisha',
                            'LastName' => 'Britt',
                            'Custom1' => 'Custom 1 field test',
                            'Custom2' => 'Custom 2 field test',
                            'Custom3' => 'Custom 3 field test',
                        )
                    )
                )
            )
        );
         
        // Prepare data for POST request
        $data = array(
            'apikey' => 'NTc3NjQzNzY2NDMyNTc3MTQ4NmQ3MjYxNzE3MTcwNjM=',
            'data' => json_encode($messages)
        );
         
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/bulk_json/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return redirect()->back()->with('message', $response);
    }

    public function whatsapp()
    {
        return view('salesmanager.whatsapp');
    }

    public function whatsappsend(Request $request)
    {
        # code...
    }
    public function leads()
    {
        $leads = lead::where('state', Auth::user()->state)->get();
        return view('salesmanager.leads', compact('leads'));
    }

    public function addleads()
    {
        return view('salesmanager.addleads');
    }

    public function addleadsave(Request $request)
    {
        // dd($request->state);
        $lead = new lead();
        $lead->property_name = $request->property_name;
        $lead->address = $request->address;
        $lead->location = 'India';
        $lead->state = $request->state;
        $lead->district = $request->district;
        $lead->prop_type = $request->prop_type;
        $lead->lead_from = $request->lead_from;
        $lead->status = 1;
        $lead->save();
        return redirect()->route('salesmanager.addleads')->with('success', 'Added a new lead.');

    }

    public function apex()
    {
        return view('salesmanager.apex');
    }
    public function employer()
    {
        $emps = User::where('state', Auth::user()->state)->get();
        
        return view('salesmanager.emplist', compact('emps'));
    }

    public function leadsview($id)
    {
        $lead= lead::where('id', $id)->get()->first();
        return view('salesmanager.leadview', compact('lead'));
    }

    public function leadssave($id, Request $request)
    {
        lead::where('id', $id)->update([
            'status' => $request->upstat
        ]);
        return redirect()->route('salesmanager.leads')->with('message', 'Lead status updated successfully.');
    }
}
