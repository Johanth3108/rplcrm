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
use App\Mail\leadassign;
use App\Mail\newuser;
use App\Models\assign;
use App\Models\assign_lead;
use App\Models\exepage;
use App\Models\feedback;
use App\Models\manpage;
use App\Models\telepage;
use Illuminate\Support\Facades\Mail;
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
        $emps = User::all();
        $empcn = User::all()->count();
        return view('superadmin.index', compact('emps', 'empcn'));
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
    public function addemp(Request $request)
    {

        dd($request->emppass);
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

    public function calender()
    {
        return view('superadmin.calender');
    }

    public function inbox()
    {
        $messages = message::where('reciever_id', Auth::user()->id)->get();
        return view('superadmin.inbox', compact('messages'));
    }


    public function apex()
    {
        return view('superadmin.apex');
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
        // $assign_exes = explode(",", $assigns->salesexecutive);
        // dd(($assign_exes[1][0]));

        return view('superadmin.addlead', compact('props', 'users', 'assigns', 'assign_exes'));
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
        $lead->assigned_man = $request->salesman;
        $lead->assigned_exe = $request->exe;
        $lead->status = 1;
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

        $assigns = (explode(",", $request->exe));
        $details = [
            'subject' => $lead->client_name."'s Lead has been assigned. ".$lead->property_name,
            'usrname' => User::where('id', $request->salesman)->first()->name,
            'property_name' => $prop->propname,
            'client_name' => $request->client_name,
            'client_phn' => $request->client_phn,
            'url' => URL::to('/').'/login'
        ];
        
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
        $assign_exes = (explode(",", $lead->assigned_exe));
        return view('superadmin.managelead', compact('lead', 'prop_types', 'users', 'props', 'property', 'assign_exes'));
    }

    public function deletelead($id)
    {
        lead::where('id', $id)->delete();
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
        $users = User::all();
        return view('superadmin.addprop', compact('prop_types', 'props', 'users'));
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
        $prop->salesmanager = $request->salesman;
        $prop->salesexecutive = $request->exe;
        $prop->save();
        
        $assign = new assign();
        $assign->property_name = $request->propname;
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
        return view('superadmin.manageprop', compact('prop', 'prop_types', 'users', 'assign_exes'));
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
        // dd($request->exe);
        properties::where('id', $id)->update([
            'propname' => $request->propname,
            'address' => $request->address,
            'district' => $request->district,
            'state' => $request->state,
            'prop_type' => $request->prop_type,
            'owner' => $request->owner,
            'status' => $request->status,
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

    public function manpage()
    {
        $manpage = manpage::where('id', 1)->first();
        return view('superadmin.manpage', compact('manpage'));
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
            'gen_prop' => $request->gen_prop,
            'add_prop' => $request->add_prop
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
        return view('superadmin.telepage', compact('telepage'));
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
        return view('superadmin.feedback', compact('feedbacks', 'lead'));
    }
    public function feedbacksend(Request $request)
    {
        // dd($request);
        $feedback = new feedback();
        $feedback->lead_id = $request->lead_id;
        $feedback->fb_name = $request->fb_name;
        $feedback->message = $request->message;
        $feedback->save();
        return redirect()->back()->with('message', 'Feedback submitted successfully');
    }

    public function clients(){
        $clients = lead::select('client_name')->distinct()->get();
        return view('superadmin.clients', compact('clients'));
    }
}
