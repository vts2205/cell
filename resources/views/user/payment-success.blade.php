@extends('layouts.parent')
@section('content')  
{{-- @dd($from) --}}
    <style>
     
      
      .card {
        background: white;
      }
      .transaction-details{
        display: none;
      }
     
    </style>
    <div class="col-sm-12 col-lg-4 bg-light p-3">
        <h1 class="text-center display-1"><i class="mdi mdi-check-circle text-success"></i></h1>
        <h1 class="text-center pt-3 text-success">₹{{$amount}}</h1> 
        <p class="text-center text-dark ">Paid to {{$to[0]->name}}</p>
      <div class="card-header text-dark">
       <i class="mdi mdi-check-circle text-success"></i> Paid
      <i class=" mdi mdi-chevron-down float-right show"></i>

      </div>
      <div class="card transaction-details p-3">
        <div>
        <div class="text-dark mb-2 pb-3">From <b class="ml-2">{{$from[0]->name}} ({{$from[0]->phone}})</b></div> 
        {{-- <div class="text-dark mb-2"><b class="ml-2">{{$from[0]->phone}}</b></div>  --}}

        </div>
        <div>
        <div class="text-dark mb-2">To <b class="ml-2">{{$to[0]->name}} ({{$to[0]->phone}})</b></div> 

        </div>
      </div>

    </div>

    
@endsection
@push('scripts')
<script>

  
$(document).ready(function(){
  $(".show").click(function(){
    $(".transaction-details").toggle();
  });
});
</script>
@endpush