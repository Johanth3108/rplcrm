<?php

namespace App\Http\Controllers;

use App\Models\assign;
use App\Models\assign_lead;
use App\Models\feedback;
use App\Models\lead;
use App\Models\manpage;
use App\Models\message;
use App\Models\properties;
use App\Models\proptype;
use App\Models\User;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOption\None;

class SalesmanagerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {      
            $noti = User::where('id', Auth::user()->id)->get()->first()->notification;
            $manpage = manpage::where('id', 1)->get()->first();
            $messages = message::where('reciever_id', Auth::user()->id)->get();
            view()->share('manpage', $manpage);
            view()->share('messsages', $messages);
            view()->share('noti', $noti);
            return $next($request);
        });
        
        
    }
    public function index()
    {
        $leads = lead::where('state', Auth::user()->state)->get();
        $execnt = User::where('salesexecutive', true)->count();
        return view('salesmanager.index', compact('leads', 'execnt'));
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
        $props = properties::all();
        $users = User::all();

        $assigns = assign::all();
        $assign_exes = array();
        foreach ($assigns as $assign) {
            array_push($assign_exes, explode(",", $assign->salesexecutive));
        }
        return view('salesmanager.addleads', compact('props', 'users',  'assigns', 'assign_exes'));
    }

    public function addleadsave(Request $request)
    {
        // dd($request->state);

        $prop= properties::where('propname', $request->propname)->get()->first();
        $lead = new lead();
        $lead->client_name = $request->client_name;
        $lead->client_phn = $request->client_phn;
        $lead->client_em = $request->client_em;
        $lead->property_name = $prop->propname;
        $lead->address = $prop->address;
        $lead->state = $prop->state;
        $lead->district = $prop->district;
        $lead->prop_type = $prop->prop_type;
        $lead->assigned_man = $request->salesman;
        $lead->assigned_exe = $request->exe;
        $lead->status = 1;
        $lead->save();
        $assigns = (explode(",", $request->exe));

        foreach($assigns as $assi){

            $lead = new assign_lead();
            $lead->client_name = $request->client_name;
            $lead->client_phn = $request->client_phn;
            $lead->client_em = $request->client_em;
            $lead->property_name = $prop->propname;
            $lead->address = $prop->address;
            $lead->state = $prop->state;
            $lead->district = $prop->district;
            $lead->prop_type = $prop->prop_type;
            $lead->assigned_man = $request->salesman;
            $lead->assigned_exe = $assi;
            $lead->status = 1;
            $lead->save();
        }
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
        $prop_types = proptype::all();
        $users = User::all();
        $property = properties::where('propname', $lead->property_name)->get()->first();
        $props = properties::all();
        return view('salesmanager.leadview', compact('lead', 'prop_types', 'users', 'props', 'property'));
    }

    public function leadssave($id, Request $request)
    {
        $prop = properties::where('id', $request->property_id)->get()->first();
        lead::where('id', $id)->update([
            'property_name' => $prop->propname,
            'address' => $request->address,
            'state' => $request->state,
            'district' => $request->district,
            'prop_type' => $request->prop_type,
            'assigned_man' => $request->salesman,
            'assigned_exe' => $request->salesexe,
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);
        return redirect()->route('salesmanager.leads')->with('message', 'Lead status updated successfully.');
    }

    public function pmessage()
    {
        $users = User::all();
        return view('salesmanager.pmessage', compact('users'));
    }

    public function pmessagereply($id)
    {
        $reciever = User::where('id', $id)->get()->first();
        return view('salesmanager.reply', compact('reciever'));
    }

    public function pmessagesend(Request $request)
    {
        $message= new message();
        $message->sender_id = Auth::user()->id;
        $message->sender_name = Auth::user()->name;
        $message->reciever_id = $request->reciever;
        $message->message = $request->message;
        $message->save();
        User::where('id', $request->reciever)->update([
            'notification' => DB::raw('notification+1')
        ]);
        return redirect()->route('salesmanager.pmessage')->with('message', 'Message sent successfully');
    }

    public function inbox()
    {
        $messages = message::where('reciever_id', Auth::user()->id)->get();
        return view('salesmanager.inbox', compact('messages'));
    }

    public function properties()
    {
        $props = properties::all();
        return view('salesmanager.properties', compact('props'));
    }

    public function assigned()
    {
        $leads = lead::where('assigned_man', Auth::user()->id)->get();
        return view('salesmanager.assigned', compact('leads'));
    }

    public function feedback($id)
    {
        $feedbacks = feedback::where('lead_id', $id)->get();
        $lead = lead::where('id', $id)->first();
        return view('salesmanager.feedback', compact('feedbacks', 'lead'));
    }

    public function feedbacksend(Request $request)
    {
        $feedback = new feedback();
        $feedback->lead_id = $request->lead_id;
        $feedback->fb_name = $request->fb_name;
        $feedback->message = $request->message;
        $feedback->save();
        return redirect()->back()->with('message', 'Feedback submitted successfully');
    }
}
