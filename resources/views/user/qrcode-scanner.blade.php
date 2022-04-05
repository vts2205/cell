@extends('layouts.parent')
@section('content')
<div class="row">
    <div class="container">
        <div class="col-sm-12">
            <video id="preview" class="p-1 border" style="width:100%;"></video>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/sweet-alert.js')}}"></script>

    <script type="text/javascript">
        function pay(content){
           $.ajax({
               url: '/user/qr-scan/verify',
               type: 'post',
               data: {qr: content},
               headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                success:function(response){
                    if(response.status=='1'){

                    window.location.href=response.data.url
                    }else if(response.status=='2'){
                        swal('Oops',response.msg,'error')
                    }else if(response.status=='0'){
                        swal('Oops',response.msg,'error')

                    } 
                }
           })
        }
        
        // c="eyJpdiI6IlF5dHU5empnMy9TVW5WdlhGZno5VVE9PSIsInZhbHVlIjoiYzJEa3lKT3ZyWXNnZ2V0bTFLTEtpdz09IiwibWFjIjoiNjQ1MTJlYjE5NTIwYWY1NmRlNzZjZTQ3Yjg2Njk0YzZiOWU3MWY5MTcwNWRlYzlmMDA5MTcyMmUwODY3NWI1YSIsInRhZyI6IiJ9-eyJpdiI6Im9YY3BsMnU4M0dyUU9zeVkweUhDMUE9PSIsInZhbHVlIjoidWxkL3NQeWJwTGdYc1YvOWF1ZWMrT0gzd2U3c3hkYUkrMm4xaDZVN29JST0iLCJtYWMiOiI3MDVmMTAyMGI1MjliMzIzZWFmMmI5YzUxYjM5NGFmZTNmNTEyMjQyZTY3NzlkOTU0YWVjZTljZDkxMTlhYjg5IiwidGFnIjoiIn0=";
            // pay(c);
        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
        scanner.addListener('scan',function(content){
            pay(content);
            //window.location.href=content;
        });
        Instascan.Camera.getCameras().then(function (cameras){
            if(cameras.length>0){
                        if(cameras[1]){
                            scanner.start(cameras[1]);//backcamera
                        }else{
                            swal('','No backcamera found!','warning');
                        }
                    
            }else{
                // console.error('No cameras found.');
                            swal('','No  camera found!','warning');
                // alert('No cameras found.');
            }
        }).catch(function(e){
            console.error(e);
            // alert(e);
        });
    </script>
@endpush
