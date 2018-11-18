<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- <link rel="stylesheet" href="{{asset('front-end/css/bootstrap_menu.min.css')}}"> -->
        <link rel="stylesheet" href="{{asset('front-end/css/bootstrap.min.css')}}">
      
       
         <link rel="stylesheet" href="{{asset('front-end/font-awesome/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" href="{{asset('front-end/css/bootstrap-theme.min.css')}}">
        <link rel="stylesheet" href="{{asset('front-end/css/main.css')}}">
       
        <link rel="stylesheet" href="{{asset('front-end/css/webslidemenu.css')}}">
        <link rel="stylesheet" href="{{asset('front-end/css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('front-end/css/aladino.css')}}">
        
        <script src="{{asset('front-end/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic|Noto+Sans" rel="stylesheet">

        @yield('style')

        
        
        
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="nav_main">
      <div class="container-fluid">
       <div class="row">
          
      <div class="navbar-header col-md-6">
         
          <a class="navbar-brand" href="#">
              <img src="{{asset('logo.png')}}" alt="">
              
          </a>
          <form class="navbar-form navbar-right form_custom pull-left" role="form">
            <div class="form-group">
              <input type="text" placeholder="Search Your Product" class="form-control">
            </div>
           
            <button type="submit" class="btn btn-success">Search</button>
          </form>
          
          
        </div>
        
        <div id="navbar" class=" rihgt_nav  col-md-6 col-sm-12 col-xs-12">
    
        <ul class="pull-right">
           <li class=""><a href="{{url('/')}}" >Home</a></li>
            <li><a href="#">Sell to Aladino</a></li>
            @if(Auth::check())
            <li><a href="{{url('home')}}">Profile</a></li>
            @endif
            @if(!Auth::check())
            <li><a href="#" data-toggle="modal" data-target="#exampleModal">Rtegister</a></li>
            @endif
            @if(!Auth::check())
            <li class="sing_in"><a href="#" data-toggle="modal" data-target="#loginModal">Sign In</a></li>
            @endif
            

            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
        </ul>
        
       
        </div><!--/.navbar-collapse -->
       </div>
       
        
        
        
        
      </div>
    </nav>

<!-- modal for singin -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <h1>Sign in to Continue</h1>
        <br/>
        <div class="text-center">
            <img src="{{asset('preloading.gif')}}" id="login-preloading" style="display: none">
        </div>
         
        <div id="login-validation-errors"></div>

        <div class="reginster-item">
         <form action="" method="post" id="login">
           @csrf
           <div class="form-group distance">
            <label for="exampleInputEmail1">Email or username</label>
            <input type="email" name="email" class="form-control item-controll" id="exampleInputEmail1 email" aria-describedby="emailHelp" value="{{ old('email') }}" required autofocus placeholder="Enter email">
          </div>

           <div class="form-group distance">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" name="password" class="form-control item-controll" id="exampleInputEmail1 password" aria-describedby="emailHelp" placeholder="Enter Password" required="required">
          </div>

           <div class="custom-checkbox">
            <div class="form-check stay_sign">
                <input type="checkbox" name="remember" id="remember exampleCheck1" {{ old('remember') ? 'checked' : '' }} class="form-check-input stay_check">
                <label class="form-check-label stay_sing_in" for="exampleCheck1">Stay signed in</label>
            </div>
            <div class="forgot">
                <p><a href="{{ route('password.request') }}"> Forgot your password?</a></p>
            </div>
           </div>
           
          <button class="item-button distance" type="submit"><b style="color:white">Sign in</b></button>
          </form>

          <div class="social">
              <div class="hr-sect">OR</div>
          </div>
          <div class="gogole"> 
          <a href="{{ url('/auth/facebook') }}"> <button class="item-social"><i class="fab fa-google"></i>&nbsp;&nbsp; <b>Continue with Google</b></button></a>
          </div>
          <div class="facebook"> 
            <a href="{{ url('/auth/facebook') }}"><button class="item-social"><i class="fab fa-facebook"></i>&nbsp;&nbsp; <b>Continue with Facebook</b></button></a>
          </div>
          <div class="privacy">
          <p>By clicking Register, Continue with Google, or Continue with Facebook, you agree to ALadino's Terms of Use and Privacy Policy. Aladino may send you communications; you may change your preferences in your account settings. We'll never post without your permission.</p>
          </div>

      </div>
     </div>
    </div>
  </div>
</div>




<!-- End modal for singin -->

<!-- start login model -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <h2>Create your account</h2>
        <span>Registration in Aladino.</span>
        <br/>
         <div class="text-center">
            <img src="{{asset('preloading.gif')}}" id="preloading" style="display: none">
        </div>
         
        <div id="validation-errors"></div>

        <div class="reginster-item">
         <form action="" method="post" id="register">
            @csrf
            <div class="form-group distance">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control item-controll" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
          </div>
           <div class="form-group distance">
            <label for="exampleInputEmail1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="form-control item-controll" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
           <div class="form-group distance">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" name="password" required class="form-control item-controll" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Password">
          </div>
           <div class="form-group distance">
            <label for="exampleInputEmail1">Confirm Password</label>
            <input type="Confirm password" name="password_confirmation" required class="form-control item-controll" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Confirm Password">
          </div>

         
          <button class="item-button distance" type="submit"><b style="color:white">Register</b></button>
          </form>

          <div class="social">
              <div class="hr-sect">OR</div>
          </div>
          <div class="gogole"> 
          <a href="{{ url('/auth/facebook') }}"></a> <button class="item-social"><i class="fab fa-google"></i>&nbsp;&nbsp; <b>Continue with Google</b></button></a>
          </div>
           <a href="{{ url('/auth/facebook') }}"><div class="facebook"> 
           <button class="item-social"><i class="fab fa-facebook"></i>&nbsp;&nbsp; <b>Continue with Facebook</b></button></a>
          </div>
          <div class="privacy">
          <p>By clicking Register, Continue with Google, or Continue with Facebook, you agree to Aladino's Terms of Use and Privacy Policy. Aladino may send you communications; you may change your preferences in your account settings. We'll never post without your permission.</p>
          </div>

      </div>
     </div>
    </div>
  </div>
</div>

<!-- end login model -->








 @include('front-end.menu')
    
  @yield('content')
    
    
    <div class="footer_main">
        
        <div class="container">
      <!-- Example row of columns -->
      
      <div class="row">
          <div class="col-md-12 text-center">
              <div class="footer_contact_form">
                  <p>Get fresh Aladino trends and unique gift ideas delivered right to your inbox.</p>
                  
        <form class="navbar-form footer_subscribe" role="form">
            <div class="form-group">
              <input type="text" placeholder="Enter your Email" class="form-control">
            </div>
           
            <button type="submit" class="btn btn-success">Subscribe</button>
          </form>
              </div>
          </div>
      </div>
      
      <div class="row">
        
       
        
        <div class="col-md-3">
         
         <div class="footer_wid"> 
               <h2>Shop</h2> 
          <ul>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
              
          </ul>
         </div>
         
        
          
          
          
        </div>
         <div class="col-md-3">
         
          <div class="footer_wid"> 
               <h2>Sell</h2> 
          <ul>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
              
          </ul>
         </div>
          
        </div>
         <div class="col-md-3">
          <div class="footer_wid"> 
               <h2>About</h2> 
          <ul>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
              <li><a href="#">Lorem ipsum.</a></li>
          </ul>
         </div>
          
        </div>
         <div class="col-md-3">
          <div class="footer_wid"> 
               <h2>Follow Aladino </h2> 
          <ul>
              <li><a href="#"> <i class="fab fa-facebook-square"></i> facebook</a></li>
              <li><a href="#"><i class="fab fa-instagram"></i> instagram</a></li>
              <li><a href="#"><i class="fab fa-pinterest"></i> pinterest</a></li>
              <li><a href="#"><i class="fab fa-twitter"></i> twitter</a></li>
            
          </ul>
         </div>
          
        </div>
        
        
       
        
      </div>
      <div class="container">
         <div class="row">
           
            <div class="col-md-6">
                <div class="help">
                    <p><i class="far fa-question-circle"></i> Need help? Visit the  <a href="#">help center</a></p>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="country">          
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Bangladesh | English (US) | $(USD)</button>

                </div>
            </div>
        </div>
      </div>

      <hr>

      <footer>
       
        <div class="row">
            <div class="col-md-6">
                <div class="copy_left">
                   <img src="{{asset('logo.png')}}" alt="">
                    <p>Aladino We make it easy to find your thing.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="copy_right pull-right">
                    <ul>
                        <li><a href="#">&copy; 2018 Aladino. </a></li>
                        <li><a href="#">Terms of Use Privacy</a></li>
                        <li><a href="#">Interest-based ads </a></li>
                        
                    </ul>
              

     
                </div>
            </div>
        </div>
        
        
        
      </footer>
    </div> <!-- /container -->  
        
        
    </div>

    
    
       
       <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="{{asset('front-end/js/vendor/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('front-end/js/webslidemenu.js')}}"></script>
        <script src="{{asset('front-end/js/main.js')}}"></script>



       


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

        @yield('script')

        <script type="text/javascript">
          $(document).ready(function(){
                $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

          });


    $(document).ready(function(){
       $('#login').on('submit',function(){
        $('#login-preloading').show();
        $.ajax({
            type:'POST',
            url:'login',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success:function(response){
                $('#login-preloading').hide();
                window.location = '{{route('home')}}';
            },
            error: function (xhr) {
               $('#login-preloading').hide();
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
       $('#register').on('submit',function(){
        $('#preloading').show();
        $.ajax({
            type:'POST',
            url:'register',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success:function(response){
                $('#preloading').hide();
                window.location = '{{route('home')}}';
            },
            error: function (xhr) {
               $('#preloading').hide();
               $('#validation-errors').html('');
               $.each(xhr.responseJSON.errors, function(key,value) {
                 $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
               }); 

               setTimeout(function(){ 
                    $('#validation-errors').hide('slow');
               }, 5000);
            },
        });

        return false;

       });
    });
        </script>
    </body>
</html>
