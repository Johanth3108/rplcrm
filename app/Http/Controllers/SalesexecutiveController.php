<?php

namespace App\Http\Controllers;

use App\Models\assign;
use App\Models\exepage;
use App\Models\lead;
use App\Models\message;
use App\Models\User;
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
        $leads = lead::where('state', Auth::user()->state)->get();
        return view('salesexecutive.index', compact('leads'));
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
        $leads = assign::where('salesexecutive', Auth::user()->id)->get();
        // lead::where('property_name')
        return view('salesexecutive.assigned', compact('leads'));
    }
}
