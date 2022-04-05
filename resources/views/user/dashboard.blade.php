@extends('layouts.parent')
@section('content')
{{-- @dd($userDetails) --}}
<div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                   <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                   <h4 class="font-weight-normal mb-3">Wallet Amount
                    </h4>
                    <h2 class="mb-5">
                    @php $walletAmount='0'; @endphp
                    @foreach($userDetails[0]->transactions as $value)
                    @php $walletAmount+=$value->amount; @endphp
                    @endforeach 
                    {{$walletAmount}} 
                    </h2>
<i class="mdi mdi  mdi-wallet-giftcard fa-4x float-right"></i>
                  </div>
                </div>
              </div>
			<div class="col-md-3 stretch-card grid-margin">
             <a href="/user/pay" class="text-decoration-none w-100">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Pay now
                    </h4>
                    <h2 class="mb-5">
                    </h2>
                  <i class="fas fa-coins fa-4x float-right mt-5"></i>
                  </div>
                </div>
            </a>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
               <a  data-toggle="modal" data-target="#transactions" class="text-decoration-none w-100">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Total Transactions 
                    </h4>
                    <h2 class="mb-5">
                        {{count($userDetails[0]->transactions)}}
                    </h2>
                  <i class="fa fa-history fa-4x float-right"></i>
                  </div>
                </div>
              </a>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
               <a  class="text-decoration-none w-100">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                     <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                   <h4 class="font-weight-normal mb-3">Current Position
                    </h4>
                    <h2 class="mb-5">{{$userDetails[0]->current_position}}</h2>
                  <i class="mdi mdi mdi-sitemap fa-4x float-right"></i>
                  </div>
                </div>
              </a>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
               <a href="/user/{{Crypt::encrypt(auth()->user()->profile_id)}}/profile" class="text-decoration-none w-100">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Profile
                    </h4>
                    <h2 class="mb-5"></h2>
                   <i class="fa fa-user fa-4x float-right mt-5"></i>
                  </div>
                </div>
              </a>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
               <a href="/user/qrcode" class="text-decoration-none w-100">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">QrCode
                    </h4>
                    <h2 class="mb-5"></h2>
                   <i class="mdi mdi mdi-qrcode-scan fa-4x float-right mt-5"></i>
                  </div>
                </div>
              </a>
              </div>
            </div>


{{-- modal --}}
<div class="modal fade" id="transactions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transactions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body table-responsive ">
        <table class="table  p-3">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>User</th>
                          <th>Note</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($userDetails[0]->transactions as $key => $value)
                        <tr>
                          <td >{{$value->created_at->format('d-m-Y')}}</td>

                          <td>
                            {{ empty($value->from_to) ? config('app.name'): $value->fromTo->name.'('.$value->fromTo->phone.')' }}
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
