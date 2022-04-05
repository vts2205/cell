@extends('layouts.parent')
@section('content')
<style type="text/css">
   
   .amount{
      font-size: 3.8125rem;
      height:4.875rem ;
   }
   .mt-4{
      font-size: 25px;
   }
   input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
.form-control{
   color: #fff;
}
</style>
<div class="col-lg-4 ">
   <div class="">
      <div class="card-body">
         <div class="text-center ">
            <img src="{{asset('images/user-avatar.jpg')}}" alt="profile" class="img-lg rounded-circle mb-3">
            <p>{{ $to[0]->name}}</p>
         </div>
         <div class="py-4">
            @if (session('message'))
            <div class="alert alert-success">
               {{ session('message') }}
            </div>
            @endif

            @if (session('error-msg'))
            <div class="alert alert-danger">
               {{ session('message') }}
            </div>
            @endif
            <form method="post" action="/user/pay">
               @csrf
               <div class="form-group">
                  @foreach($from as $val)
                  @php $totalAmount=0 @endphp
                  @foreach($val->transactions as $t)
                  @php $totalAmount+=$t->amount@endphp
                  @endforeach
                  @endforeach
                     
                  <input type="number" class="form-control border-0 amount text-center @error('amount') is-invalid @enderror" name="amount"  min="1" max="{{$totalAmount}}" value="0">
                  @error('amount')
                  <span class="invalid-feedback" role="alert">
                     @php $message='Insufficient Balance'; @endphp
                  <strong>{{ $message }}</strong>
                  </span>           
                  @enderror
               </div>
               <div class="form-group">
                  <input  type="text" class="form-control rounded-pill" name="note" placeholder="Add a note" >
               </div>
               <div class="form-group">
                  <input id="password" type="password" class="form-control @error('password')  is-invalid @enderror rounded-pill" name="password" required placeholder="Password" autocomplete="new-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <input type="hidden" name="token" value="{{Crypt::encrypt($to[0]->id)}}">
               <div class="text-center"><button type="submit" class="btn btn-gradient-info rounded-pill ">Pay</button>
               <a href="/user/dashboard" class="btn btn-light rounded-pill">Back</a></div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/sweet-alert.js')}}"></script>
<script type="text/javascript">
   $(document).on('change','.amount',function(){
      var val=parseInt($(this).val());
      var maxval = parseInt($(this).attr("max"));
      // alert(maxval)
      if(val > maxval){
         swal('Oops','Amount should be less than or equal to '+maxval,'error');
         $(this).val('0')
      }
   });
</script>
@endpush