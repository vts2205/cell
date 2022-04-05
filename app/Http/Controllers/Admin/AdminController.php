<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Branch;
use App\Models\Transactions;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    public function index()
    {
        $userDetails = Profile::where('id', auth()->user()
            ->profile_id)->with(['transactions' => function ($query)
        {
            $query->orderBy('created_at', 'DESC');
        }
        ])
            ->get();
    // dd($userDetails);
        return view('admin.pay-details.index',['userDetails' => $userDetails]);
    }
    public function viewProfile(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $profile = Profile::where('id', $id)->get();
        // dd($id);
        return view('admin.profile', ['userDetails' => $profile]);

    }
    public function updateUserDetails(Request $request, $id)
    {
        $request->validate(['name' => ['required', 'string', 'max:255'], 'email' => ['required', 'string', 'email', 'max:255'], 'password' => ['required', 'string', 'min:8'], 'phone' => ['required', 'digits:10'],'img'=>['mimes:jpg,png'] ]);
        $id = Crypt::decrypt($id);
        $profileData=['name' => $request->get('name') , 'phone' => $request->get('phone') ];
        if($request->hasFile('img')){
       		$imgName = Profile::find($id)->image;
        	if($imgName!="user-avatar.jpg"){
    			Storage::disk('public')->delete("images/".$imgName);
        	}
        	$filename = time().'_'.$request->img->getClientOriginalName();
        	$request->img->storeAs('images',$filename,'public');
        	$profileData['image']=$filename;
        }
        if (Profile::find($id)->update($profileData))
        {
            if ($request->get('password') == $request->get('old-password'))
            {
                $user = array(
                    'name' => $request->get('name'),
                    'email' => $request->get('email') ,
                );
            }
            else
            {
                $user = array(
                    'name' => $request->get('name'),
                    'email' => $request->get('email') ,
                    'password' => Hash::make($request->get('password'))
                );
            }
            User::where('profile_id', $id)->update($user);
            return redirect()->back()
                ->with('message', 'Details Updated!');
        }
    }
    public function qrCodeGenerate()
    {
        $profile = Profile::where('id', auth()->user()
            ->profile_id)
            ->get();
        return view('admin.pay-details.qrcode', ['profile' => $profile]);
    }
    public function qrUserCheck(Request $request)
    {
        // dd($request->get('qr'));
        $token = $request->get('qr');
        try
        {
            $d = explode('-', $request->get('qr'));
            $id = Crypt::decrypt($d[0]);
            $phoneNo = Crypt::decrypt($d[1]);
        }
        catch(\Exception $e)
        {
            return response()->json(['status' => 0, 'msg' => 'User not available']);
        }
        $profile = Profile::where('id', $id)->where('phone', $phoneNo)->with('user')
            ->get();
        if (!empty($profile))
        {
            // dd($profile
            //     );
            if ($profile[0]
                ->user->status == '1')
            {
                Session::put('token', $d);
                Session::put('readyForPayment', true);
                Session::put('id', $id);
                return response()->json(['status' => 1, 'msg' => 'success', 'data' => ['name' => $profile[0]->name, 'url' => '/admin/qr-scan/validate'], ]);
            }
            else
            {
                return response()
                    ->json(['status' => 2, 'msg' => "User can't accept your payment"]);
            }
        }
        else
        {
            return response()
                ->json(['status' => 0, 'msg' => 'User not available']);
        }
    }
    public function finalValidate(Request $request)
    {
        // dd(Session::get('token'));
        if (Session::get('readyForPayment'))
        {
            $token = Session::get('token');
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
                if ($to[0]
                    ->user->status == '1')
                {
                    // if ($from[0]
                    // ->user->status == '1')
                    // {
                    return view('admin.pay-details.payment', ['from' => $from, 'to' => $to]);
                    // }else{
                    //     auth()->logout();
                    // return redirect(url('/logout'))->with('status', 'You are temporary blocked. Please contact to admin');
                    // }
                    
                }
                else
                {
                    return response()->json(['status' => 2, 'msg' => 'User account cannot accept payment', 'url' => '/admin/qr-scan/status']);
                }
            }
            else
            {
                return response()
                    ->json(['status' => 0, 'msg' => "Can\'t  find user", 'url' => '/admin/qr-scan/status']);
            }

        }
        else
        {
            return redirect('/admin/payment');
        }
    }

    public function payAmount(Request $request)
    {
        $userTransactions = Transactions::where('profile_id', auth()->user()
            ->profile_id)
            ->get();
        $totalAmount = 0;
        foreach ($userTransactions as $val)
        {
            $totalAmount += $val->amount;
        }
        // dd($totalAmount);
        $request->validate(['amount' => 'required|numeric|max:' . $totalAmount . '']);

        $password = $request->get('password');
        if (Session::get('readyForPayment'))
        {
            if (Hash::check($password, auth()->user()
                ->password))
            {
                $amount = $request->get('amount');
                $token = Session::get('token');
                $id = Crypt::decrypt($token[0]);
                $phoneNo = Crypt::decrypt($token[1]);
                if ($id == Crypt::decrypt($request->get('token')))
                {

                    if ($amount <= $totalAmount)
                    {

                        $profileId = auth()->user()->profile_id;
                        $senderNote= "Qrcode amount send - " . $request->get('note');
                        $receiverNote = "Qrcode amount received - " . $request->get('note');

                        $sendTo = Crypt::decrypt($request->get('token'));
                        $sendAmount = new Transactions(['profile_id' => $profileId, 'details' => $senderNote, 'amount' => - $amount, 'from_to' => $sendTo,'cd_status' => '0']);
                        $getAmount = new Transactions(['profile_id' => $sendTo, 'details' => $receiverNote, 'amount' => $amount, 'from_to' => $profileId,'cd_status' => '1']);

                        if ($sendAmount->save())
                        {
                            $getAmount->save();
                            $request->session()
                                ->forget(['token', 'id', 'readyForPayment']);

                            return view('admin.pay-details.payment-success', ['from' => Profile::where('id', auth()
                                ->user()
                                ->profile_id)
                                ->get() , 'to' => Profile::where('id', $sendTo)->get() , 'amount' => $amount]);
                        }
                        else
                        {
                            return redirect('/admin/qr-scan/validate')->with('error-msg', 'Error occured');

                        }
                    }
                    else
                    {
                        return redirect('/admin/qr-scan/validate')
                            ->with('error-msg', 'Insufficient Balance');
                    }
                }
                else
                {
                    return redirect('/admin/qr-scan/validate')
                        ->with('error-msg', 'Unauthorized access');

                }
            }
            else
            {
                return redirect('/admin/qr-scan/validate')
                    ->with('message', 'Incorrect Pin');

            }
        }
        else
        {
            return redirect('/admin/qr-scan/validate')
                ->with('error-msg', 'Unauthorized access');

        }
    }
}

