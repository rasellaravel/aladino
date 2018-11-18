<header class="header">
            <div class="page-brand">
                <a href="index.html">
                    <span class="brand"><a href="{{url('/')}}"> Aladino.Lt</a></span>
                    
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link search-toggler js-search-toggler"><i class="ti-search"></i>
                            <span>Search here...</span>
                        </a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
               
                   
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <span></span>
                            <?php
                                $profile_picture = DB::table('users')->where('id',Auth()->user()->id)->first(); 
                                if($profile_picture->image){
                                ?>
                                    <img src="{{asset('users/profile_image/'.$profile_picture->image)}}" class="img-fluid" alt="image">
                                 <?php }else{ ?>   
                                     <img src="{{asset('users/assets/img/home/profile_m.jpg') }}" class="img-fluid" alt="image">
                                 <?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                            <div class="dropdown-arrow"></div>
                            <div class="dropdown-header">
                                <div class="admin-avatar">
                                   <?php
                                        $profile_picture = DB::table('users')->where('id',Auth()->user()->id)->first(); 
                                        if($profile_picture->image){
                                        ?>
                                            <img src="{{asset('users/profile_image/'.$profile_picture->image)}}" class="img-fluid" alt="image">
                                         <?php }else{ ?>   
                                             <img src="{{asset('users/assets/img/home/profile_m.jpg') }}" class="img-fluid" alt="image">
                                         <?php } ?>
                                </div>
                                <div>
                                    <h5 class="font-strong text-white">{{Auth()->user()->name}}</h5>
                                    <div>
                                        <span class="admin-badge mr-3"><i class="ti-alarm-clock mr-2"></i>30m.</span>
                                        <span class="admin-badge"><i class="ti-lock mr-2"></i>Safe Mode</span>
                                    </div>
                                </div>
                            </div>
                            <div class="admin-menu-features">
                                <a class="admin-features-item" href="javascript:;"><i class="ti-user"></i>
                                    <span>PROFILE</span>
                                </a>
                                <a class="admin-features-item" href="javascript:;"><i class="ti-support"></i>
                                    <span>SUPPORT</span>
                                </a>
                                <a class="admin-features-item" href="javascript:;"><i class="ti-settings"></i>
                                    <span>SETTINGS</span>
                                </a>
                            </div>
                            <div class="admin-menu-content">
                                
                                <div class="d-flex justify-content-between mt-2">
                                    
                                    <a class="d-flex align-items-center" href="{{url('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout<i class="ti-shift-right ml-2 font-20"></i></a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                     </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link quick-sidebar-toggler">
                            <span class="ti-align-right"></span>
                        </a>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>