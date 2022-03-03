<?php

namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use App\Exports\PropertiesExport;
use App\Models\lead;
use App\Models\message;
use App\Models\properties;
use App\Models\proptype;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use App\Http\Middleware\salesmanager;
use App\Mail\dynamicMail;
use App\Mail\leadassign;
use App\Mail\newuser;
use App\Models\areamanpage;
use App\Models\assign;
use App\Models\assign_lead;
use App\Models\emailTemplate;
use App\Models\event;
use App\Models\exepage;
use App\Models\feedback;
use App\Models\manpage;
use App\Models\status;
use App\Models\telepage;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class AreamanagerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {      
            $noti = User::where('id', Auth::user()->id)->get()->first()->notification;
            $messages = message::where('reciever_id', Auth::user()->id)->get();
            $areamanpage = areamanpage::where('id', 1)->get()->first();
            view()->share('areamanpage', $areamanpage);
            view()->share('messsages', $messages);
            view()->share('noti', $noti);
            return $next($request);
        });
        
        
    }
    public function index()
    {
        $empcn = lead::whereDate('created_at', Carbon::today())->get()->count();
        $leadscn = assign::all()->count();
        if ($follow_up = assign_lead::where('status', 11)->get()) {
            $follow_up = assign_lead::where('status', 11)->get()->count();
        }
        else{
            $follow_up = 0;
        }
        $leads = [];
        $status = [];
        $per_status_lead = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($leads, DB::table('leads')->whereMonth('created_at', $i)->get()->count());
        }
        $stat_cnt =  status::orderBy('id', 'DESC')->first()->id;
        for ($i=1; $i <= $stat_cnt; $i++) {
            
            try{
                // dd(status::where('id', 3)->first()->status);
                if (status::where('id', $i)->first()) {
                    $stat = status::where('id', $i)->first()->status;
                    array_push($status, status::where('id', $i)->first()->status);
                    array_push($per_status_lead, lead::where('status', $i)->where('assigned_areaman', Auth::user()->id)->get()->count());  
                }
            }
            catch(Exception $e) {
                continue;
            }
        }
        $lead_status = assign_lead::whereDate('created_at', Carbon::today())->where('assigned_exe', Auth::user()->id)->get()->count();
        $status = implode("','",$status);
        $per_status_lead = implode("','",$per_status_lead);
        
        $leads = implode(",",$leads);
        return view('areamanager.index', compact('leads', 'empcn', 'leadscn', 'follow_up', 'status', 'per_status_lead'));
    }

    public function profileupdate(Request $request, $id)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact,
        ]);
        return redirect()->route('areamanager.profile')->with('message', 'Profile updated successfully.');
    }
    public function employees()
    {
        $emps = User::all();
        return view('areamanager.employees', compact('emps'));
    }
    
    public function adduser()
    {
        return view('areamanager.adduser');
    }
    public function addemp(Request $request)
    {
        $user = new User();
        $user->name = $request->empname;
        $user->email = $request->empemail;
        $user->contact_number = $request->empph;
        $user->department = $request->dept;
        $user->district = $request->district;
        $user->state = $request->state;

        if ($request->usrtype==0) {
            $user->superadmin = true;
        }
        elseif($request->usrtype==4){
            $user->areamanager = true;
        }
        elseif ($request->usrtype == 1) {
            $user->salesmanager = true;
        }
        elseif ($request->usrtype == 2) {
            $user->salesexecutive = true;
        }
        else {
            $user->telecaller = true;
        }

        $user->password = bcrypt($request->emppass);
        $user->save();

        $details = [
            'subject' => 'Welcome to SAGI Pvt. Ltd.',
            'title' => 'SAGICRM',
            'body' => 'This is for testing email using smtp',
            'usrname' => $request->empname,
            'email' => $request->empemail,
            'password' => $request->emppass,
            'url' => URL::to('/').'/login'
        ];
       
        Mail::to($request->empemail)->send(new newuser($details));
        return back()->with('success', 'Successfully added a employee');
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
 
       return view('areamanager.calender');
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

    public function inbox()
    {
        $messages = message::where('reciever_id', Auth::user()->id)->get();
        return view('areamanager.inbox', compact('messages'));
    }


    public function apex()
    {
        $leads = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($leads, DB::table('leads')->whereMonth('created_at', $i)->get()->count());
        }
        $leads = implode(",",$leads);
        return view('areamanager.apex', compact('leads'));
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
                array_push($manual_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('assigned_tele', $id)->get()->count());
            }
        }
        $manual_leads = implode("','",$manual_leads);
        return view('areamanager.empreport',compact('manual_leads', 'name'));
    }
    public function leadproperty()
    {
        $property = [];
        $per_prop = [];
        $prop_cnt = properties::all()->count();
        for ($i=1; $i <= $prop_cnt; $i++) {
            $prop = properties::where('id', $i)->first()->propname;
            array_push($property, properties::where('id', $i)->first()->propname);
            array_push($per_prop, assign_lead::where('property_name', $prop)->get()->count());
        }
        $property = implode("','",$property);
        $per_prop = implode("','",$per_prop);
        return view('areamanager.leadprop', compact('property', 'per_prop'));
    }

    public function leadmanual()
    {
        $manual_leads = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($manual_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('lead_from', 'manual')->get()->count());
        }
        $manual_leads = implode("','",$manual_leads);
        return view('areamanager.manualead', compact('manual_leads'));
    }

    public function leadauto()
    {
        $auto_leads = [];
        for ($i=1; $i <= 12 ; $i++) {
            array_push($auto_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('lead_from', '!=','manual')->get()->count());
        }

        $auto_leads = implode("','",$auto_leads);
        return view('areamanager.autolead', compact('auto_leads'));
    }


    public function addlead()
    {
        $props = properties::all();
        $users = User::all();
        $assigns = assign::all();
        $assign_exes = array();
        foreach ($assigns as $assign) {
            array_push($assign_exes, explode(",", $assign->salesexecutive));
        }
        $status = status::where('stat', true)->get();
        // $assign_exes = explode(",", $assigns->salesexecutive);
        // dd(($assign_exes[1][0]));

        return view('areamanager.addlead', compact('props', 'users', 'assigns', 'assign_exes', 'status'));
    }

    public function profile()
    {
        return view('areamanager.profile');
    }

    public function leads()
    {
        $leads = lead::all();
        return view('areamanager.lead', compact('leads'));
    }

    public function savelead(Request $request)
    {
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
        $lead->assigned_areaman = $request->areaman;
        $lead->assigned_man = $request->salesman;
        $lead->assigned_exe = $request->exe;
        $lead->status = $request->stat;
        $lead->save();

        $message= new message();
        $message->sender_id = Auth::user()->id;
        $message->sender_name = Auth::user()->name;
        $message->reciever_id = $request->salesman;
        $message->message = 'You have a assigned lead.';
        $message->save();
        User::where('id', $request->salesman)->update([
            'notification' => DB::raw('notification+1')
        ]);

        $message= new message();
        $message->sender_id = Auth::user()->id;
        $message->sender_name = Auth::user()->name;
        $message->reciever_id = $request->areaman;
        $message->message = 'You have a assigned lead.';
        $message->save();
        User::where('id', $request->salesman)->update([
            'notification' => DB::raw('notification+1')
        ]);

        $assigns = (explode(",", $request->exe));
        $details = [
            'subject' => $lead->client_name."'s Lead has been assigned. ".$lead->property_name,
            'usrname' => User::where('id', $request->salesman)->first()->name,
            'property_name' => $prop->propname,
            'client_name' => $request->client_name,
            'client_phn' => $request->client_phn,
            'url' => URL::to('/').'/login'
        ];
        
        Mail::to(User::where('id', $request->areaman)->first()->email)->send(new leadassign($details));
        Mail::to(User::where('id', $request->salesman)->first()->email)->send(new leadassign($details));

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

            $message= new message();
            $message->sender_id = Auth::user()->id;
            $message->sender_name = Auth::user()->name;
            $message->reciever_id = $assi;
            $message->message = 'You have a assigned lead.';
            $message->save();
            User::where('id', $assi)->update([
                'notification' => DB::raw('notification+1')
            ]);
            
            $details = [
                'subject' => $lead->client_name."'s Lead has been assigned. ".$lead->property_name,
                'usrname' => User::where('id', $request->salesman)->first()->name,
                'property_name' => $prop->propname,
                'client_name' => $request->client_name,
                'client_phn' => $request->client_phn,
                'url' => URL::to('/').'/login'
            ];
            
            Mail::to(User::where('id', $assi)->first()->email)->send(new leadassign($details));
        }
        
        return redirect()->route('areamanager.leads')->with('message', 'Added a lead successfully.');
    }

    public function managelead($id)
    {
        $lead = lead::where('id', $id)->get()->first();
        $prop_types = proptype::all();
        $users = User::all();
        $property = properties::where('propname', $lead->property_name)->get()->first();
        $props = properties::all();
        $status = status::where('stat', true)->get();
        $assign_exes = (explode(",", $lead->assigned_exe));
        return view('areamanager.managelead', compact('lead', 'prop_types', 'users', 'props', 'property', 'assign_exes', 'status'));
    }

    public function deletelead($id)
    {
        lead::where('id', $id)->delete();
        return redirect()->route('areamanager.leads')->with('message', 'Deleted a lead successfully.');
    }

    public function updatelead(Request $request, $id)
    {
        $prop = properties::where('id', $request->property_id)->get()->first();
        lead::where('id', $id)->update([
            'property_name' => $prop->propname,
            'address' => $request->address,
            'state' => $request->state,
            'district' => $request->district,
            'prop_type' => $request->prop_type,
            'assigned_man' => $request->salesman,
            'assigned_exe' => $request->exe,
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);
        return redirect()->route('areamanager.leads')->with('message', 'Lead updated successfully.');
    }

    public function employeeedit($id)
    {
        $emp = User::where('id', $id)->get()->first();
        return view('areamanager.empupdate', compact('emp'));
    }

    public function save(Request $request, $id)
    {
        if ($request->position==0) {
            $superadmin = true;
            $salesmanager = false;
            $salesexecutive = false;
            $telecaller = false;
        }
        elseif ($request->position == 1) {
            $superadmin = false;
            $salesmanager = true;
            $salesexecutive = false;
            $telecaller = false;
        }
        elseif ($request->position == 2) {
            $superadmin = false;
            $salesmanager = false;
            $salesexecutive = true;
            $telecaller = false;
        }
        elseif ($request->position == 3) {
            $superadmin = false;
            $salesmanager = false;
            $salesexecutive = false;
            $telecaller = true;
        }
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'superadmin' => $superadmin,
            'salesmanager' => $salesmanager,
            'salesexecutive' => $salesexecutive,
            'telecaller' => $telecaller
        ]);
        return redirect()->route('areamanager.employees');
    }

    public function properties()
    {
        $props = properties::all();
        return view('areamanager.properties', compact('props'));
    }

    public function addprop()
    {
        $prop_types = proptype::all();
        $props = properties::all();
        $users = User::all();
        $status = status::where('stat', true)->get();
        return view('areamanager.addprop', compact('prop_types', 'props', 'users', 'status'));
    }

    public function saveprop(Request $request)
    {
        // dd(($request->exe));
        $prop = new properties();
        $prop->propname = $request->propname;
        $prop->address = $request->address;
        $prop->district = $request->district;
        $prop->state = $request->state;
        $prop->prop_type = $request->prop_type;
        $prop->owner = $request->owner;
        $prop->status = $request->status;
        $prop->areamanager = $request->areaman;
        $prop->salesmanager = $request->salesman;
        $prop->salesexecutive = $request->exe;
        $prop->save();
        
        $assign = new assign();
        $assign->property_name = $request->propname;
        $assign->areamanager = $request->areaman;
        $assign->salesmanager = $request->salesman;
        $assign->salesexecutive = $request->exe;
        $assign->save();

        return redirect()->route('areamanager.properties')->with('message', 'Added a property successfully.');
    }

    public function manageprop($id)
    {
        $prop = properties::where('id', $id)->get()->first();
        $prop_types = proptype::all();
        $users = User::all();
        $assign_exes = (explode(",", $prop->salesexecutive));
        $status = status::where('stat', true)->get();
        return view('areamanager.manageprop', compact('prop', 'prop_types', 'users', 'assign_exes', 'status'));
    }

    public function deleteprop($id)
    {
        $prop = properties::where('id', $id)->first();
        $text = "Deleted ".$prop->propname." property successfully.";
        $assign_delete = assign::where('property_name', $prop->propname)->get();
        foreach ($assign_delete as $assign) {
            $assign->delete();
        }
        $prop->delete();
        return redirect()->route('areamanager.properties')->with('message', $text);
    }

    public function updateprop(Request $request, $id)
    {
        // dd($request->exe);
        properties::where('id', $id)->update([
            'propname' => $request->propname,
            'address' => $request->address,
            'district' => $request->district,
            'state' => $request->state,
            'prop_type' => $request->prop_type,
            'owner' => $request->owner,
            'status' => $request->status,
            'areamanager' => $request->areaman,
            'salesmanager' => $request->salesman,
            'salesexecutive' => $request->exe
        ]);
        // $assign = properties::where('id', $id)->first();
        // $assign_exes = (explode(",", $assign->salesexecutive));
        // $new_assign_exes = (explode(",", $request->exe));
        // foreach($new_assign_exes as $new_assign_exe){
        //     $assign = new assign();
        //     $assign->property_name = $request->propname;
        //     $assign->salesmanager = $request->salesman;
        //     $assign->salesexecutive = $request->exe;
        //     $assign->save();
        // }

        return redirect()->route('areamanager.properties')->with('message', 'Property updated successfully.');
    }
    public function proptype()
    {
        $prop_types = proptype::all();
        return view('areamanager.proptype', compact('prop_types'));
    }

    public function proptypeadd(Request $request)
    {
        $prop_add = new proptype();
        $prop_add->prop_type = strtoupper($request->prop_type);
        $prop_add->save();
        return redirect()->route('areamanager.proptype')->with('message', 'Added a Property successfully.');
    }

    public function proptypedel($id)
    {
        proptype::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Successfully deleted a property.');
    }

    public function message()
    {
        $users = User::all();
        return view('areamanager.message', compact('users'));
    }

    public function reply($id)
    {
        $reciever = User::where('id', $id)->get()->first();
        return view('areamanager.reply', compact('reciever'));
    }

    public function messagesend(Request $request)
    {
        // $reciever = User::where('id', $request->reciever)->get()->first();
        $message= new message();
        $message->sender_id = Auth::user()->id;
        $message->sender_name = Auth::user()->name;
        $message->reciever_id = $request->reciever;
        $message->message = $request->message;
        $message->save();
        User::where('id', $request->reciever)->update([
            'notification' => DB::raw('notification+1')
        ]);
        return redirect()->route('areamanager.message')->with('message', 'Message sent successfully');
    }

    public function repdown()
    {
        return Excel::download(new UsersExport, 'users-collection.csv');
    }

    public function leadsdown()
    {
        return Excel::download(new LeadsExport, 'leads-collection.csv');
    }

    public function propertydown()
    {
        return Excel::download(new PropertiesExport, 'properties-collection.csv');
    }

    public function manpage()
    {
        $manpage = manpage::where('id', 1)->first();
        return view('areamanager.manpage', compact('manpage'));
    }

    public function manpagesave(Request $request)
    {
        manpage::where('id', 1)->update([
            'message' => $request->message,
            'whatsapp' => $request->whatsapp,
            'calendar' => $request->calendar,
            'employees' => $request->employees,
            'add_user' => $request->add_user,
            'apex' => $request->apex,
            'gen_leads' => $request->gen_leads,
            'add_lead' => $request->add_lead,
            'ass_lead' => $request->ass_lead,
            'gen_prop' => $request->gen_prop,
            'add_prop' => $request->add_prop,
            'clients' => $request->clients
        ]);
        return redirect()->back()->with('message', 'Salesmanager portal updated successfully.');
    }

    public function exepage()
    {
        $exepage = exepage::where('id', 1)->first();
        return view('areamanager.exepage', compact('exepage'));
    }

    public function exepagesave(Request $request)
    {
        exepage::where('id', 1)->update([
            'message' => $request->message,
            'whatsapp' => $request->whatsapp,
            'calendar' => $request->calendar,
            'employees' => $request->employees,
            'add_user' => $request->add_user,
            'apex' => $request->apex,
            'gen_leads' => $request->gen_leads,
            'add_lead' => $request->add_lead,
            'gen_prop' => $request->gen_prop,
            'add_prop' => $request->add_prop,
            'assign' => $request->assign
        ]);
        return redirect()->back()->with('message', 'Salesexecutive portal updated successfully.');
    }

    public function telepage()
    {
        $telepage = telepage::where('id', 1)->first();
        return view('areamanager.telepage', compact('telepage'));
    }

    public function telepagesave(Request $request)
    {
        telepage::where('id', 1)->update([
            'message' => $request->message,
            'whatsapp' => $request->whatsapp,
            'calendar' => $request->calendar,
            'employees' => $request->employees,
            'add_user' => $request->add_user,
            'apex' => $request->apex,
            'gen_leads' => $request->gen_leads,
            'add_lead' => $request->add_lead,
            'gen_prop' => $request->gen_prop,
            'add_prop' => $request->add_prop,
            'assigned_leads' => $request->assigned_leads
        ]);
        return redirect()->back()->with('message', 'Telecaller portal updated successfully.');
    }

    public function feedback($id)
    {
        $feedbacks = feedback::where('lead_id', $id)->get();
        $lead = lead::where('id', $id)->first();
        $status = status::all();
        return view('areamanager.feedback', compact('feedbacks', 'lead', 'status'));
    }
    public function feedbacksend(Request $request)
    {
        $feedback = new feedback();
        $feedback->lead_id = $request->lead_id;
        $feedback->fb_name = $request->fb_name;
        if($request->stat){
            $feedback->message = "Status of lead updated.";
        }
        else{
            $feedback->message = $request->message;
        }
        
        $feedback->save();
        lead::where('id', $request->lead_id)->update(["status"=>$request->stat]);
        return redirect()->back()->with('message', 'Feedback submitted successfully');
    }

    public function clients(){
        $clients = lead::select('client_name')->distinct()->get();
        return view('areamanager.clients', compact('clients'));
    }

    public function broadcast()
    {
        $clients = lead::select('client_name')->distinct()->get();

        $apiKey = urlencode('NTc3NjQzNzY2NDMyNTc3MTQ4NmQ3MjYxNzE3MTcwNjM=');
        // Prepare data for POST request
        $data = array('apikey' => $apiKey);
    
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/get_templates/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        // echo gettype($response);
        $res = json_decode($response, true);
        $ress = $res['templates'];
        // dd($ress);
        return view('areamanager.broadcast', compact('clients', 'ress'));
    }

    public function email()
    {
        $clients = lead::select('client_name')->distinct()->get();
        $temps = emailTemplate::all();
        return view('areamanager.email', compact('clients', 'temps'));
    }

    public function template()
    {
        $clients = lead::select('client_name')->distinct()->get();
        return view('areamanager.emailmanage', compact('clients'));
    }

    public function templateview()
    {
        $templates = emailTemplate::all();
        return view('areamanager.emailtemplate', compact('templates'));
    }

    public function templateedit($id)
    {
        $template = emailTemplate::where('id', $id)->first();
        return view('areamanager.edittemplate', compact('template'));
    }

    public function templateupdate(Request $request, $id)
    {
        // dd(emailTemplate::where('id', $id)->first());
        emailTemplate::where('id', $id)->update([
            'title' => $request->title,
            'body' => $request->message,
        ]);
        return redirect()->route('areamanager.email.template.view')->with('message', 'Template edited successfully.');
    }

    public function templatedelete($id)
    {
        emailTemplate::where('id', $id)->delete();
        return redirect()->route('areamanager.email.template.view')->with('message', 'Template deleted successfully.');
    }

    public function templatesave(Request $request)
    {
        $template = new emailTemplate();
        $template->title = $request->title;
        $template->body = $request->message;
        $template->save();
        return redirect()->route('areamanager.email.template')->with('message', 'email template created sucessfully.');
    }

    public function templateajax($id)
    {
        $template = emailTemplate::where('id', $id)->first()->body;
        return response()->json(['template'=>$template]);
    }

    public function templatesend(Request $request)
    {
        // dd($request);
        $clients = (explode(",", $request->list_clients));
        foreach ($clients as $client) {
            $details = [
            'subject' => 'SAGIREALTY.CO',
            'message' => $request->message,
            'client_name' => lead::where('id', $client)->first()->client_name
        ];
        Mail::to(lead::where('id', $client)->first()->client_em)->send(new dynamicMail($details));
        }
        return redirect()->back()->with('message', "Mails sent successfully.");
    }

    public function sendSMS(Request $request)
    {
        // dd($request);

        $apiKey = urlencode('NTc3NjQzNzY2NDMyNTc3MTQ4NmQ3MjYxNzE3MTcwNjM=');
        
        // Message details
        $numbers = array($request->list_clients);
        $sender = urlencode('287656');
        $message = rawurlencode($request->template);
    
        $numbers = implode(',', $numbers);
    
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
    
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        // Process your response here
        echo $response;
        $balance = json_decode($response, true);
        // return redirect()->back()->with('message', $response);
        return redirect()->back()->with('message', "Messages sent successfully, Balance text credits: ".$balance['balance']);
    }
}
