<?php

namespace App\Http\Controllers;

use App\Models\assign;
use App\Models\assign_lead;
use App\Models\event;
use App\Models\exepage;
use App\Models\feedback;
use App\Models\lead;
use App\Models\message;
use App\Models\properties;
use App\Models\status;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesexecutiveController extends Controller
{
    public function __construct()
    {        
        $this->middleware(function ($request, $next) {      
            $noti = User::where('id', Auth::user()->id)->get()->first()->notification;
            $exepage = exepage::where('id', 1)->get()->first();
            $messages = message::where('reciever_id', Auth::user()->id)->get();
            view()->share('exepage', $exepage);
            view()->share('messsages', $messages);
            view()->share('noti', $noti);
            return $next($request);
        });
        
    }


    public function index()
    {
        $leads = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($leads, DB::table('leads')->whereMonth('created_at', $i)->get()->count());
        }

        $lead_status = assign_lead::whereDate('created_at', Carbon::today())->where('assigned_exe', Auth::user()->id)->get()->count();
        // dd($lead_status);
        
        $leads = implode(",",$leads);
        
        $per_prop = [];
        $per_status_lead = [];
        $stat_cnt =  status::orderBy('id', 'DESC')->first()->id;
        for ($i=1; $i <= $stat_cnt; $i++) {
            
                try{
                    // dd(status::where('id', 3)->first()->status);
                    if (status::where('id', $i)->first()) {
                        $stat = status::where('id', $i)->first()->status;
                        array_push($per_prop, status::where('id', $i)->first()->status);
                        array_push($per_status_lead, lead::where('status', $i)->get()->count());  
                    }
                }
                catch(Exception $e) {
                    continue;
                }
        }
        $lead_status = assign_lead::whereDate('created_at', Carbon::today())->where('assigned_exe', Auth::user()->id)->get()->count();
        $per_prop = implode("','",$per_prop);
        $per_status_lead = implode("','",$per_status_lead);
        return view('salesexecutive.index', compact('leads', 'lead_status', 'per_prop', 'per_status_lead'));
    }
    public function profile()
    {
        return view('salesexecutive.profile');
    }
    public function message()
    {
        return view('salesexecutive.message');
    }
    public function whatsapp()
    {
        return view('salesexecutive.whatsapp');
    }
    public function calender(Request $request)
    {
        if($request->ajax()) {
       
            $data = event::whereDate('start', '>=', $request->start)
                      ->whereDate('end',   '<=', $request->end)
                      ->where('user_id', Auth::user()->id)
                      ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
       }
 
       return view('salesexecutive.calender');
    }

    public function calenderajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
               $event = Event::create([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
               ]);
  
               return response()->json($event);
              break;
   
            case 'update':
               $event = Event::find($request->id)->update([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
               ]);
  
               return response()->json($event);
              break;
   
            case 'delete':
               $event = Event::find($request->id)->delete();
   
               return response()->json($event);
              break;
              
            default:
              break;
         }
        
    }
    public function leads()
    {
        $leads = lead::where('district', Auth::user()->district)->get();
        return view('salesexecutive.leads', compact('leads'));
    }
    public function assign()
    {
        $telecallers = User::where('telecaller', true)->get();
        $leads = lead::where('district', Auth::user()->district)->get();
        $a_leads = lead::where('assigned_exe', Auth::user()->id)->get();
        return view('salesexecutive.assign', compact('telecallers','leads', 'a_leads'));
    }
    public function assignsend(Request $request)
    {
        $lead = lead::where('id', $request->lead)->get()->first();
        $lead->update(['assigned_tele'=>$request->telecaller]);
        $telecaller = User::where('id', $request->telecaller)->get()->first();
        // dd($telecaller->id);
        $assign = new assign_lead();
        $assign->client_name = $lead->client_name;
        $assign->client_phn = $lead->client_phn;
        $assign->client_em = $lead->client_em;
        $assign->property_name = $lead->property_name;
        $assign->address = $lead->address;
        $assign->state = $lead->state;
        $assign->district = $lead->district;
        $assign->prop_type = $lead->prop_type;
        $assign->lead_from = $lead->lead_from;
        $assign->assigned_tele = $telecaller->id;
        $assign->status = 1;
        $assign->save();
        return redirect()->route('salesexecutive.assign')->with('message', $lead->property_name.' has been assigned to '.$telecaller->name.' (telecaller).');
    }

    public function leadsview($id)
    {
        $lead = lead::where('id', $id)->get()->first();
        $status = status::where('stat', true)->get();
        return view('salesexecutive.viewlead', compact('lead', 'status'));
    }

    public function leadssave(Request $request, $id)
    {
        lead::where('id', $id)->update([
            'status' => $request->upstat,
        ]);
        return redirect()->route('salesexecutive.leads')->with('message', 'Lead status updated successfully.');
    }

    public function pmessage()
    {
        $users = User::all();
        return view('salesexecutive.pmessage', compact('users'));
    }

    public function pmessagereply($id)
    {
        $reciever = User::where('id', $id)->get()->first();
        return view('salesexecutive.reply', compact('reciever'));
    }

    public function leadproperty()
    {
        $property = [];
        $per_prop = [];
        $prop_cnt = properties::all()->count();
        for ($i=1; $i <= $prop_cnt; $i++) {
            $prop = properties::where('id', $i)->first()->propname;
            array_push($property, properties::where('id', $i)->first()->propname);
            array_push($per_prop, assign_lead::where('property_name', $prop)->where('assigned_exe', Auth::user()->id)->get()->count());
        }
        $property = implode("','",$property);
        $per_prop = implode("','",$per_prop);
        return view('salesexecutive.leadprop', compact('property', 'per_prop'));
    }

    public function leadmanual()
    {
        $manual_leads = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($manual_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('lead_from', 'manual')->where('assigned_exe', Auth::user()->id)->get()->count());
        }
        $manual_leads = implode("','",$manual_leads);
        return view('salesexecutive.manualead', compact('manual_leads'));
    }

    public function leadauto()
    {
        $auto_leads = [];
        for ($i=1; $i <= 12 ; $i++) {
            array_push($auto_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('lead_from', '!=','manual')->where('assigned_man', Auth::user()->id)->get()->count());
        }

        $auto_leads = implode("','",$auto_leads);
        return view('salesexecutive.autolead', compact('auto_leads'));

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
        return redirect()->route('salesexecutive.pmessage')->with('message', 'Message sent successfully');
    }

    public function inbox()
    {
        $messages = message::where('reciever_id', Auth::user()->id)->get();
        return view('salesexecutive.inbox', compact('messages'));
    }

    public function assigned()
    {
        $leads = lead::where('assigned_exe', Auth::user()->id)->get();
        // lead::where('property_name')
        return view('salesexecutive.assigned', compact('leads'));
    }

    public function feedback($id)
    {
        $feedbacks = feedback::where('lead_id', $id)->get();
        $lead = lead::where('id', $id)->first();
        $status = status::all();
        $executives = User::where('salesexecutive', true)->get();
        return view('salesexecutive.feedback', compact('feedbacks', 'lead', 'status', 'executives'));
    }

    public function feedbacksend(Request $request)
    {
        if($request->transfer){
            $lead = lead::where('id', $request->lead_id)->first();
            $assign_lead = assign_lead::where('client_name', $lead->client_name)->first();
            $assign_lead->update(["assigned_exe" => $request->transfer]);
            // lead::where('id', $request->lead_id)->first()->assigned_exe;
        }
        $feedback = new feedback();
        $feedback->lead_id = $request->lead_id;
        $feedback->fb_name = $request->fb_name;
        if ($request->transfer) {
            $feedback->message = "Lead has been transferred.";
        }
        elseif($request->stat){
            $feedback->message = "Lead status has been updated.";
        }
        else{
            $feedback->message = $request->message;
        }
        
        $feedback->save();
        if ($request->stat) {
            lead::where('id', $request->lead_id)->update(["status"=>$request->stat]);
        }
        if($request->transfer){
            return redirect()->back()->with('message', 'Lead transferred successfully');
        }
        if($request->stat){
            return redirect()->back()->with('message', 'Lead status updated successfully');
        }
        return redirect()->back()->with('message', 'Feedback submitted successfully');
    }
    public function clients()
    {
        $clients = lead::select('client_name')->distinct()->get();
        return view('salesexecutive.clients', compact('clients'));
    }
    public function telecallers()
    {
        $emps = User::where('telecaller', true)->get();
        return view('salesexecutive.telecallers', compact('emps'));
    }

    public function report($id)
    {
        $manual_leads = [];
        $name = (User::where('id', $id)->first()->name);
        for ($i=1; $i <= 12 ; $i++) { 
            if(User::where('id', $id)->first()->salesmanager==true){
                array_push($manual_leads, DB::table('leads')->whereMonth('created_at', $i)->where('assigned_man', $id)->get()->count());
            }
            elseif(User::where('id', $id)->first()->salesexecutive==true){
                array_push($manual_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('assigned_exe', $id)->get()->count());
            }
            else{
                array_push($manual_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('assigned_tele', Auth::user()->id)->get()->count());
            }
        }
        $manual_leads = implode("','",$manual_leads);
        return view('salesexecutive.empreport',compact('manual_leads', 'name'));
    }
}
