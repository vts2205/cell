<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Profile;
use Illuminate\Support\Facades\Crypt;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        //
        $allBranches=Branch::paginate(8);
        return view('admin.branch.grid',['branches' => $allBranches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate
         ([
          'name' => 'required',
          'address' => 'required',
         ]);
         $branch=new Branch
         ([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
         ]);
        if($branch->save()){
            return redirect('admin/branch')->with('status', 'Branch Created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $id=Crypt::decrypt($id);
        $branch=Branch::findorfail($id);
        // dd($branch);
        return view('admin.branch.create',['branch' => $branch]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $id=Crypt::decrypt($id);
        if(Branch::find($id)->update(['name' => $request->get('name'),'address' => $request->get('address')])){
            return redirect('admin/branch')->with('status','Branch Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    	$count=Profile::where('branch_id',Crypt::decrypt($id))->count();
    	if($count>0){
            return redirect('/admin/branch')->with('status','Branch could not be Deleted. '.$count.' Profile(s) assocaited');
        }else{
        	if(Branch::find(Crypt::decrypt($id))->delete()){
            	return redirect('/admin/branch')->with('status','Branch Deleted');
        	}
        }
    }
}
