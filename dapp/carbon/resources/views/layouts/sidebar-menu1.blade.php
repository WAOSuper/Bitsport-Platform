
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
    <?php
       $slug = Sentinel::getUser()->roles()->first()->slug;
     ?>
      <!-- BEGIN superadmin SIDEBAR MENU -->
    @if($slug=='superadmin')
       <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start active">
                <a href="javascript:;" class="nav-link ">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
           <li class="heading">
               <h3 class="uppercase">Requests</h3>
           </li>
           <li class="nav-item  ">
               <a href="{{ url('deposit-request') }}" class="nav-link ">
                   <i class="fa fa-exchange"></i>
                   <span class="title">Deposit</span>
               </a>
           </li>
           <li class="nav-item  ">
               <a href="{{ url('withdraw-request') }}" class="nav-link ">
                   <i class="fa fa-exchange"></i>
                   <span class="title">Withdraw</span>
               </a>
           </li>
           <li class="nav-item  ">
               <a href="{{ url('sub-admin') }}" class="nav-link ">
                   <i class="fa fa-user"></i>
                   <span class="title">Sub-Admin</span>
               </a>
           </li>
           <li class="nav-item  ">
               <a href="{{ url('bet-history') }}" class="nav-link ">
                   <i class="fa fa-history"></i>
                   <span class="title">Betting History</span>
               </a>
           </li>

        </ul>
    <!-- END superadmin SIDEBAR MENU -->
    <!-- BEGIN admin SIDEBAR MENU -->
    @elseif($slug=='admin')
       <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
           <li class="nav-item start active">
                <a href="javascript:;" class="nav-link ">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>

     <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>
             <li class="nav-item {{{ (Request::is('admin-user') ? 'active' : '') }}} ">
                <a href="{{url('admin-user')}}"  class="nav-link  ">
                    <i class="icon-user"></i>
                    <span class="title">Users</span>
                </a>
            </li> 
             <li class="nav-item {{{ (Request::is('admin-users-bets') ? 'active' : '') }}}">
                        <a href="{{url('admin-users-bets')}}" class="nav-link ">
                        <i class="icon-user"></i>
                        <span class="title">Users Bets</span>
                       </a>
            </li>
            <li class="nav-item {{{ (Request::is('admin-team') ? 'active' : '') }}}">
                          <a href="{{url('admin-team')}}" class="nav-link ">
                          <i class="icon-users"></i>
                          <span class="title">Team</span>
                           </a>
                    </li>
                     <li class="nav-item {{{ (Request::is('admin-event') ? 'active' : '') }}}">
                          <a href="{{url('admin-event')}}" class="nav-link ">
                          <i class="fa fa-calendar"></i>
                          <span class="title">Events</span>
                         </a>
            </li>
            <li class="nav-item {{{ (Request::is('admin-coins') ? 'active' : '') }}}">
                        <a href="{{route('admin-coins.index')}}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Get Bicoins</span>
                       </a>
            </li> 
            
            

              <li class="heading">
                <h3 class="uppercase">Event Setting</h3>
            </li>
            
              <li class="nav-item active open">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Master</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
            <li class="nav-item {{{ (Request::is('admin-category') ? 'active open' : '') }}}">
                       <a href="{{route('admin-category.index')}}" class="nav-link ">
                       <i class="icon-layers"></i>
                      <span class="title">Category</span>
                      </a>
                    </li> 
                    <li class="nav-item {{{ (Request::is('admin-subcategory') ? 'active open' : '') }}}">
                         <a href="{{route('admin-subcategory.index')}}" class="nav-link ">
                        <i class="icon-layers"></i>
                        <span class="title">Sub Category</span>
                       </a>
                     </li>  
                    <li class="nav-item {{{ (Request::is('admin-subsubcategory') ? 'active open' : '') }}}">
                          <a href="{{route('admin-subsubcategory.index')}}" class="nav-link ">
                         <i class="icon-layers"></i>
                         <span class="title">Sub Sub Category</span>
                          </a>
                     </li> 
                      <li class="nav-item  {{{ (Request::is('admin-eventmaster') ? 'active open' : '') }}}">
                      <a href="{{route('admin-eventmaster.index')}}" class="nav-link ">
                       <i class="icon-tag"></i>
                      <span class="title">Event-Master</span>
                      </a>
                   </li> 
                     <li class="nav-item {{{ (Request::is('admin-odd-master') ? 'active open' : '') }}} ">
                      <a href="{{route('admin-odd-master.index')}}" class="nav-link ">
                       <i class="icon-tag"></i>
                      <span class="title">Odd-Master</span>
                      </a>
                   </li> 
                 <!--   <li class="nav-item {{{ (Request::is('admin-odd') ? 'active open' : '') }}} ">
                      <a href="{{route('admin-odd.index')}}" class="nav-link ">
                       <i class="icon-tag"></i>
                      <span class="title">Odd</span>
                      </a>
                   </li> -->
                     
                 </ul>
             </li>

              <li class="heading">
                <h3 class="uppercase">Page Setting</h3>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Master</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                  
                <li class="nav-item  ">
                      <a href="{{route('admin-menu.index')}}" class="nav-link ">
                       <i class="icon-bar-chart"></i>
                      <span class="title">Menu</span>
                      </a>
                 </li>
                 <li class="nav-item  {{{ (Request::is('admin-cms') ? 'active open' : '') }}}">
                      <a href="{{route('admin-cms.index')}}" class="nav-link ">
                      <i class="icon-docs"></i>
                      <span class="title">CMS Pages</span>
                      </a>
                  </li>
                  <li class="nav-item {{{ (Request::is('admin-blog') ? 'active open' : '') }}} ">
                      <a href="{{route('admin-blog.index')}}" class="nav-link ">
                       <i class="icon-tag"></i>
                      <span class="title">Blogs</span>
                      </a>
                   </li>
                   
                   
                    
                    <!-- <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <span class="title">Page Progress Bar</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item ">
                                <a href="ui_page_progress_style_1.html" class="nav-link "> Flash </a>
                            </li>
                            <li class="nav-item ">
                                <a href="ui_page_progress_style_2.html" class="nav-link "> Big Counter </a>
                            </li>
                        </ul>
                    </li> -->

                   
                </ul>
            </li>
           
           
            
             
            
        </ul>
     <!-- END admin SIDEBAR MENU -->
    <!-- BEGIN user SIDEBAR MENU -->
    @else

        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- <li class="nav-item start {{{ (Request::is('dashboard') ? 'active' : '') }}}">
                <a href="{{ url('dashboard') }}" class="nav-link ">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li> -->
         
             <li class="heading">
                <h3 class="uppercase">My Account</h3>
            </li>
            <li class="nav-item start {{{ (Request::is('profile') ? 'active' : '') }}} ">
                <a href="{{url('profile')}}" class="nav-link ">
                    <i class="icon-user"></i>
                    <span class="title">My Profile</span>
                </a>
            </li>
            <li class="nav-item  {{{ (Request::is('security') ? 'active' : '') }}}">
                <a href="{{ url('security') }}" class="nav-link ">
                    <i class="icon-basket"></i>
                    <span class="title">Account Security</span>
                </a>
            </li>
           <!--  <li class="nav-item  ">
                <a href="" class="nav-link ">
                    <i class="icon-tag"></i>
                    <span class="title">Logout</span>
                </a>
            </li> -->
            <li class="heading">
                <h3 class="uppercase">Transactions</h3>
            </li>
                <li class="nav-item {{{ (Request::is('deposit') ? 'active' : '') }}} ">
                    <a href="{{ url('deposit') }}" class="nav-link ">
                        <i class="fa fa-exchange"></i>
                        <span class="title">Deposit</span>
                    </a>
                </li>
                <li class="nav-item  {{{ (Request::is('withdraw') ? 'active' : '') }}}">
                    <a href="{{ url('withdraw') }}" class="nav-link ">
                        <i class="fa fa-exchange"></i>
                        <span class="title">Withdraw</span>
                    </a>
                </li>
                <li class="nav-item {{{ (Request::is('get-coins') ? 'active' : '') }}} ">
                    <a href="{{url('get-coins')}}" class="nav-link ">
                        <i class="icon-tag"></i>
                        <span class="title">Get Bitcoins</span>
                    </a>
                </li>

           
        </ul>
    @endif
        <!-- END user SIDEBAR MENU --> 
     <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->