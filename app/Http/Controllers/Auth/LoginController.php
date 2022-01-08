<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Dotenv\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        $for = [
            'superadmin' => 'admin.home',
            'salesmanager'  => 'salesmanager.home',
            'salesexecutive'  => 'salesexecutive.home',
            'telecaller'  => 'telecaller.home',
        ];
        if (Auth::check() && Auth::user()->salesmanager==1){
            return $this->redirectTo = route('salesmanager.home');
        }
        elseif (Auth::check() && Auth::user()->superadmin==1){
            return $this->redirectTo = route('admin.home');
            // return redirect()->route('salesmanager.home');
        }
        elseif (Auth::check() && Auth::user()->salesexecutive==1){
            return $this->redirectTo = route('salesexecutive.home');
        }
        elseif (Auth::check() && Auth::user()->telecaller==1){
            return $this->redirectTo = route('telecaller.home');

        }
        else{
            Auth::logout();
            return redirect()->route('login');
        }
        
        return $this->redirectTo = route($for[auth()->user()->role]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request)
    // {   
    //     dd($request);
    //     $input = $request->all();
   
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
   
    //     if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
    //     {
    //         if (auth()->user()->is_admin == 1) {
    //             return redirect()->route('admin.home');
    //         }else{
    //             return redirect()->route('home');
    //         }
    //     }else{
    //         return redirect()->route('login')
    //             ->with('error','Email-Address And Password Are Wrong.');
    //     }
          
    // }
    public function logout()
    {
        auth()->logout();
        //session()->flash('message', 'Some goodbye message');
        return redirect('/login');
    }
}
