@extends('layouts.parent')
@section('content')
{{-- @dd($branch) --}}
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @if(!empty($branch))
        <h4 class="card-title pb-5">Update Branch</h4>
        <form method="post" action="/admin/{{Crypt::encrypt($branch->id)}}/branch">
          @method('put')
        @else
        <h4 class="card-title pb-5">Create Branch</h4>
        <form method="post" action="/admin/branch">
         @endif 
          @csrf
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ empty($branch->name) ? '':$branch->name }}">
            @error('name')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" rows="10" cols="20" class="form-control @error('address') is-invalid @enderror">{{ empty($branch->address) ? '' : $branch->address }}</textarea>
            @error('address')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          
          <button type="submit" class="btn btn-gradient-info mr-2">{{!empty($branch)?'Update' : 'Save' }}</button>
          <a href="/admin/branch" class="btn btn-light">Back</a>
        </form>
      </div>
    </div>
  </div>
@endsection
