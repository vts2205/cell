<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Models\Transactions;
use App\Models\Profile;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function userId(){
        $last_row = Profile::latest()->first();
        if(empty($last_row)){
         $userId='7000';
        }else{
         $userId=$last_row->user_id+1;
        }
        return $userId;
    }
    public function profileId(){
        $last_row = Profile::latest()->first();
        $profileId=$last_row->id;
        return $profileId;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required','digits:10','unique:profile,phone'],
            'branch' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Profile::create([
        'name' => $data['name'],
        'phone' => $data['phone'],
        'address' => $data['address'],
        'branch_id' => Crypt::decrypt($data['branch']),
        'current_position'=>'0',
        'user_id'=>$this->userId(),
        ]);
        $previousUsers = Profile::where('id','<', $this->profileId())->get();
        if(!empty($previousUsers)){
        foreach ($previousUsers as $key => $value) {
          if($value->current_position=='25'){
            Profile::find($value->id)->update(['current_position'=> '0']);
            }else{
                Profile::find($value->id)->update(['current_position'=> $value->current_position+1]);
                  if($value->current_position=='24'){
                    Transactions::create([
                        'profile_id' => $value->id,
                        'details' => 'limit reached',
                        'amount'=>'200',
                        'cd_status'=>'1',
                    ]);
                  }  
            }
        }
        }
        $user= User::create([
            'name' => $data['name'],
            'profile_id'=>$this->profileId(),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        Transactions::create([
            'profile_id' => $this->profileId(),
            'details' =>'Sign Up',
            'amount' => '50',
            'cd_status' => '1',
        ]);

         return $user;
    }
}
