@extends('layouts.parent')
@section('content')
{{-- @dd($branch) --}}
<div class="col-12 grid-margin stretch-card">
   <div class="card ">
      <div class="card-body">
        @if (session('message'))
                          <div class="alert alert-success mt-5">
                              {{ session('message') }}
                          </div>
                        @endif
                        
         @if(!empty($userData))
         <h4 class="card-title pb-5">Update User</h4>
         <form method="post" action="{{url('/admin/'.Crypt::encrypt($userData->id))}}/users">
            @method('put')
            @else
            <h4 class="card-title pb-5">Create User</h4>
         <form method="post" action="/admin/users">
            @endif 
            @csrf
            <div class="form-group">
               <label for="phone">Phone</label>
               @if(!empty($userData->phone))
               <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" readonly required value="{{ old("phone",$userData->phone )}}">
               @else 

               <input type="text" class="regpn form-control @error('phone') is-invalid @enderror" name="phone" required onchange="mobileCheck(this.value)">
               @endif
               @error('phone')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
               <span  class="invalid-feedback mobile-check d-block h4"></span>
            </div>
            <div class="form-group">
               <label for="name">Name</label>
               <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old("name",empty($userData->name) ? '':$userData->name) }}">
               @error('name')
               <div class="text-danger">{{ $message }}</div>
               @enderror
            </div>
            <div class="form-group">
               <label for="place">Place</label>
               @if(!empty($userData->address))
               <input type="text" class="form-control @error('place') is-invalid @enderror" name="place" required value="{{ old("place",$userData->address )}}">
               @else 

               <input type="text" class="regpl form-control @error('place') is-invalid @enderror" name="place" required >
               @endif
               @error('place')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
               <label for="branch">Branch</label>
               <select class="form-control @error('branch') is-invalid @enderror" name="branch">
                  <option value="">Select Branch</option>
                  @foreach($branch as $value)
                  @if(empty($userData))
                  <option value="{{Crypt::encrypt($value->id)}}" 
                              @if (!empty(old('branch'))) 
                              @if (old('branch') == $value->name) selected="selected" @endif
                              @endif 
                              >
                              {{$value->name}}
                           </option>
                  @else
                  <option value="{{Crypt::encrypt($value->id)}}" 
                              @if (!empty(old('branch')) && isset($userData)) 
                              @if (old('branch') == $value->name) selected="selected" @endif
                              @else
                              {{$userData->branch_id==$value->id ? 'selected' : ""}}
                              @endif
                              >{{$value->name}}</option>
                  @endif
                  @endforeach
               </select>
               @error('branch')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
            
             @if(!empty($userData))
               <label  for="password">Pin</label>
               <input  type="password" class="form-control"  name="password" required  value="{{ $userData->user->password }}">
            <input type="hidden" name="old-password" value="{{ empty($userData->user->password) ? '':$userData->user->password }}">
            @else
               <input  type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" required  value="{{ rand(1000,9999) }}">
               @error('password')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            @endif
            </div>
            <button type="submit" class="btn btn-gradient-info mr-2">{{!empty($userData)?'Update' : 'Save' }}</button>
            <a href="/admin/users" class="btn btn-light">Back</a>
         </form>
      </div>
   </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    // $(document).ready(function(){
         function mobileCheck(val) {
      // var pn=$(this).attr('phone');
          $.ajax({
              type: 'POST',
              url: window.location.origin+'/admin/register',
              data: {"_token": "{{ csrf_token() }}",'phone':val},
              success:function(data){
               // console.log(data.status);
               if(data.status=="true"){

                  $(".mobile-check").html("<h6 style='font-size:0.875rem'>User Already Exists</h6>");
               }else{
                  $(".mobile-check").html("<h6 style='font-size:0.875rem'>New User</h6>");
                  // $(".mobile-check").empty();
               }
              }
          });
         }
      // });
      
</script>
@endsection
