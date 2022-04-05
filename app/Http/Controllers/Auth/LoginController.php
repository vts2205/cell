<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout() {
        auth()->logout();
        return redirect('/login');
    }
    public function login(Request $request)
    {
    $this->validate($request, [
        'email'    => 'required',
        'password' => 'required',
    ]);

        if(Auth::attempt(['phone' => $request->email, 'password' => $request->password] )){
          if(Auth::User()->status=='1'){
            if(Auth::User()->is_admin=='1'){
            return redirect()->intended(url('admin/users'));
            }else{
            return redirect()->intended(url('user/dashboard'));
            }
          }else{
            Auth::logout();
            return redirect(url('/login'))->with('status', 'You are temporary blocked. Please contact to admin');
          }     
        }else{


    return redirect()->back()
        ->withInput()
        ->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
        }
    } 

}
