@extends('layouts.app')
@section('content')
<h4 class="text-dark">Login</h4>
</div>
<h6 class="font-weight-light pb-3 text-dark">Sign in to continue.</h6>
@if (session('status'))
<div class="alert alert-danger">
   {{ session('status') }}
</div>
@endif
<form class="pt-3" method="POST" action="{{ route('login') }}">
   @csrf
   <div class="form-group">
      <input id="email log" type="text" class="form-control form-control-lg @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username">
      @error('email')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="form-group">
      <input id="password log" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
      @error('password')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="mt-3">
      <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >
      {{ __('Login') }}
      </button>
   </div>
   <div class="my-2 d-flex justify-content-between align-items-center">
      {{-- <div class="form-check">
         <label class="form-check-label" for="remember">
         <input class="form-check-input " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>Keep me signed in <i class="input-helper"></i></label>
      </div> --}}
      @if (Route::has('password.request'))
      <a class="btn btn-link " href="{{ route('password.request') }}">
      {{ __('Forgot Your Password?') }}
      </a>
      @endif
   </div>
     
</form>
@endsection