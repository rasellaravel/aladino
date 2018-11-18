  <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <ul class="side-menu metismenu">
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Dashboards</span></a>
                    </li>
                    <li class="heading">FEATURES</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-paint-roller"></i>
                            <span class="nav-label">Manage Profile</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('personal_profile_update')}}">Update Profile</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-paint-roller"></i>
                            <span class="nav-label">Manage Shop</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('user_create_shop')}}">create/update shop</a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php
                        $shop_avaiable =DB::table('shops')->where('user_id',Auth()->user()->id)->first();
                        if($shop_avaiable){
                    ?>
                     <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-paint-roller"></i>
                            <span class="nav-label">Manage Listing</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('product_listin')}}">Listing</a>
                            </li>
                            <li>
                                <a href="{{url('new_create_product')}}">Add Listing</a>
                            </li>
                            
                        </ul>
                    </li>
                <?php } ?>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-paint-roller"></i>
                            <span class="nav-label">Buying</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('user/buyed')}}">Buying Items</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-paint-roller"></i>
                            <span class="nav-label">Selling</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('user/product/selling')}}">Selling Items</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-paint-roller"></i>
                            <span class="nav-label">Earning</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('user/earning')}}">Earning</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="sidebar-footer">
                    <a href="javascript:;"><i class="ti-announcement"></i></a>
                    <a href="calendar.html"><i class="ti-calendar"></i></a>
                    <a href="javascript:;"><i class="ti-comments"></i></a>
                    <a href="login.html"><i class="ti-power-off"></i></a>
                </div>
            </div>
        </nav>