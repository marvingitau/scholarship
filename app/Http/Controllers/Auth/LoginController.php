<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function redirectTo()
    {
        $usr = Auth::user();
        // if (is_null($usr->email_verified_at) && $usr->role == 'clerk') {
        //     Auth::logout();
        //     return '/login';
        // }
        // if (is_null($usr->email_verified_at) && $usr->role == 'admin' && $usr->approved == 0) {
        //     Auth::logout();
        //     return '/login';
        // }
        $role = $usr->role;
        switch ($role) {
            case 'admin':
                $admin_session_id = Session::get('admin_session_id');
                if (empty($admin_session_id)) {
                    $admin_session_id = Str::random(40);
                    Session::put('admin_session_id', $admin_session_id);
                }
                return '/admin';
                break;
            case 'clerk':
                $clerk_session_id = Session::get('clerk_session_id');
                if (empty($clerk_session_id)) {
                    $clerk_session_id = Str::random(40);
                    Session::put('clerk_session_id', $clerk_session_id);
                }
                return '/clerk';
                // $user_profile_exists=DB::table('profiles')->where('user_id',auth()->user()->id)->count();
                // if($user_profile_exists>0){
                //     return '/employer';
                // }
                // else{
                //     return '/employer/Profile/Create';
                // }

                break;
            default:
                return '/';
                break;
        }
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

    
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
