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
use App\Models\Textlocal as ModelsTextlocal;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class SuperadminController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {      
            $noti = User::where('id', Auth::user()->id)->get()->first()->notification;
            $messages = message::where('reciever_id', Auth::user()->id)->get();
            view()->share('messsages', $messages);
            view()->share('noti', $noti);
            return $next($request);
        });
    }
    public function index()
    {
        // dd(lead::whereDate('created_at', Carbon::today())->get());
        $empcn = lead::whereDate('created_at', Carbon::today())->get()->count();
        $leadscn = assign::all()->count();
        $follow_up = assign_lead::where('status', 2)->get()->count();
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
                        array_push($per_status_lead, lead::where('status', $i)->get()->count());  
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
        return view('superadmin.index', compact('leads', 'empcn', 'leadscn', 'follow_up', 'status', 'per_status_lead'));
    }

    public function profileupdate(Request $request, $id)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact,
        ]);
        return redirect()->route('admin.profile')->with('message', 'Profile updated successfully.');
    }
    public function employees()
    {
        $emps = User::all();
        return view('superadmin.employees', compact('emps'));
    }
    
    public function adduser()
    {
        return view('superadmin.adduser');
    }

    

    public function deluser($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Employee successfully deleted.');
    }
    public function addemp(Request $request)
    {
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
        elseif ($request->usrtype == 1) {
            $user->salesmanager = true;
        }
        elseif ($request->usrtype == 2) {
            $user->salesexecutive = true;
        }
        elseif ($request->usrtype == 4) {
            $user->areamanager = true;
        }
        else {
            $user->telecaller = true;
        }

        $user->password = bcrypt($request->emppass);
        $user->save();

        
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
 
       return view('superadmin.calender');
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
        return view('superadmin.inbox', compact('messages'));
    }


    public function apex()
    {
        $leads = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($leads, DB::table('leads')->whereMonth('created_at', $i)->get()->count());
        }
        
        $leads = implode(",",$leads);
        
        
        return view('superadmin.apex', compact('leads'));
    }

    public function leadproperty()
    {
        $property = [];
        $per_prop = [];
        $prop_cnt = properties::all()->count();
        for ($i=1; $i <= $prop_cnt; $i++) {
            try{
                $prop = properties::where('id', $i)->first()->propname;
                array_push($property, (properties::where('id', $i)->first()->propname ? properties::where('id', $i)->first()->propname : ""));
                array_push($per_prop, (assign_lead::where('property_name', $prop)->get()->count() ? assign_lead::where('property_name', $prop)->get()->count() : ""));
            }
            catch(Exception $e) {
                continue;
            }
            
        }
        $property = implode("','",$property);
        $per_prop = implode("','",$per_prop);
        return view('superadmin.leadprop', compact('property', 'per_prop'));
    }

    public function leadmanual()
    {
        $manual_leads = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($manual_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('lead_from', 'manual')->get()->count());
        }
        $manual_leads = implode("','",$manual_leads);
        return view('superadmin.manualead', compact('manual_leads'));
    }

    public function leadauto()
    {
        $auto_leads = [];
        for ($i=1; $i <= 12 ; $i++) {
            array_push($auto_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('lead_from', '!=','manual')->get()->count());
        }

        $auto_leads = implode("','",$auto_leads);
        return view('superadmin.autolead', compact('auto_leads'));
    }

    public function report($id)
    {
        $manual_leads = [];
        $name = (User::where('id', $id)->first()->name);
        for ($i=1; $i <= 12 ; $i++) { 
            if(User::where('id', $id)->first()->areamanager==true){
                array_push($manual_leads, DB::table('leads')->whereMonth('created_at', $i)->where('assigned_areaman', $id)->get()->count());
            }
            elseif(User::where('id', $id)->first()->salesmanager==true){
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
        return view('superadmin.empreport',compact('manual_leads', 'name'));
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
        // dd($status);

        return view('superadmin.addlead', compact('props', 'users', 'assigns', 'assign_exes', 'status'));
    }

    public function profile()
    {
        return view('superadmin.profile');
    }

    public function leads()
    {
        $leads = lead::all();
        return view('superadmin.lead', compact('leads'));
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

        $assign = new assign();
        $assign->property_name = $prop->propname;
        $assign->property_id = $prop->id;
        $assign->areamanager = $request->areaman;
        $assign->salesmanager = $request->salesman;
        $assign->salesexecutive = $request->exe;
        $assign->save();

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
        
        return redirect()->route('admin.leads')->with('message', 'Added a lead successfully.');
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
        return view('superadmin.managelead', compact('lead', 'prop_types', 'users', 'props', 'property', 'assign_exes', 'status'));
    }

    public function deletelead($id)
    {
        lead::where('id', $id)->delete();
        // assign_lead::where('client_name', $lead->client_name)->where('assigned_man', $lead->assigned_man)->delete();
        return redirect()->route('admin.leads')->with('message', 'Deleted a lead successfully.');
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
            'assigned_areaman' => $request->areaman,
            'assigned_man' => $request->salesman,
            'assigned_exe' => $request->exe,
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);
        return redirect()->route('admin.leads')->with('message', 'Lead updated successfully.');
    }

    public function employeeedit($id)
    {
        $emp = User::where('id', $id)->get()->first();
        return view('superadmin.empupdate', compact('emp'));
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
        return redirect()->route('admin.employees');
    }

    public function properties()
    {
        $props = properties::all();
        return view('superadmin.properties', compact('props'));
    }

    public function addprop()
    {
        $prop_types = proptype::all();
        $props = properties::all();
        $status = status::where('stat', true)->get();
        $users = User::all();
        return view('superadmin.addprop', compact('prop_types', 'props', 'users', 'status'));
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
        if($request->file('sheet')){
            $cusbroex = time().'.'.$request->file('sheet')->extension();
            $request->file('sheet')->move(public_path('img/broucher/'), $cusbroex);
            $prop->broucher = $cusbroex;
        }
        if($request->file('image')){
            $cusimgex = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('img/image/'), $cusimgex);
            $prop->image = $cusimgex;
        }
        $prop->save();
        
        $assign = new assign();
        $assign->property_name = $request->propname;
        $assign->property_id = $prop->id;
        $assign->areamanager = $request->areaman;
        $assign->salesmanager = $request->salesman;
        $assign->salesexecutive = $request->exe;
        $assign->save();

        return redirect()->route('admin.properties')->with('message', 'Added a property successfully.');
    }

    public function manageprop($id)
    {
        $prop = properties::where('id', $id)->get()->first();
        $prop_types = proptype::all();
        $users = User::all();
        $assign_exes = (explode(",", $prop->salesexecutive));
        $status = status::all();
        return view('superadmin.manageprop', compact('prop', 'prop_types', 'users', 'assign_exes', 'status'));
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
        return redirect()->route('admin.properties')->with('message', $text);
    }

    public function updateprop(Request $request, $id)
    {
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
            'salesexecutive' => $request->exe,
        ]);
        if($request->file('sheet')){
            $cusbroex = time().'.'.$request->file('sheet')->extension();
            $request->file('sheet')->move(public_path('img/broucher/'), $cusbroex);
            properties::where('id', $id)->update(['broucher' => $cusbroex]);
        }
        if($request->file('image')){
            $cusimgex = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('img/image/'), $cusimgex);
            properties::where('id', $id)->update(['image' => $cusimgex]);
        }

        $assign = assign::where('property_id', $id)->first();

        if($assign){
            assign::where('property_id', $id)->update([
                'property_name' => $request->propname,
                'property_id' => $id,
                'areamanager' => $request->areaman,
                'salesmanager' => $request->salesman,
                'salesexecutive' => $request->exe,
            ]);
        }

        

        // $assign_exes = (explode(",", $request->exe));
        // foreach($assign_exes as $assign_exe){
        //     if()
            // $assign = new assign();
            // $assign->property_name = $request->propname;
            // $assign->salesmanager = $request->salesman;
            // $assign->salesexecutive = $request->exe;
            // $assign->save();
        // }

        return redirect()->route('admin.properties')->with('message', 'Property updated successfully.');
    }
    public function proptype()
    {
        $prop_types = proptype::all();
        return view('superadmin.proptype', compact('prop_types'));
    }

    public function proptypeadd(Request $request)
    {
        $prop_add = new proptype();
        $prop_add->prop_type = strtoupper($request->prop_type);
        $prop_add->save();
        return redirect()->route('admin.proptype')->with('message', 'Added a Property successfully.');
    }

    public function proptypedel($id)
    {
        proptype::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Successfully deleted a property.');
    }

    public function message()
    {
        $users = User::all();
        return view('superadmin.message', compact('users'));
    }

    public function reply($id)
    {
        $reciever = User::where('id', $id)->get()->first();
        return view('superadmin.reply', compact('reciever'));
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
        return redirect()->route('admin.message')->with('message', 'Message sent successfully');
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

    public function areamanpage()
    {
        $areamanpage = areamanpage::where('id', 1)->first();
        return view('superadmin.areamanpage', compact('areamanpage'));
    }

    public function areamanpagesave(Request $request)
    {
        areamanpage::where('id', 1)->update([
            'employees' => $request->employees,
            'add_user' => $request->add_user,
            'sales_man' => $request->sales_man,
            'sales_exe' => $request->sales_exe,
            'tele' => $request->tele,
            'gen_prop' => $request->gen_prop,
            'add_proptype' => $request->add_proptype,
            'add_prop' => $request->add_prop,
            'gen_leads' => $request->gen_leads,
            'add_lead' => $request->add_lead,
            'view_clients' => $request->view_clients,
            'broadcast' => $request->broadcast,
            'email' => $request->email,
            'email_temp' => $request->email_temp,
            'lpm' => $request->lpm,
            'lpp' => $request->lpp,
            'mal' => $request->mal,
            'aal' => $request->aal
        ]);
        return redirect()->back()->with('message', 'Areamanager portal updated successfully.');
    }

    public function manpage()
    {
        $manpage = manpage::where('id', 1)->first();
        return view('superadmin.manpage', compact('manpage'));
    }

    public function manpagesave(Request $request)
    {
        manpage::where('id', 1)->update([
            'lpm' => $request->lpm,
            'lpp' => $request->lpp,
            'mal' => $request->mal,
            'aal' => $request->aal,
            'employees' => $request->employees,
            'add_user' => $request->add_user,
            'email' => $request->email,
            'email_temp' => $request->email_temp,
            'broadcast' => $request->broadcast,
            'view_clients' => $request->view_clients,
            'gen_leads' => $request->gen_leads,
            'add_lead' => $request->add_lead,
            'add_proptype' => $request->add_proptype,
            'gen_prop' => $request->gen_prop,
            'add_prop' => $request->add_prop,
        ]);
        return redirect()->back()->with('message', 'Salesmanager portal updated successfully.');
    }

    public function exepage()
    {
        $exepage = exepage::where('id', 1)->first();
        return view('superadmin.exepage', compact('exepage'));
    }

    public function exepagesave(Request $request)
    {
        exepage::where('id', 1)->update([
            'gen_leads' => $request->gen_leads,
            'view_clients' => $request->view_clients,
            'tele' => $request->tele,
            'add_tele' => $request->add_tele,
            'broadcast' => $request->broadcast,
            'email' => $request->email,
            'email_temp' => $request->email_temp,
            'lpp' => $request->lpp,
            'mal' => $request->mal,
            'aal' => $request->aal
        ]);
        return redirect()->back()->with('message', 'Salesexecutive portal updated successfully.');
    }

    public function telepage()
    {
        $telepage = telepage::where('id', 1)->first();
        return view('superadmin.telepage', compact('telepage'));
    }

    public function telepagesave(Request $request)
    {
        telepage::where('id', 1)->update([
            // 'message' => $request->message,
            // 'whatsapp' => $request->whatsapp,
            // 'calendar' => $request->calendar,
            // 'employees' => $request->employees,
            // 'add_user' => $request->add_user,
            'apex' => $request->apex,
            // 'gen_leads' => $request->gen_leads,
            // 'add_lead' => $request->add_lead,
            'gen_leads' => $request->gen_leads
            // 'add_prop' => $request->add_prop,
            // 'assigned_leads' => $request->assigned_leads
        ]);
        return redirect()->back()->with('message', 'Telecaller portal updated successfully.');
    }

    public function feedback($id)
    {
        $feedbacks = feedback::where('lead_id', $id)->get();
        $lead = lead::where('id', $id)->first();
        $status = status::all();
        return view('superadmin.feedback', compact('feedbacks', 'lead', 'status'));
    }
    public function feedbacksend(Request $request)
    {
        // dd($request->stat);
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
        return view('superadmin.clients', compact('clients'));
    }

    public function upload()
    {
        return view('superadmin.upload');
    }

    public function sheet(Request $request)
    {
        $file = $request->file('sheet');
        // $importData = $this->csvToArray($file);

        $csvData = file_get_contents($file);
        $lines = explode(PHP_EOL, $csvData);
        $array = array();
        foreach ($lines as $line) {
            $importData[] = str_getcsv($line);
        }

        // echo($importData[1][1]);
        $data = [];
            for ($i = 0; $i < count($importData)-1; $i ++)
            {
                // echo (gettype($i));
                $data[] = [
                    'name' => $importData[$i][1],
                    'email' => $importData[$i][2],
                    'contact_number' => $importData[$i][3],
                    'department' => $importData[$i][4],
                    'superadmin' => $importData[$i][6] == '' ? null : 1,
                    'areamanager' => $importData[$i][7] == '' ? null : 1,
                    'salesmanager' => $importData[$i][8] == '' ? null : 1,
                    'salesexecutive' => $importData[$i][9] == '' ? null : 1,
                    'telecaller' => $importData[$i][10] == '' ? null : 1,
                    'state' => $importData[$i][11],
                    'district' => $importData[$i][12],
                    'password' => bcrypt('12345')
                ];

            }
        DB::table('users')->insert($data);
        return redirect()->route('admin.employees')->with('message','Data uploaded successfully.');
    }

    public function upload_propertyup(Request $request)
    {
        $file = $request->file('sheet');
        // $importData = $this->csvToArray($file);

        $csvData = file_get_contents($file);
        $lines = explode(PHP_EOL, $csvData);
        $array = array();
        foreach ($lines as $line) {
            $importData[] = str_getcsv($line);
        }

        // dd($importData[0][2]);
        $data = [];
            for ($i = 0; $i < count($importData)-1; $i ++)
            {
                // echo (gettype($i));
                $data[] = [
                    'propname' => $importData[$i][1],
                    'address' => $importData[$i][2],
                    'district' => $importData[$i][3],
                    'state' => $importData[$i][4],
                    'prop_type' => $importData[$i][6],
                    'owner' => $importData[$i][7],
                    'status' => $importData[$i][8],
                ];

            }
        DB::table('properties')->insert($data);
        return redirect()->route('admin.properties')->with('message','Data uploaded successfully.');
    }

    public function upload_property()
    {
        return view('superadmin.uploadprop');
    }

    public function upload_leads()
    {
        return view('superadmin.uploadlead');
    }
    public function upload_leadsup(Request $request)
    {
        $file = $request->file('sheet');
        // $importData = $this->csvToArray($file);

        $csvData = file_get_contents($file);
        $lines = explode(PHP_EOL, $csvData);
        $array = array();
        foreach ($lines as $line) {
            $importData[] = str_getcsv($line);
        }

        // dd($importData[0][1]);
        $data = [];
            for ($i = 0; $i < count($importData)-1; $i ++)
            {
                // echo (gettype($i));
                $data[] = [
                    'client_name' => $importData[$i][1],
                    'client_phn' => $importData[$i][2],
                    'client_em' => $importData[$i][3],
                    'property_name' => $importData[$i][4],
                    'address' => $importData[$i][6],
                    'location' => $importData[$i][7],
                    'state' => $importData[$i][8],
                    'district' => $importData[$i][9],
                    'prop_type' => $importData[$i][10],
                    'status' => 1
                ];

            }
        DB::table('leads')->insert($data);
        return redirect()->route('admin.leads')->with('message','Data uploaded successfully.');
    }

    public function message_delete($id)
    {
        message::where('id', $id)->first()->delete();
        User::where('id', Auth::user()->id)->update([
            'notification' => DB::raw('notification-1')
        ]);
        return redirect()->back()->with('message', 'Message deleted successfully.');
    }

    public function status()
    {
        $status = status::all();
        return view('superadmin.managestat', compact('status'));
    }

    public function delstat($id)
    {
        status::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Deleted a stat successfully');
    }

    public function addstat(Request $request)
    {
        $status = new status();
        $status->status = $request->status;
        $status->save();
        return redirect()->back()->with('message', 'Added a stat successfully');
    }

    public function updatestat($id)
    {
        if (status::where('id', $id)->first()->stat == true) {
            status::where('id', $id)->update(['stat' => false]);
        }
        else{
            status::where('id', $id)->update(['stat' => true]);
        }
        return redirect()->back()->with('message', 'Updated a stat successfully');
        
    }

    public function sampleemployee()
    {
        $path = storage_path('app/public/sample/sampleusers.csv');
        return response()->download($path);
    }

    public function samplelead()
    {
        $path = storage_path('app/public/sample/samplelead.csv');
        return response()->download($path);
    }
    public function sampleproperty()
    {
        $path = storage_path('app/public/sample/sampleproperties.csv');
        return response()->download($path);
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
        return view('superadmin.broadcast', compact('clients', 'ress'));
    }

    public function email()
    {
        $clients = lead::select('client_name')->distinct()->get();
        $temps = emailTemplate::all();
        return view('superadmin.email', compact('clients', 'temps'));
    }

    public function template()
    {
        $clients = lead::select('client_name')->distinct()->get();
        return view('superadmin.emailmanage', compact('clients'));
    }

    public function templateview()
    {
        $templates = emailTemplate::all();
        return view('superadmin.emailtemplate', compact('templates'));
    }

    public function templateedit($id)
    {
        $template = emailTemplate::where('id', $id)->first();
        return view('superadmin.edittemplate', compact('template'));
    }

    public function templateupdate(Request $request, $id)
    {
        // dd(emailTemplate::where('id', $id)->first());
        emailTemplate::where('id', $id)->update([
            'title' => $request->title,
            'body' => $request->message,
        ]);
        return redirect()->route('admin.email.template.view')->with('message', 'Template edited successfully.');
    }

    public function templatedelete($id)
    {
        emailTemplate::where('id', $id)->delete();
        return redirect()->route('admin.email.template.view')->with('message', 'Template deleted successfully.');
    }

    public function templatesave(Request $request)
    {
        $template = new emailTemplate();
        $template->title = $request->title;
        $template->body = $request->message;
        $template->save();
        return redirect()->route('admin.email.template')->with('message', 'email template created sucessfully.');
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

    public function test()
    {
        dd('test');
    }
}
