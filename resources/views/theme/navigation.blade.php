 <!-- top navigation -->
 @php
 $user = auth()->user();
 @endphp
 <div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-left: 15px;">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              <img src="/images/img.jpg" alt="">{{ isset($user->fullname) ? $user->fullname : 'คุณยังไม่ได้ Login'}}
            </a>

            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                @if($user)
                <a class="dropdown-item"  href="{{route('user.userprofile')}}"><i class="fa fa-user pull-right"></i> Change Profile</a>
                <a class="dropdown-item"  href="{{route('user.userpwd')}}"> <i class="fa fa-key pull-right"></i> Change Password</a>
                <a class="dropdown-item"  href="{{route('admin.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                @else
                <a class="dropdown-item"  href="{{route('admin.login')}}"><i class="fa fa-sign-out pull-right"></i> Log in</a>
                @endif

            </div>
          </li>


        </ul>
      </nav>
    </div>
  </div>
<!-- /top navigation -->
