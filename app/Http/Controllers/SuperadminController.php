<?php

namespace App\Http\Controllers;

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
}
