@extends('layouts.app')
@section('content')
<h4 class="text-dark">Register</h4>
</div>
<form method="POST" action="{{ route('register') }}">
   @csrf
   <div class="form-group">
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Name" autocomplete="name" autofocus>
      @error('name')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="form-group">
      <input  type="text" class="form-control @error('address') is-invalid @enderror" name="address" required placeholder="Address">
      @error('password')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="form-group">
      <input  type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"  placeholder="Phone" required>
      @error('phone')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="form-group ">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autocomplete="email">
      @error('email')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="form-group">
      <select class="form-control @error('branch') is-invalid @enderror" name="branch">
        <option value="">Select Branch</option>
        @foreach($branch as $value)
        <option value="{{Crypt::encrypt($value->id)}}">{{$value->name}}</option>
        @endforeach
      </select>
        @error('branch')
        <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="form-group">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="new-password">
      @error('password')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="form-group">
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
   </div>
   <div class="col-mt-3">
      <button type="submit" class="btn btn-primary col-12">
      {{ __('Register') }}
      </button>
   </div>
<div class=" mt-4 font-weight-light text-dark"> Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
</div>
</form>
@endsection