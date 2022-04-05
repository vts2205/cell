<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        if(auth()->check()){
            if(Auth::User()->is_admin=='1'){
            return redirect()->intended(url('admin/users'));
            }else{
            return redirect()->intended(url('user/dashboard'));
            }
        }else{
            return view('/login');
        }
    }
}
