@extends('layouts.parent')
@section('content')

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-4 border-right">
                     <div class="border-bottom text-center pb-4">
                        <img src="{{ url('/storage/images/'.$userDetails[0]->image)}}" alt="profile" class="img-lg rounded-circle mb-3">
                        <p>{{$userDetails[0]->name}}</p>
                     </div>
                     <div class="py-4">
                        <p class="clearfix">
                           <span class="float-left">User Id</span>
                           <span class="float-right text-muted">{{$userDetails[0]->user->email}} </span>
                        </p>
                        <p class="clearfix">
                           <span class="float-left"> Branch Name </span>
                           <span class="float-right text-muted">
							@if($userDetails[0]->branch!=null)
                           {{$userDetails[0]->branch->name}}
							@endif
                           </span>
                        </p>
                        <p class="clearfix">
                           <span class="float-left"> Status </span>
                           <span class="float-right badge rounded-pill
                           {{$userDetails[0]->user->status=='1' ? 'bg-success' : 'bg-danger'}} ">{{$userDetails[0]->user->status=='1' ? 'Active' : 'Not Active'}}</span>
                        </p>
                        <p class="clearfix">
                           <span class="float-left"> Phone </span>
                           <span class="float-right text-muted">{{$userDetails[0]->phone}} </span>
                        </p>
                        
                     </div>
                     
                  </div>
                  <div class="col-lg-8">
                     
                     <div class="row">

                        <div class="col-md-6 stretch-card grid-margin">
                           <div class="card bg-gradient-danger card-img-holder text-white">
                              <div class="card-body">
                                 <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                                 <h4 class="font-weight-normal mb-3">Wallet Amount<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                                 </h4>
                                 <h2 class="mb-5">
                                 @php $totalAmount='0'; @endphp
                                 @foreach($transactions as $value)
                                 @php $totalAmount+=$value->amount@endphp
                                 @endforeach
                                 {{$totalAmount}}
                                </h2>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 stretch-card grid-margin">
                           <div class="card bg-gradient-info card-img-holder text-white">
                              <div class="card-body">
                                 <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                                 <h4 class="font-weight-normal mb-3">Current Position<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                 </h4>
                                 <h2 class="mb-5">{{$userDetails[0]->current_position}} </h2>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 ">
                        <h4>Transactions:</h4>
                        <div class="table-responsive">
                            @php 
    $pageData=json_decode($transactions->toJson());
    $perpage=$pageData->per_page;
    $pgno=$pageData->current_page;
    $sno = (($perpage*$pgno)-($perpage-1));
    @endphp
                        <table class="table p-3 table-bordered mb-4" style="overflow-y: scroll;">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Details</th>
                          <th>Amount</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($transactions as $key => $value)
                        <tr>
                          <td>{{$sno++}}</td>
                          <td>{{$value->details}}</td>
                          <td >{{$value->amount}}</td>
                          <td >{{$value->created_at}}</td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                        {{ $transactions->appends(request()->query())->links('layouts.pagination') }}
                        </div>
                        
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection