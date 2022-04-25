<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\User;
use Hash;


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
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectTo()
    {
        return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
    }

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('guest')->except('logout');
        Session::put('backUrl', URL::previous());
    }

    public function authenticated(Request $request, $user)
{
    if ($user->hasRole('admin')) {
        return redirect()->route('dashboard');
    }elseif ($user->hasRole('user')) {
        return redirect()->route('schedule.index');
    }
    return redirect()->route('login');
}
public function apiLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
            $user = User::where('email', $request->email)->first();
            $data = array(
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            );
            return response()->json(['success' => 200,'message'=> 'Login Successfuly', 'data' => $data,]);
        }
        }
}