<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- Styles -->
      <link rel="stylesheet" href="{{asset('css/materialdesignicons.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/vendor.bundle.base.css')}}">
      <!-- endinject -->
      <!-- Plugin css for this page -->
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <!-- endinject -->
      <!-- Layout styles -->
      <style type="text/css">
         .form-control:focus{
            color: #000000!important;
         }
      </style>
      <link rel="stylesheet" href="{{asset('css/style.css')}}">
   </head>
   <body>
      <div id="app">
         <main>
            <div class="container-scroller">
               <div class=" page-body-wrapper full-page-wrapper">
                  <div class="content-wrapper d-flex align-items-center auth">
                     <div class="row flex-grow">
                        <div class="col-lg-4 mx-auto">
                           <div class="auth-form-light text-left p-5">
                              <div class="brand-logo">
                                 @yield('content')
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>
      </div>
   </body>
</html>