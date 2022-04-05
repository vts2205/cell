</div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/datatable.js')}}"></script>
    <script src="{{asset('js/datatable.bootstrap.js')}}"></script>
      <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    @if(auth()->user()->is_admin)
    <script src="{{asset('js/admin-custom.js')}}"></script>
    @endif

    <!-- End custom js for this page -->
  </body>
</html>