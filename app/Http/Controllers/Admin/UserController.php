<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Branch;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Account;
use \Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Response;

class UserController extends Controller
{
    //
    public function index()
    {
        $allUsers = Profile::whereNotNull('user_id')->paginate(8);
        return view('admin.users.grid', ['users' => $allUsers]);
    }
    public function action(Request $request)
    {
        $id = Crypt::decrypt($request->get('id'));
        $action = $request->get('action');
        switch ($action)
        {
            case 'suspend':
                if (User::find($id)->update(['status' => '0']))
                {
                    return response()
                        ->json(['msg' => "User Suspended"]);
                }
            break;
            case 'activate':
                if (User::find($id)->update(['status' => '1']))
                {
                    return response()
                        ->json(['msg' => "User Activated"]);
                }
            break;
            default:
                // code...
                
            break;
        }
    }
    public function userDetails($id)
    {
        $id = Crypt::decrypt($id);
        $userDetails = Profile::where('id', $id)->get();
        $transactionsDetails = Transactions::where('profile_id', $id)->paginate(10);
        return view('admin.users.user-data', ['userDetails' => $userDetails, 'transactions' => $transactionsDetails]);
    }

    public function create()
    {
        $allBranches = Branch::all();
        return view('admin.users.create', ['branch' => $allBranches]);
    }

    public function userId()
    {
        $last_row = Profile::latest()->first();
        // dd($last_row);
        if ($last_row->user_id==NULL)
        {
            $userId = '7000';
        }
        else
        {
            $userId = $last_row->user_id + 1;
        }
        return $userId;
    }
    public function profileId()
    {
        $last_row = Profile::latest()->first();
        $profileId = $last_row->id;
        return $profileId;
    }
    public function positionUp()
    {
    	 $maxCount=30;
		 $previousUsers = Profile::where('id', '<=', $this->profileId())
                ->get();
            if (!empty($previousUsers))
            {
                foreach ($previousUsers as $key => $value)
                {
                    if ($value->current_position == $maxCount)
                    {
                        Profile::find($value->id)
                            ->update(['current_position' => '0']);
                    }
                    else
                    {
                        Profile::find($value->id)
                            ->update(['current_position' => $value->current_position + 1]);
                        if ($value->current_position == $maxCount-1)
                        {
                            $transactions = new Transactions(['profile_id' => $value->id, 'details' => 'limit reached', 'amount' => '200','cd_status' => '1']);
                            $transactions->save();
                            $account = new Account(['profile_id' => $value->id, 'details' => 'limit reached']);
                            $account->save();
                        }
                    }
                }
            }
    
    }
    public function store(Request $request)
	
    {
        $request->validate
         ([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required','numeric', 'digits:4'],
            'phone' => ['required','digits:10'],
            'place' => ['required'],
            'branch' => ['required'],

         ]);
    
        $getPro=Profile::where('phone',$request->get('phone'));
    	if(count($getPro->get())>0){
        $getProfile=$getPro->get();
        $this->positionUp();
         $t = new Transactions(['profile_id' => $getProfile[0]->id , 'details' => 'Sign Up', 'amount' => '50','cd_status' => '1' ]);
                $acc = new Account(['profile_id' => $getProfile[0]->id , 'details' => 'New Account Created']);
                $t->save();
        // $getPro->update(['current_position' => '0']);
        $acc->save();
    	// dd("Hi");
                	$msg="New User Created! ";
        }else{
       
        $profile = new Profile(['name' => $request->get('name'), 'address' => $request->get('place') , 'phone' => $request->get('phone')  , 'branch_id' => Crypt::decrypt($request->get('branch')) , 'current_position' => '0', 'user_id' => $this->userId() , ]);
        if ($profile->save())
        {
           $this->positionUp();
        	$newUserId="M-".date('md').$this->profileId();
        	
        	
            $user = new User(['name' => $request->get('name') , 'profile_id' => $this->profileId() , 'email' => $newUserId ,'phone' => $request->get('phone') , 'password' => Hash::make($request->get('password')) ,'status' =>'1' ]);
            if ($user->save())
            {

                $t = new Transactions(['profile_id' => $this->profileId() , 'details' => 'Sign Up', 'amount' => '50','cd_status' => '1' ]);
                $acc = new Account(['profile_id' => $this->profileId() , 'details' => 'Sign Up']);
                if ($t->save() && $acc->save())
                {
                
					$userName=$request->get('name');
					$userMobileNo=$request->get('phone');
					$pin=$request->get('password');
                	$newUserId= $request->get('phone');
					$url="http://2factor.in/API/V1/4af9935b-4204-11eb-83d4-0200cd936042/ADDON_SERVICES/SEND/TSMS";
					$data=['TemplateName'=>'MobiT1','VAR1'=>$userName,'VAR2'=>$newUserId,'VAR3'=>$pin,'To'=>$userMobileNo,'From'=>'CACCAC'];
					$ch=\curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
					$reply=curl_exec($ch);
					curl_close($ch);
                	$json=json_decode($reply);
                	$msg="New User Created! ";
                	if($json->Status=='Success'){
                		$msg.=" Message sent to ".$userMobileNo;
                	}
                }
            }
        }
        }
                	return redirect('admin/users')->with('status', $msg);
    }

    public function edit($id){
        $id=Crypt::decrypt($id);
        $userData=Profile::find($id);
        // dd($userData);
        $branch=Branch::all();
        return view('admin.users.create',['userData' => $userData,'branch' => $branch]);

    }
    public function update(Request $request,$id){
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required'],
            'place' => ['required'],
            'branch' => ['required'],
        ]);
        $id=Crypt::decrypt($id);
        if(Profile::find($id)->update(['name' => $request->get('name'),'address' => $request->get('place'),'branch_id' => Crypt::decrypt($request->get('branch'))]))
        {
            if ($request->get('password')!= $request->get('old-password')) { 
            $user=array(
            'password' =>  Hash::make($request->get('password'))
            );
            User::where('profile_id',$id)->update($user);
        }
        return redirect('admin/users')->with('status', 'Profile Details Updated!');
        }
    }
    public function account(Request $request){
        // dd(Crypt::decrypt($request->id));
        $transactions=Profile::find(Crypt::decrypt($request->id))->accounts()->select('details', 'created_at')->get();
        $data['position']=Profile::find(Crypt::decrypt($request->id))->current_position;
    	foreach($transactions as $value){
        	$data['data'][]=['details'=>$value->details,'created_at'=>" ".$value->created_at];
        }
        return Response::json($data);
    }
    public function register(Request $request){
        $data=Profile::where('phone',$request->phone)->get();
        if(count($data)>0){
            $res=["status"=>"true"];
        }else{
            $res=["status"=>"false"];
        }
        return Response::json($res);
    } 
	public function profileSearch(Request $request){
        if(isset($_GET['q'])){
            $pro_ids=User::where('status','1')->where('is_admin','0')->pluck('profile_id')->toArray();
            $search_text = $_GET['q'];
            $profiles = DB::table('profile')
            ->whereIn('id',$pro_ids)
            ->where('name','LIKE','%'.$search_text.'%')
            ->orWhere('phone','LIKE','%'.$search_text.'%')
            ->pluck('id');
    		// dd($profiles);
            $profile = Profile::whereIn('id',$profiles)->paginate(8);
        	return view('admin.profile_search',['profile'=>$profile]);

        }
    } 

}

