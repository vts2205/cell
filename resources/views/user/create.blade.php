@extends('layouts.parent')
@section('content')
 <div class="col-sm-6 offset-sm-3" >
  @if (session('message'))
                          <div class="alert alert-success">
                              {{ session('message') }}
                          </div>
        @endif
  </div>
{{-- @dd($userDetails[0]->branch_id) --}}
<div class="d-flex justify-content-center">
<div class="col-sm-6 grid-margin stretch-card ">
 
    <div class="card">
      <div class="card-body">

        <h4 class="card-title pb-5">Update Profile</h4>
        
        <form method="post" enctype="multipart/form-data" action="/user/{{Crypt::encrypt(auth()->user()->profile_id)}}/profile">
          @method('put')
          @csrf
          <div class="form-group">
         <img class="rounded-circle profile-img" src="{{ url('/storage/images/'.$userDetails[0]->image)}}" height="100px" width="100px" >
      <div id="mobiprofile" class="prof ">
         <label for="profile-pic" >
         <i  class="fas fa-camera p-1 text-dark" > </i>
         </label>
         <input id="profile-pic" type="file" onchange="previewFile()" class="d-none" name="img"/>
      </div>
      </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $userDetails[0]->name}}">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="address">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $userDetails[0]->phone}}">
            @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>           
             @enderror
          </div>
             <div class="form-group">
            <label for="address">Place</label>
            <input type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ $userDetails[0]->place}}">
            @error('place')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>           
             @enderror
          </div>
          <div class="form-group">
            <label for="address">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $userDetails[0]->user->email}}">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>            
            @enderror
          </div>
          <label for="address">Branch</label>
          <div class="form-group">
      <select class="form-control @error('branch') is-invalid @enderror" name="branch">
        <option value="">Select Branch</option>
        @foreach($branch as $value)
        <option value="{{$value->id}}" {{$userDetails[0]->branch_id==$value->id ? 'selected' : ""}}>{{$value->name}}</option>
        @endforeach
      </select>
        @error('branch')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
  <label for="address">Password</label>
   <div class="form-group">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="new-password" value="{{$userDetails[0]->user->password}}">
      @error('password')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
      <input type="hidden" name="old-password"  value="{{$userDetails[0]->user->password}}">
   </div>
          <button type="submit" class="btn btn-gradient-info mr-2">Update</button>
          <a href="/user/dashboard" class="btn btn-light">Back</a>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection

<script type="text/javascript">
      function previewFile() {
       var preview = document.querySelector('img.profile-img');
       var file    = document.querySelector('input[id=profile-pic]').files[0];
       var reader  = new FileReader();
      
       reader.onloadend = function () {
         preview.src = reader.result;
       }
      
       if (file) {
         reader.readAsDataURL(file);
       } 
       else {
         preview.src = "";
       }
      }
      
   </script>
