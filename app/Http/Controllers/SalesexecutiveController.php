<?php

namespace App\Http\Controllers;

use App\Models\assign;
use App\Models\lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesexecutiveController extends Controller
{
    public function index()
    {
        return view('salesexecutive.index');
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
    public function calender()
    {
        return view('salesexecutive.calender');
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
        return view('salesexecutive.assign', compact('telecallers','leads'));
    }
    public function assignsend(Request $request)
    {
        $lead = lead::where('id', $request->lead)->get()->first();
        $telecaller = User::where('id', $request->telecaller)->get()->first();
        $assign = new assign();
        $assign->employee_id = $telecaller->id;
        $assign->property_name = $lead->property_name;

        if ($assign->salesexecutive==1) {
        $assign->salesexecutive = true;
        }
        else{
        $assign->telecaller = true;
        }
        $assign->save();
        return redirect()->route('salesexecutive.assign')->with('message', $lead->property_name.' has been assigned to '.$telecaller->name.' (telecaller).');
    }

    public function leadsview($id)
    {
        $lead = lead::where('id', $id)->get()->first();
        return view('salesexecutive.viewlead', compact('lead'));
    }

    public function leadssave(Request $request, $id)
    {
        lead::where('id', $id)->update([
            'status' => $request->upstat,
        ]);
        return redirect()->route('salesexecutive.leads')->with('message', 'Lead status updated successfully.');
    }
}
