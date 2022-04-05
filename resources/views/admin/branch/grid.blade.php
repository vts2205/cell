@extends('layouts.parent')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="mb-5">
                        @if (session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                        @endif
                      <div class="float-right pb-3">
                            <a href="/admin/branch/create" class="btn btn-gradient-info pull-right">Create Branch</a>
                      </div>
                        <h4 class="card-title">Branches</h4>
                    </div>
                             <div class="table-responsive py-4">
	                  {{ $branches->appends(request()->query())->links('layouts.pagination') }}

                    <table class="table">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($branches as $key => $value)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$value->name}}</td>
                          <td >{{$value->address}}</td>
                          <td>
                            <div class="d-flex"><a href="/admin/{{Crypt::encrypt($value->id)}}/branch" class="btn btn-gradient-info mr-4">Edit</a>
                          <form action="/admin/{{Crypt::encrypt($value->id)}}/branch" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-gradient-danger">Delete</button>
                          </form>
                          </div>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>


      @endsection
    