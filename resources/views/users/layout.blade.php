<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Aladino.Lt</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('users/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/toastr/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    @yield('page_style')
    <!-- THEME STYLES-->
    <link href="{{asset('users/assets/css/main.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/css/login-register.css')}}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    @yield('row_style')
</head>
<body>
    <div class="row header">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('users/assets/img/home/logo.png') }}" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-md-8 search-aladino">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-search" type="button"><i class="fa fa-search fa-fw"></i> Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="menu-aladino pull-right">
                @if(!Auth()->check())
                <li class="before-login"><a href="#">Sell on Aladino</a></li>
                <li class="before-login"><a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a></li>
             
                @endif
                @if(Auth()->check())
                <li>
                    <a href="#">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        Favourites
                    </a>
                </li>
                <li>
                    <a href="{{url('personal_profile_update')}}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Shop Manager
                    </a>
                </li>
                <li>
                    <a href="#" class="you-c">
                        <div class="you-img">
                        <?php
                        $profile_picture = DB::table('users')->where('id',Auth()->user()->id)->first(); 
                        if($profile_picture->image){
                        ?>
                            <img src="{{asset('users/profile_image/'.$profile_picture->image)}}" class="img-fluid" alt="image">
                         <?php }else{ ?>   
                             <img src="{{asset('users/assets/img/home/profile_m.jpg') }}" class="img-fluid" alt="image">
                         <?php } ?>

                        </div>
                        {{Auth()->user()->name}} <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    </a>
                    <div class="you-popover dsy-n">
                        <a href="{{url('user_profile')}}">
                            <div class="row you-pop-p">
                                <div class="col-md-3">
                                    <div class="you-img-p">
                                     <?php
                                        if($profile_picture->image){
                                        ?>
                                            <img src="{{asset('users/profile_image/'.$profile_picture->image)}}" class="img-fluid" alt="image">
                                         <?php }else{ ?>   
                                             <img src="{{asset('users/assets/img/home/profile_m.jpg') }}" class="img-fluid" alt="image">
                                         <?php } ?>

                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="you-p-con">
                                        <div class="you-p-name">
                                            {{Auth()->user()->name}}
                                        </div>
                                        <div class="you-p-btn">
                                            View Profile
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="row you-pop-e-itm">
                            <div class="col-md-12">
                                <ul>
                                    <li><a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i> Notifications</a></li>
                                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Conversations</a></li>
                                    <li><a href="#">Purchases and reviews</a></li>
                                    <li><a href="#">Account settings</a></li>
                                    <li><a href="#">Your Teams</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row you-pop-e-logout">
                            <div class="col-md-12">
                                <ul>
                                    <li><a href="{{url('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a></li>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
                <li id="shopping_card_ref">
                <span class="shopping_count" style="margin-left: 23px;">{{Cart::content()->count()}}</span> 
                    <a href="{{url('cart')}}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Cart
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @yield('content')


    <!-- login/register modal -->

<div class="container">
         <div class="modal fade login" id="loginModal">
              <div class="modal-dialog login animated">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login with</h4>
                    </div>
                    <div class="modal-body"> 
                    <div class="login_loading" style="position:fixed;top:23%;left:20%;z-index: 9999; display: none">
                       <img src="{{asset('users/loading.gif')}}"> 
                    </div> 
                        <div class="box">
                             <div class="content">
                                <div class="social">
                                    <a class="circle github" href="/auth/github">
                                        <i class="fa fa-github fa-fw"></i>
                                    </a>
                                    <a id="google_login" class="circle google" href="/auth/google_oauth2">
                                        <i class="fa fa-google-plus fa-fw"></i>
                                    </a>
                                    <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                                        <i class="fa fa-facebook fa-fw"></i>
                                    </a>
                                </div>
                                <div class="division">
                                    <div class="line l"></div>
                                      <span>or</span>
                                    <div class="line r"></div>
                                </div>
                                <div class="error" id="login-validation-errors"></div>
                                <div class="form loginBox">
                                    <form method="post" id="login-section" accept-charset="UTF-8">
                                    <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                    <input class="btn btn-default btn-login" type="submit" value="Login">
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">

                            <div class="content registerBox" style="display:none;">
                            <div class="error" id="register-validation-errors"></div>
                             <div class="form">
                                <form method="post" id="register-section" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                                 <input id="text" class="form-control" type="text" placeholder="Name" name="name">
                                <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                                <input class="btn btn-default btn-register" type="submit" value="Create account" name="commit">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>Already have an account?</span>
                             <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>        
                  </div>
              </div>
          </div>
</div>
    <!-- end login register modal -->








    <div class="row footer" style="margin-top: 80px;">
        <div class="col-md-12 footer-first">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h5>Shop</h5>
                        <ul>
                            <li><a href="#">Gift cards</a></li>
                            <li><a href="#">Aladino blog</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5>Sell</h5>
                        <ul>
                            <li><a href="#">Seller handbook</a></li>
                            <li><a href="#">Teams</a></li>
                            <li><a href="#">Forums</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5>About</h5>
                        <ul>
                            <li><a href="#">Aladino, Inc.</a></li>
                            <li><a href="#">Policies</a></li>
                            <li><a href="#">Investors</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Press</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5>Follow Aladino</h5>
                        <ul class="social">
                            <li><a href="#"><i id="ico" class="fa fa-facebook-official" aria-hidden="true"></i> <span id="text">Facebook</span></a></li>
                            <li><a href="#"><i id="ico" class="fa fa-instagram" aria-hidden="true"></i> <span id="text">Instagram</span></a></li>
                            <li><a href="#"><i id="ico" class="fa fa-pinterest" aria-hidden="true"></i> <span id="text">Pinterest</span></a></li>
                            <li><a href="#"><i id="ico" class="fa fa-twitter" aria-hidden="true"></i> <span id="text">Twitter</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 footer-mid">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 aladino-help">
                        <i id="ico" class="fa fa-question-circle-o" aria-hidden="true"></i>
                        <span id="text">Need help? Visit the <a href="#">help center</a></span>
                    </div>
                    <div class="col-md-6 aladino-con">
                        <ul class="pull-right">
                            <li>
                                <img src="{{asset('us.png')}}" class="img-circle" alt="image">
                                United States
                            </li>
                            <li>English (UK)</li>
                            <li>£ (GBP)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 footer-last">
            <div class="row">
                <div class="col-md-6 aladino-mini-logo">
                    <div class="aladino-l">
                        <img src="{{asset('users/assets/img/home/logo.png') }}" class="img-fluid">
                    </div>
                    <span>We make it easy to find your thing.</span>
                </div>
                <div class="col-md-6 aladino-copy-r">
                    <ul class="pull-right">
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Interest-based ads</a></li>
                    </ul>
                    <div class="pull-right">&copy; 2018 Aladino, Inc.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- END QUICK SIDEBAR-->
    <!-- CORE PLUGINS-->
    <script src="{{asset('users/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/metisMenu/dist/metisMenu.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/jquery-idletimer/dist/idle-timer.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <!-- PAGE LEVEL PLUGINS-->
    @yield('page_level')
    <!-- CORE SCRIPTS-->
    <script src="{{asset('users/assets/js/app.min.js')}}"></script>
    <script src="{{asset('users/assets/js/login-register.js')}}"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    @yield('core_script')

    <script type="text/javascript">
        $(function() {
            $('.you-c').on('click', function(e) {
              $('.you-popover').toggleClass("dsy-n"); 
              e.preventDefault();
          });
        });
    </script>
            <script type="text/javascript">
          $(document).ready(function(){
                $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

          });


    $(document).ready(function(){
       $('#login-section').on('submit',function(){
        $('.login_loading').css('display','block');
        var pathname = window.location.pathname;
        $.ajax({
            type:'POST',
            url:'{{url("login")}}',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success:function(response){
               if(pathname=='/cart'){
                window.location = '{{url("checkout")}}';
               }else{
                window.location = '{{route("aladino_home")}}';
               }
               $('.login_loading').css('display','none'); 

                
            },
            error: function (xhr) {
               $('.login_loading').css('display','none'); 
               $('#login-validation-errors').html('');
               $.each(xhr.responseJSON.errors, function(key,value) {
                 $('#login-validation-errors').append('<div class="alert alert-danger">'+value+'</div');
               }); 

               setTimeout(function(){ 
                    $('#login-validation-errors').hide('slow');
               }, 5000);
            },
        });

        return false;

       });
    });
    
          });

           $(document).ready(function(){
       $('#register-section').on('submit',function(){
        $('.login_loading').css('display','block');
        var pathname = window.location.pathname;
        $.ajax({
            type:'POST',
            url:'{{url("register")}}',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success:function(response){
                if(pathname=='/cart'){
                    window.location = '{{route("inifital_buying_info")}}';
                   }else{
                    window.location = '{{route("aladino_home")}}';
                   }
                 $('.login_loading').css('display','none');
            },
            error: function (xhr) {
               $('#register-validation-errors').html('');
               $.each(xhr.responseJSON.errors, function(key,value) {
                 $('#register-validation-errors').append('<div class="alert alert-danger">'+value+'</div');
               }); 
              $('.login_loading').css('display','none');

               setTimeout(function(){ 
                    $('#register-validation-errors').hide('slow');
               }, 5000);
            },
        });

        return false;

       });
    });
        </script>
</body>
</html>