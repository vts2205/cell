@extends('layouts.parent')
@section('content')
{{-- @dd(Crypt::encrypt($profile[0]->id)."-".Crypt::encrypt($profile[0]->phone)) --}}
<style type="text/css">
  /*.card-body{
    padding: 50px!important;
  }*/
  .card{
    background: #fff!important;
    height: 537px;
  }
  svg{
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
</style>
<div class="d-flex justify-content-center">
    <div class="card col-sm-4">
      <div class="card-body ">
        <h4 class="text-dark text-center pb-2">{{$profile[0]->name}}</h4>
        <h4 class="text-dark text-center  border-bottom border border-white">{{$profile[0]->phone}}</h4>
        <hr class="pb-5">
        <h4 class="text-dark text-center pb-3">Scan & Pay</h4>
        {!! QrCode::size(200)->generate(Crypt::encrypt($profile[0]->id)."-".Crypt::encrypt($profile[0]->phone)) !!}

      </div>
    </div>
</div>
@endsection
