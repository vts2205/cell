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
               url: '/admin/qr-scan/verify',
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
        
        // c="eyJpdiI6IkYzT1VTS0tYWS9TeEJ3YU91OUpRL0E9PSIsInZhbHVlIjoiLzFiRGk2QlJXSmNkYUpNU1RoS01QQT09IiwibWFjIjoiYWU3MTk1NWZiY2U0OTRiZmJkNjhjZDc5ZDk3M2Q0ZWMzNTQ3MDlhYzc5YmI3OTVjMzQ1NDQ1N2EwN2Y4N2Q5MyIsInRhZyI6IiJ9-eyJpdiI6IklyRjJCK2xOU3pjbkhsM1d2ZG5oSkE9PSIsInZhbHVlIjoicjhSSUtLb0xROVZBVnhkUFRCZ0Z3cXMvSFdpc3hEMk1KNFJBN3Rsbnd0TT0iLCJtYWMiOiI2YzA5MTA3ODgyZjg5MDIxNWNiNDA4NDczMGMzOWJmNmNiMjJlYzlhYjk0YmJlNDk1NDk2YjYwMzM1MzdhYjNhIiwidGFnIjoiIn0=";
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
