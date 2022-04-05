 <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{asset("/storage/images/".auth()->user()->profile()->get('image')[0]['image'])}}" alt="image">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{auth()->user()->name}}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            @if(auth()->user()->is_admin)
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin/users')}}">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin/branch')}}">
                <span class="menu-title">Branch</span>
                <i class="mdi mdi mdi-file-tree menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin/reports')}}">
                <span class="menu-title">Reports</span>
                <i class="mdi mdi mdi-file-excel menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin/payment')}}">
                <span class="menu-title">Pay</span>
                <i class="mdi mdi mdi-share menu-icon"></i>
              </a>
            </li>
            @else
            @endif
            
          </ul>
        </nav>