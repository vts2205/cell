@extends('layouts.parent')
@section('content')
<div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                  <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal ">Wallet Amount</h4>
                    <h2 >
                    @php $walletAmount='0'; @endphp
                    @foreach($userDetails[0]->transactions as $value)
                    @php $walletAmount+=$value->amount; @endphp
                    @endforeach 
                    {{$walletAmount}} 
                  </h2>
                  <i class="fa-4x mdi mdi mdi mdi-wallet-giftcard float-right"></i>
                  </div>
                </div>
              </div>
			<div class="col-md-3 stretch-card grid-margin">
              <a  href="/admin/pay" class="text-decoration-none w-100">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                  <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal">Pay now
                    </h4>
                   
                   <i class="mt-5 fa-4x fas fa-coins float-right"></i>
                  </div>
                </div>
              </a>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
              <a href="javascript.void(0)" data-toggle="modal" data-target="#transactions" class="text-decoration-none w-100">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                  <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Transactions<i class="mt-5 fa-4x fa fa-history float-right"></i>
                    </h4>
                    <h2 class="mb-5">
<!--                       {{count($userDetails[0]->transactions)}} -->
                    </h2>
<!--                     <button class="btn btn-light" >View Transactions</button> -->
                  </div>
                </div>
              </a>
              </div>
              

              <div class="col-md-3 stretch-card grid-margin">
                    <a href="/admin/{{Crypt::encrypt(auth()->user()->profile_id)}}/profile" class="text-decoration-none w-100">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Edit Profile Details<i class="mt-5 fa fa-user fa-4x float-right"></i>
                    </h4>
                    <h2 class="mb-5"></h2>
                  </div>
                </div>
              </a>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                    <a href="/admin/qrcode" class="text-decoration-none w-100">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                  <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                  <h4 class="font-weight-normal mb-3">QrCode<i class="mt-5 mdi mdi mdi-qrcode-scan fa-4x float-right" ></i>
                    </h4>
                    <h2 class="mb-5"></h2>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                  <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal ">Total Wallet</h4>
                    <h2 >
                    @php $walletAmount='0'; @endphp
                    @foreach($userDetails[0]->transactions as $value)
                    @php 
                    		if($value->from_to!=""){
                            	$walletAmount+=$value->amount;
                            }
					@endphp
                    @endforeach 
                    {{$walletAmount}} 
                  </h2>
                  <i class="fa-4x mdi mdi mdi mdi-wallet-giftcard float-right"></i>
                  </div>
                </div>
              </div>
                  <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                  <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal ">Wallet Today</h4>
                    <h2 >
                    @php $walletAmount='0'; $date=\Carbon\Carbon::now()->format('Y-m-d') @endphp
                    @foreach($userDetails[0]->transactions as $value)
                    @php 
                    		if($value->from_to!=""){
                                if(substr($value->created_at, 0, -9)==$date){
                            		$walletAmount+=$value->amount;
                                }
                            }
					@endphp
                    @endforeach 
                    {{$walletAmount}}
                  </h2>
                  <i class="fa-4x mdi mdi mdi mdi-wallet-giftcard float-right"></i>
                  </div>
                </div>
              </div>
                  
          

{{-- modal --}}
<div class="modal fade" id="transactions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transactions</h5>
        <button type="button" class="btn-close bg-light" data-dismiss="modal" aria-label="Close">
             
        </button>
      </div>
      <div class="modal-body table-responsive ">
        <table class="table table-bordered border-light datatable p-3">
                      <thead>
                        <tr>
                          <th>S No</th>
                          <th>Date</th>
                          <th>User</th>
                          <th>Details</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
						@php $i=1; @endphp
                        @foreach($userDetails[0]->transactions as $key => $value)
                        <tr>
                          <td >{{$i++}}</td>
                          <td >{{$value->created_at->format('d-m-Y')}}</td>

                          <td>
                            {{ empty($value->from_to) ? ' System Created ': $value->fromTo->name.'('.$value->fromTo->phone.')' }}
                          </td>
                          <td>
                            @if($value->cd_status=='1' && $value->from_to!='')
                            {{Str::remove("Qrcode amount received - ",$value->details)}}
                            @else
                            {{Str::remove("Qrcode amount send - ",$value->details)}}
                            @endif
                          </td>
                          <td >{{$value->amount}}</td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- scanner --}}

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" >
  Launch demo modal
</button> --}}

<!-- Modal -->

@endsection
