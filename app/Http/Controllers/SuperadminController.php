<?php

namespace App\Http\Controllers;

use App\Models\lead;
use App\Models\properties;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index()
    {
        $emps = User::all();
        $empcn = User::all()->count();
        return view('superadmin.index', compact('emps', 'empcn'));
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
        return view('superadmin.inbox');
    }

    public function read()
    {
        return view('superadmin.read');
    }

    public function compose()
    {
        return view('superadmin.compose');
    }

    public function apex()
    {
        return view('superadmin.apex');
    }

    public function addlead()
    {
        return view('superadmin.addlead');
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
        $lead = new lead();
        $lead->property_name = $request->property_name;
        $lead->address = $request->address;
        $lead->state = $request->state;
        $lead->district = $request->district;
        $lead->prop_type = $request->prop_type;
        $lead->lead_from = $request->lead_from;
        $lead->status = $request->status;
        $lead->save();
        return redirect()->route('admin.leads')->with('message', 'Added a lead successfully.');
    }

    public function managelead($id)
    {
        $lead = lead::where('id', $id)->get()->first();
        return view('superadmin.managelead', compact('lead'));
    }

    public function updatelead(Request $request, $id)
    {
        lead::where('id', $id)->update([
            'property_name' => $request->property_name,
            'address' => $request->address,
            'status' => $request->status
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
            $truecaller = false;
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
        return view('superadmin.addprop');
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
        return view('superadmin.manageprop', compact('prop'));
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
}
