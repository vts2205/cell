function userAction(action,method,id){
 $.ajax({
   url: '/admin/user/action',
   type: 'put',
   headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
   data: {id:id,action:action},
   success:function(response){
    var msg=''
    msg+='<div class="alert alert-success mt-5">'+response.msg+'</div>'
    $('.msg').after(msg)
    setTimeout(function(){
    window.location.href='/admin/users'
    }, 1000 );
   }
 })
 
}
