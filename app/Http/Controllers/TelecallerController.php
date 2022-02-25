<?php

namespace App\Http\Controllers;

use App\Models\assign;
use App\Models\assign_lead;
use App\Models\event;
use App\Models\feedback;
use App\Models\lead;
use App\Models\message;
use App\Models\properties;
use App\Models\status;
use App\Models\telepage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TelecallerController extends Controller
{
    public function __construct()
    {        
        $this->middleware(function ($request, $next) {      
            $noti = User::where('id', Auth::user()->id)->get()->first()->notification;
            $telepage = telepage::where('id', 1)->get()->first();
            $messages = message::where('reciever_id', Auth::user()->id)->get();
            view()->share('telepage', $telepage);
            view()->share('messsages', $messages);
            view()->share('noti', $noti);
            return $next($request);
        });
        
    }

    public function index()
    {
        return view('telecaller.index');
    }

    public function profile()
    {
        return view('telecaller.profile');
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
 
       return view('telecaller.calender');
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

    public function assigned()
    {
        $leads = assign_lead::where('assigned_tele', Auth::user()->id)->get();
        // $property = properties::where('property_name', )
        return view('telecaller.assigned', compact('leads'));
    }

    public function message()
    {
        $users = User::all();
        return view('telecaller.pmessage', compact('users'));
    }

    public function reply($id)
    {
        $reciever = User::where('id', $id)->get()->first();
        return view('telecaller.reply', compact('reciever'));
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

    public function feedback($id)
    {
        $feedbacks = feedback::where('lead_id', $id)->get();
        $lead = lead::where('id', $id)->first();
        $status = status::all();
        return view('telecaller.feedback', compact('feedbacks', 'lead', 'status'));
    }

    public function feedbacksend(Request $request)
    {
        $feedback = new feedback();
        $feedback->lead_id = $request->lead_id;
        $feedback->fb_name = $request->fb_name;
        $feedback->message = $request->message;
        $feedback->save();
        lead::where('id', $request->lead_id)->update(["status"=>$request->stat]);
        return redirect()->back()->with('message', 'Feedback submitted successfully');
    }

    public function leadtele()
    {
        $manual_leads = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($manual_leads, DB::table('assign_leads')->whereMonth('created_at', $i)->where('assigned_tele', Auth::user()->id)->get()->count());
        }
        $manual_leads = implode("','",$manual_leads);
        return view('telecaller.leadprop', compact('manual_leads'));
    }
}
