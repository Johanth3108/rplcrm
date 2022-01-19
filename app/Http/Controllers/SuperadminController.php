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
use App\Models\exepage;
use App\Models\manpage;
use App\Models\telepage;
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
        return view('superadmin.addlead', compact('props', 'users'));
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
        $prop= properties::where('id', $request->propname)->get()->first();
        $lead = new lead();
        $lead->property_name = $prop->propname;
        $lead->address = $prop->address;
        $lead->state = $prop->state;
        $lead->district = $prop->district;
        $lead->prop_type = $prop->prop_type;
        $lead->assigned_man = $request->salesman;
        $lead->assigned_exe = $request->salesexe;
        $lead->status = 1;
        $lead->save();
        return redirect()->route('admin.leads')->with('message', 'Added a lead successfully.');
    }

    public function managelead($id)
    {
        $lead = lead::where('id', $id)->get()->first();
        $prop_types = proptype::all();
        $users = User::all();
        $property = properties::where('propname', $lead->property_name)->get()->first();
        $props = properties::all();
        return view('superadmin.managelead', compact('lead', 'prop_types', 'users', 'props', 'property'));
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
            'assigned_exe' => $request->salesexe,
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
        return view('superadmin.addprop', compact('prop_types'));
    }

    public function saveprop(Request $request)
    {
        $prop = new properties();
        $prop->propname = $request->propname;
        $prop->address = $request->address;
        $prop->district = $request->district;
        $prop->state = $request->state;
        $prop->prop_type = $request->prop_type;
        $prop->owner = $request->owner;
        $prop->status = $request->status;
        $prop->save();
        return redirect()->route('admin.properties')->with('message', 'Added a property successfully.');
    }

    public function manageprop($id)
    {
        $prop = properties::where('id', $id)->get()->first();
        $prop_types = proptype::all();
        return view('superadmin.manageprop', compact('prop', 'prop_types'));
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
        ]);
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
        // dd($this->user);
        return view('superadmin.manpage');
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
        return view('superadmin.exepage');
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
        return view('superadmin.telepage');
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
}
