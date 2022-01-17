<?php

namespace App\Http\Controllers;

use App\Models\assign;
use App\Models\message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TelecallerController extends Controller
{
    public function index()
    {
        return view('telecaller.index');
    }

    public function profile()
    {
        return view('telecaller.profile');
    }

    public function calender()
    {
        return view('telecaller.calender');
    }

    public function assigned()
    {
        $leads = assign::where('employee_id', Auth::user()->id)->get();
        return view('telecaller.assigned', compact('leads'));
    }

    public function message()
    {
        $users = User::all();
        return view('telecaller.pmessage', compact('users'));
    }

    public function messagesend(Request $request)
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
        return redirect()->route('telecaller.message')->with('message', 'Message sent successfully');
    }

    public function inbox()
    {
        $messages = message::where('reciever_id', Auth::user()->id)->get();
        return view('telecaller.inbox', compact('messages'));
    }
}
