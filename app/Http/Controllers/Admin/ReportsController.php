<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\Branch;
use Illuminate\Support\Facades\Response;
use \Carbon\Carbon;


class ReportsController extends Controller
{
    //
    public function index(){
        return view('admin.reports.create');
    }
    public function generateReports(Request $request){
         $request->validate([
            'from' => ['required'],
            'to' => ['required'],
        ]);
		
        $fromDate = Carbon::parse($request->get('from'))->format('Y-m-d');
        $toDate =  Carbon::parse($request->get('to'))->format('Y-m-d');
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=reports_".$fromDate . " to " . $toDate.".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array(
            "S.no",
            "Name",
        	"Phone Number",
        	"Details",
        	"Place",
        	"Branch",
            "Credited",
            "Debited",
            "Date",
        );
        $file = fopen('php://output', 'w');
        $transactions = Transactions::whereBetween('created_at', [$fromDate, $toDate])->get();
        $branch = Branch::all();
        $brch=[];
    	foreach($branch as $value){
        	$brch[$value->id]=$value->name;
        }
        // dd($brch);
        // exit;
    			if($request->file=="Download"){
    			$trans=[];
                $callback = function () use ($transactions, $columns,$brch, $trans)
                {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);
                    $transactionsData = [];
                    $sno = '1';
                    foreach ($transactions as $key => $value)
                    {
                    	$cr=$dr="";
                    	if($value->amount >0){
                        	$cr=$value->amount;
                        }else{
                        	$dr=$value->amount;
                        }
                    	$banc="";
                    	if(array_key_exists($value->profile->branch_id,$brch)){
                    	 	$banc=$brch[$value->profile->branch_id];
                    	// $banc="1";
                        }
                        $transactionsData = [$sno++, $value->profile->name,$value->profile->phone,$value->details,$value->profile->address,$banc,$cr,$dr,$value->created_at];
                        $trans= [$sno++, $value->profile->name,$value->profile->phone,$value->details,$value->profile->address,$banc,$cr,$dr,$value->created_at];
                            fputcsv($file, $transactionsData);
                    }
                    fclose($file);
                };
                return Response::stream($callback, 200, $headers);
                }else if($request->file=="View"){
                
                    $sno = '1';
    				foreach ($transactions as $key => $value)
                    {
                    	$cr=$dr="";
                    	if($value->amount >0){
                        	$cr=$value->amount;
                        }else{
                        	$dr=$value->amount;
                        }
                    	$banc="";
                    	if(array_key_exists($value->profile->branch_id,$brch)){
                    	 	$banc=$brch[$value->profile->branch_id];
                    	// $banc="1";
                        }
                        $trans[]= [$sno++, $value->profile->name,$value->profile->phone,$value->details,$value->profile->address,$banc,$cr,$dr,$value->created_at->format('Y-m-d H:i:s')];
                    }
    				return view('admin.reports.create', ['data'=>$trans,'heading'=>$columns]);
                }
    }
}
