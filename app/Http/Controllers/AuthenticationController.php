<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use \QrCode;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function signin(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
    		
        if (!Auth::attempt(['phone' => $request->email, 'password' => $request->password] )) {
            return ['status'=>0,'msg'=>'Credentials not match'];
        }
        else{
            if(auth()->user()->is_admin==0){
                return ['status'=>1,'msg'=>'Successfully Logged In','token' => auth()->user()->createToken('API Token')->plainTextToken];
            }else{
                return ['status'=>0,'msg'=>'Admin could not Login'];
            }
        }
    }

    // this method signs out users by removing tokens
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return ['status'=>1,'message' => 'Successfully Logged Out'];
    }
    public function qrCodeGenerate()
    {
    		// return auth()->user();
    	// if($id==auth()->user()->tokens())
       $profile = Profile::where('id', auth()->user()
       ->profile_id)
       ->get();
        	$userdata=[];
    	foreach($profile as $data){
        	$userdata[]=['name'=>$data->name,'phone'=>$data->phone,'place'=>$data->place,'image'=>url('/storage/images/'.$data->image),'current_position'=>$data->current_position];
        }
        // return ['data' =>Crypt::encrypt(Crypt::encrypt($profile[0]->id)."-".Crypt::encrypt($profile[0]->phone))];
       // return ['status'=>1,'message' => 'Success','data' =>['qr'=> "'".QrCode::size(200)->generate(Crypt::encrypt($profile[0]->id)."-".Crypt::encrypt($profile[0]->phone))."'"]];
       return ['status'=>1,'message' => 'Success','data' =>['user'=>$userdata,'qr'=> Crypt::encrypt(Crypt::encrypt($profile[0]->id)."-".Crypt::encrypt($profile[0]->phone))]];
       // return ['status'=>1,'message' => 'Success','data' =>['qr'=> url('/image/qrcode/'.Crypt::encrypt($profile[0]->id).'/android')]];
    }

	public function qrImgAccess(Request $request,$id,$process)
    {
    // dd('aa');
    	if(stripos(strtolower($request->header('User-Agent')),'android') == false){
         	abort('404');
        }
    
    	if($process=="android"){
      	 	try{
            
        		$profile = Profile::where('id', Crypt::decrypt($id))->get();
            	
            }catch(\Exception $e){
            	return null;
            }
        
        }
    		// return auth()->user();
    	// if($id==auth()->user()->tokens())
        // return ['data' =>Crypt::encrypt(Crypt::encrypt($profile[0]->id)."-".Crypt::encrypt($profile[0]->phone))];
       return QrCode::size(200)->generate(Crypt::encrypt($profile[0]->id)."-".Crypt::encrypt($profile[0]->phone));
       // return ['status'=>1,'message' => 'Success','data' =>['qr'=> url('/image/qrcode/'.Crypt::encrypt($profile[0]->id).'/android')]];
    }
    public function qrCodeCheck(Request $request)
    {
        $attr = $request->validate([
            'qr' => 'required|string',
        ]);
        try
        {
            $d = explode('-',Crypt::decrypt( $request->get('qr')));
            $id = Crypt::decrypt($d[0]);
            $phoneNo = Crypt::decrypt($d[1]);
        }
        catch(\Exception $e)
        {
            return ['status' => 0, 'msg' => 'User not available'];
        }
        $profile = Profile::where('id', $id)->where('phone', $phoneNo)->with('user')->get();
        if (!empty($profile))
        {
            if ($profile[0]->user->status == '1')
            {
                return ['status' => 1, 'msg' => 'success', 'data' => ['name' => $profile[0]->name,'pay-token'=>Crypt::encrypt($profile[0]->id) ]];
            }
            else
            {
                return ['status' => 2, 'msg' => "User can't accept your payment"];
            }
        }
        else
        {
            return ['status' => 0, 'msg' => 'User not available'];
        }
    }
    public function payAmount(Request $request)
    {
        $attr = $request->validate([
            'token' => 'required|string',
            'amount' => 'required|string',
            'pay-token' => 'required|string',
            'password' => 'required|string',
            'note' => 'nullable|string',
        ]);
        $token=Crypt::decrypt($request->get('token'));
        $token=explode('-', $token);
        $id = Crypt::decrypt($token[0]);
        $phoneNo = Crypt::decrypt($token[1]);
        $to = Profile::where('id', $id)->where('phone', $phoneNo)->with('user')
            ->get();
        $from = Profile::where('id', auth()->user()
            ->profile_id)
            ->with('user')
            ->get();
        if (!empty($to))
        {
        $userTransactions = Transactions::where('profile_id', auth()->user()
            ->profile_id)
            ->get();
        $totalAmount = 0;
        foreach ($userTransactions as $val)
        {
            $totalAmount += $val->amount;
        }
        $request->validate(['amount' => 'required|numeric|max:' . $totalAmount . '']);
        $password = $request->get('password');
            if (Hash::check($password, auth()->user()->password))
            {
                $amount = $request->get('amount');
                $id = Crypt::decrypt($token[0]);
                $phoneNo = Crypt::decrypt($token[1]);
                if ($id == Crypt::decrypt($request->get('pay-token')))
                {
                    if ($amount <= $totalAmount)
                    {

                        $profileId = auth()->user()->profile_id;
                        $senderNote= "Qrcode amount send - " . $request->get('note');
                        $receiverNote = "Qrcode amount received - " . $request->get('note');

                        $sendTo = Crypt::decrypt($request->get('pay-token'));
                        $sendAmount = new Transactions(['profile_id' => $profileId, 'details' => $senderNote, 'amount' => - $amount, 'from_to' => $sendTo,'cd_status' => '0']);
                        $getAmount = new Transactions(['profile_id' => $sendTo, 'details' => $receiverNote, 'amount' => $amount, 'from_to' => $profileId,'cd_status' => '1']);

                        if ($sendAmount->save())
                        {
                            $getAmount->save();

                            return ['status'=>1,'msg'=>'success','data'=>['from' => Profile::where('id', auth()
                                ->user()
                                ->profile_id)
                                ->get() , 'to' => Profile::where('id', $sendTo)->get() , 'amount' => $amount]];
                        }
                        else
                        {
                            return ['status'=>0,'msg' => 'Error occured'];

                        }
                    }
                    else
                    {
                        return ['status'=>0,'msg' => 'Insufficient Balance'];
                    }
                }
                else
                {
                    return ['status'=>0,'msg' => 'Unauthorized access'];

                }
            }
            else
            {   
                return ['status'=>0,'msg' => 'Incorrect Pin'];

            }
        }
        else
        {
            return ['status' => 0, 'msg' => "Can\'t  find user"];
        }
        
    }

    public function showTransaction(Request $request)
    {
        $userDetails = Profile::where('id', auth()->user()
            ->profile_id)->with(['transactions' => function ($query)
        {
            $query->orderBy('created_at', 'DESC');
        }
        ])
            ->get();
    	$arr=[];
    	foreach($userDetails as $value){
				$arr['user'][]=['name'=>$value->name,'phone'=>$value->phone];      	
    		foreach($value->transactions()->get() as $fa){
            	$from = $to ="";
            	if($fa->amount>0){
                	$amt=$fa->amount;
                	$status="Recieved";
                	if($fa->from_to == 'NULL' || $fa->from_to == "" ){
                    	$from = 'system admin';
                    }else{
                    	$from = User::where('profile_id',$fa->from_to)->with('profile')->get()[0]['profile']['name'];
                    }
                	
                }else{
                	$amt=$fa->amount;
                	$status="Send";
                	if($fa->from_to == 'NULL' || $fa->from_to == "" ){
                    	$to = 'system admin';
                    }else{
                    	$to = User::where('profile_id',$fa->from_to)->with('profile')->get()[0]['profile']['name'];
                    }
                }
        		$arr['transactions'][]=['amount'=>$amt,'date'=>"".$fa->created_at,'status'=>$status,'from'=>$from,'to'=>$to];
        	}
        }
        return ['status'=>1,'data'=>$arr];

    }
    public function walletAmount(Request $request)
    {
        $userDetails = Profile::where('id', auth()->user()
            ->profile_id)->with(['transactions' => function ($query)
        {
            $query->orderBy('created_at', 'DESC');
        }
        ])
            ->get();

        $walletAmount='0'; 
        foreach($userDetails[0]->transactions as $value){
            $walletAmount+=$value->amount;
        }
        return ['status'=>1,'walletAmount'=>$walletAmount];
    }
    public function profileEdit(Request $request)
    {
        $profileEdit = Profile::where('id', auth()->user()
            ->profile_id)
            ->get()->makeHidden('place');
        foreach ($profileEdit as $key => $value) {
            $profileEdit[$key]->image=url('/storage/images/'.$value->image);
        }
        return ['status'=>1,'profileEdit'=>$profileEdit];

    }
    public function profileUpdate(Request $request)
    {
        // return dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'image' => 'nullable',
        ]);
        $id=auth()->user()->profile['id'];
        $profileData=['name' => $request->get('name'),'address' => $request->get('place')];
        if($request->hasFile('image')){
            $imgName = Profile::find($id)->image;
            if($imgName!="user-avatar.jpg"){
                Storage::disk('public')->delete("images/".$imgName);
            }
            $filename = time().'_'.$request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            $profileData['image']=$filename;
        }
        if(Profile::find($id)->update($profileData)){
            return ['status'=>1,'msg'=>'Update Success'];
        }
            return ['status'=>0,'msg'=>'Update Failed'];
    }

}

