@extends('layouts.parent')
@section('content')
{{-- @dd($branch) --}}

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @if (session('message'))
                          <div class="alert alert-success mt-5">
                              {{ session('message') }}
                          </div>
                        @endif
        <h4 class="card-title pb-5">Reports</h4>
        <form method="post" action="{{url('/admin/reports/export')}}">
                  @csrf
                  <div class="form-group">
                    <label class="form-control-label">From</label>
                <input type="text" name="from" required="required" class="form-control @error('from') is-invalid @enderror " value="{{ old("from",empty($userData->from) ? '':$userData->from )}}" id="startdate">   
                    @error('from')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror               
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">To</label>
                    <input type="text" name="to" required="required" class="form-control @error('to') is-invalid @enderror " value="{{ old("to",empty($userData->to) ? '':$userData->to )}}" id="enddate">
                    @error('to')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
                  </div>
                  <input type="submit" value="View" name="file" class="btn btn-info request-plan" />
                  <input type="submit" value="Download" name="file" class="btn btn-info request-plan" />
  </form>
      </div>
    </div>
  </div>
@if(isset( $heading ) && isset( $data ))
                          
 <div class="col-12 my-2 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered border-light">
          <tr>
              @foreach($heading as $value)
              	<th>{{$value}}</th>
              @endforeach
          </tr>
              @foreach($data as $value)
                <tr>
              @foreach($value as $valu)
                    <td>{{$valu}}</td>
              @endforeach
                </tr>
              @endforeach
        </table>
        </div>
      </div>
    </div>
  </div>
                          
 @endif
	
@endsection
@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript">
  $(document).ready(function(){
  
    $("#startdate").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#enddate').datepicker('setStartDate', minDate);
    });
    
    $("#enddate").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#startdate').datepicker('setEndDate', minDate);
        });

});
  </script>

  @endpush