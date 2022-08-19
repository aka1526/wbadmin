@php
$user = auth()->user();
@endphp
 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>ระบบจัดการบทความ</h3>
      <ul class="nav side-menu" >

        <li><a><i class="fa fa-newspaper-o"></i> News/Awards <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li class="">
                    <a href="/news">News </a>
                </li>
                <li class="">
                    <a href="/awards">Awards </a>
                </li>
                <li class="">
                    <a href="/televisions">On Television</a>
                </li>

            </ul>
        </li>
        <li><a><i class="fa fa-group"></i>Customer<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li class="">
                    <a href="/customers"> Customer List</a>

                </li>
                <li class="">
                    <a href="/visitors">Customer Visits </a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="/activitys"><i class="fa fa-wechat"></i>Activitys </a>
        </li>

        <li class="">
            <a href="/csrs"><i class="fa fa-user-md"></i>CSR </a>
        </li>


        <li class="">
            <a href="/slides"><i class="fa fa-image"></i>Images Slideshow </a>
        </li>
        <li class="">
            <a href="/partners"><i class="fa fa-sitemap"></i>Partners</a>
        </li>


      </ul>
    </div>

  </div>

