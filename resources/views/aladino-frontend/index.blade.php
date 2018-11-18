<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <title>Aladino.lt</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('aladino-frontend/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('aladino-frontend/css/webslidemenu.css')}}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('aladino-frontend/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('aladino-frontend/css/style.css')}}">

    <script type="text/javascript" src="{{asset('aladino-frontend/js/jquery-3.2.1.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('aladino-frontend/js/webslidemenu.js')}}"></script>
</head>
<body>
            <!--Header-Area-Start-->
        <div class="wsmenucontainer clearfix">
            <div id="overlapblackbg"></div>
            <div class="TopperArea">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                         <div class="leftTopper">
                             <div class="logo"><a href="#"><h1>Aladino</h1></a></div>
                             <div class="topSearch">
                                 <form action="">
                                     <input class="inputOne" type="text" name="firstname" placeholder="Search for item or shop">
                                     <button type="submit" class="inputTwo">Search</button>
                                 </form>
                             </div>
                         </div>
                     </div>
                     
    <!--
                            <div class="col-auto sreachArea">
                              <label class="sr-only" for="inlineFormInputGroup">Username</label>
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text btn btn-danger">Search</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Search for item or shop">
                              </div>
                            </div>
                        -->  
                        
                        
                        <div class="col-md-6">
                            <div class="topperMenu">
                                <ul>
                                @if(!Auth()->check())
                                    <li><a href="#">Sell on Aladino</a></li>
                                    <li><a href="#">Register</a></li>
                                    <li><a href="after-login.html"><button type="button" class="inputThree btn btn-outline-warning">Sign in</button></a></li>
                                 @endif
                                 @if(Auth()->check())   
                                    <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><p style="margin-left: -10px;">Favorites</p></li>
                                    <li><a href="#"><i class="fa fa-share-square" aria-hidden="true"></i></a><p style="margin-left: -4px;">Shop</p></li>
                                    <li class="dropdownItem">
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="img-fluid" src="{{asset('aladino-frontend/images/avater.png')}}" alt="">
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">View Profile  ></a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-bell-o" aria-hidden="true"></i> Notifications</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> Conversations</a>
                                         <a class="dropdown-item" href="#">Purcheses & Reviews</a>
                                         <a class="dropdown-item" href="#">Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="index.html">Sign out</a>
                                      </div>
                                    </div>
                                </li>
                                @endif
                                    <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> <p>Cart</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<div class="container-fluid">
<div class="headerfull">
<div class="wsmain">
<nav class="wsmenu clearfix">
    <ul class="mobile-sub wsmenu-list">


            <?php
                $mainMenu = DB::table('menu_categories')->get();
                foreach ($mainMenu as $key => $value) {
                    # code...
                
            ?>
            <li><a href="{{url('aladino-product')}}" class="navtext"><span></span> <span>{{$value->category_name}}</span></a>
                <div class="megamenu clearfix">
                    <div class="container-fluid">
                        <div class="row">
                        <?php
                            $sub = DB::table('menu_sub_categories')->where('category_id',$value->id)->get();
                            if($sub){
                                foreach ($sub as $key => $sub_cat) {
           
                        ?>
                            <div class="col-lg-3 col-md-12">
                                <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"> {{$sub_cat->sub_category_name}} </li>
                                     <?php
                                        $tri_sub = DB::table('menu_tri_sub_categories')->where('sub_category_id',$sub_cat->id)->get();
                                        if($tri_sub){
                                            foreach ($tri_sub as $key => $tri_sub_cat) {
                       
                                    ?>
                                    <li><a href="{{url('aladino-product')}}">{{$tri_sub_cat->tri_sub_category_name}}</a></li>
                                   <?php } } ?>
                                </ul>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </li>

            <?php } ?>
        </ul>
    </nav>
</div>
</div>
</div>
</div>


<div class="mainContentArea">
                <div class="container">
                    <div class="mainContentTop">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="slider-area">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                      <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                          <img class="d-block w-100" src="{{asset('aladino-frontend/images/Slider/1.jpg')}}" alt="First slide">
                                      </div>
                                      <div class="carousel-item">
                                          <img class="d-block w-100" src="{{asset('aladino-frontend/images/Slider/2.jpg')}}" alt="Second slide">
                                      </div>
                                      <div class="carousel-item">
                                          <img class="d-block w-100" src="{{asset('aladino-frontend/images/Slider/3.jpg')}}" alt="Third slide">
                                      </div>
                                  </div>
                                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="#">
                            <img class="img-fluid" src="{{asset('aladino-frontend/images/slider1.png')}}" alt="img">
                        </a>
                    </div>
                </div>
            </div>
            <div class="mainContentBottom">
                <div class="row">
                    <div class="col-md-4">
                        <div class="contentItem text-center ">
                            <i class="fa fa-check text-warning"> <span style="color: #000;">Unique everything</span></i>
                            <p>We have millions of one-of-a-kind items, so you <br> can find whatever you need (or really, really want).</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contentItem text-center ">
                            <i class="fa fa-check text-warning"> <span style="color: #000;">Unique everything</span></i>
                            <p class="text-center">Buy directly from someone who put their heart <br> and soul into making something special.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contentItem text-center ">
                            <i class="fa fa-check text-warning"> <span style="color: #000;">Unique everything</span></i>
                            <p>Buy directly from someone who put their heart <br> and soul into making something special.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!--    Main-Content-Area-End-->
    <!--    Popular-Right-Now-Start-->
    <div class="popularArea">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="popularItem">
                        <img class="img-fluid" src="{{asset('aladino-frontend/images/populer/1.jpg')}}" alt="">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        
                    </div>
                    <br><br><br><br><br><br><br><br><br><br>
                    
                    <div class="popularAreaContent">
                        <h6>explorer journal with maps</h6>
                        <p>TremundoJournals</p>
                        <h4>&#9733;&#9733;&#9733;&#9733;&#9733; <span>(2974)</span></h4>
                        <p>USD 26.00</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="popularItem">
                        <img class="img-fluid" src="{{asset('aladino-frontend/images/populer/4.jpg')}}" alt="">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        
                    </div>
                    <br><br><br><br><br><br><br><br><br><br>
                    
                    <div class="popularAreaContent">
                        <h6>explorer journal with maps</h6>
                        <p>TremundoJournals</p>
                        <h4>&#9733;&#9733;&#9733;&#9733;&#9733; <span>(2974)</span></h4>
                        <p>USD 26.00</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="popularItem">
                        <img class="img-fluid" src="{{asset('aladino-frontend/images/populer/3.jpg')}}" alt="">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        
                    </div>
                    <br><br><br><br><br><br><br><br><br><br>
                    
                    <div class="popularAreaContent">
                        <h6>explorer journal with maps</h6>
                        <p>TremundoJournals</p>
                        <h4>&#9733;&#9733;&#9733;&#9733;&#9733; <span>(2974)</span></h4>
                        <p>USD 26.00</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="popularItem">
                        <img class="img-fluid" src="{{asset('aladino-frontend/images/populer/2.jpg')}}" alt="">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        
                    </div>
                    <br><br><br><br><br><br><br><br><br><br>
                    
                    <div class="popularAreaContent">
                        <h6>explorer journal with maps</h6>
                        <p>TremundoJournals</p>
                        <h4>&#9733;&#9733;&#9733;&#9733;&#9733; <span>(2974)</span></h4>
                        <p>USD 26.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    Popular-Right-Now-End-->
    <!--    Shop-for-gifts-Start-->

     <!--    Shop-for-gifts-Start-->
    <div class="giftArea">
        <div class="container">
            <div class="giftTop">
                <h1><a href="#">Shop for gifts</a></h1>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="giftItem">
                        <img src="{{asset('aladino-frontend/images/gift/1.jpg')}}" alt="Img" class="img-fluid">
                        <br>
                        <a href="#">Aniversary gifts</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="giftItem">
                        <img src="{{asset('aladino-frontend/images/gift/2.jpg')}}" alt="Img" class="img-fluid">
                        <br>
                        <a href="#">Aniversary gifts</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="giftItem">
                        <img src="{{asset('aladino-frontend/images/gift/3.jpg')}}" alt="Img" class="img-fluid">
                        <br>
                        <a href="#">Aniversary gifts</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="giftItem">
                        <img src="{{asset('aladino-frontend/images/gift/4.jpg')}}" alt="Img" class="img-fluid">
                        <br>
                        <a href="#">Aniversary gifts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="easyKeepArea text-center text-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <img src="{{asset('aladino-frontend/images/EasyKeep/1.png')}}" alt="Img" class="img-fluid">
            </div>
            <div class="col-md-2">
                <h5>Trustworthy sellers</h4>
                    <p>You can read their reviews and policies, and contact them with any questions</p>
            </div>
            <div class="col-md-4">
                    <h1>Etsy keeps you safe</h1>
                    <h4>World-class security</h4>
                    <p>Safeguarding your information is the top priority of our dedicated security experts</p>
            </div>
            <div class="col-md-2">
                    <h5>Purchase protection</h4>
                        <p>If anything goes wrong, our global support team has got your back</p>
            </div>
            <div class="col-md-2">
                        <img src="{{asset('aladino-frontend/images/EasyKeep/2.png')}}" alt="Img" class="img-fluid">
            </div>
          </div>
      </div>
    </div>

     <div class="reviewArea">
                <div class="container">
                 <h2>Recent reviews from happy people</h2>
                 <div class="row">
                    <div class="col-md-4">
                        <div class="reviewItem">
                            <img src="{{asset('aladino-frontend/images/review/1.jpg')}}" alt="Img" class="img-fluid">
                            <p><strong>HokuGirl</strong> wrote on August 9</p>
                            <h6 class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</h6>
                            <p>Received faster than expected. Exactly as described</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="reviewItem">
                            <img src="{{asset('aladino-frontend/images/review/2.jpg')}}" alt="Img" class="img-fluid">
                            <p><strong>HokuGirl</strong> wrote on August 9</p>
                            <h6 class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</h6>
                            <p>Received faster than expected. Exactly as described</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="reviewItem">
                            <img src="{{asset('aladino-frontend/images/review/3.jpg')}}" alt="Img" class="img-fluid">
                            <p><strong>HokuGirl</strong> wrote on August 9</p>
                            <h6 class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</h6>
                            <p>Received faster than expected. Exactly as described</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="itemOne">
                            <img src="{{asset('aladino-frontend/images/review/4.jpg')}}" alt="Img" class="img-fluid">
                            <p>Leather carry strap for furoshiki bag (black)</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="itemOne">
                            <img src="{{asset('aladino-frontend/images/review/5.jpg')}}" alt="Img" class="img-fluid">
                            <p>Leather carry strap for furoshiki bag (black)</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="itemOne">
                            <img src="{{asset('aladino-frontend/images/review/6.jpg')}}" alt="Img" class="img-fluid">
                            <p>Leather carry strap for furoshiki bag (black)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!--    Selling-Area-Start/-->
        <div class="sellingAtra">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{asset('aladino-frontend/images/selling/1.png')}}" alt="img" class="img-fluid">
                </div>
                <div class="col-md-5">
                    <h1>Start Selling On Estsy</h1>
                    <p>Millions of shoppers can't wait to see what you have in store.</p>
                    <a href="#">Open a shop today ></a>
                    
                </div>
                <div class="col-md-4">
                    <img src="{{asset('aladino-frontend/images/selling/2.png')}}" alt="img" class="img-fluid">
                </div>
            </div>
            </div>
        </div>
         <!--    Estsy-Area-Start-->
        <div class="estsyArea">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{asset('aladino-frontend/images/selling/3.png')}}" alt="img" class="img-fluid">
                    </div>
                    <div class="col-md-2">
                        <h1>What is Estsy</h1>
                        <p>Lorem ipsum dolor sit amet.</p>
                        <a href="#">Open a shop today ></a>
                    </div>
                    <div class="col-md-5">
                        <img src="{{asset('aladino-frontend/images/selling/4.png')}}" alt="img" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="footerArea">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <h6>Get fresh Etsy trends and unique gift ideas delivered right to your inbox.</h6>
                            <br>
                            <div class="col-auto sreachArea">
                              <label class="sr-only" for="inlineFormInputGroup">Username</label>
                              <div style="padding: 0 50px;"   class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text btn btn-danger">Subscribe</div>
                              </div>
                              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter Your Email">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3"></div>
          </div>
          <footer class="footerMenu">
             <div class="row">
                 <div class="col-md-3">
                     <ul>
                        <li><h6>Shop</h6></li>
                        <li><a href="#">Lorem</a></li>
                        <li><a href="#">Lorem</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                 <ul>
                    <li><h6>Sell</h6></li>
                    <li><a href="#">Loewm</a></li>
                    <li><a href="#">Loewm</a></li>
                    <li><a href="#">Loewm</a></li>
                </ul>
            </div>
            <div class="col-md-3">
             <ul>
                <li><h6>About</h6></li>
                <li><a href="#">Loewm</a></li>
                <li><a href="#">Loewm</a></li>
                <li><a href="#">Loewm</a></li>
                <li><a href="#">Loewm</a></li>
                <li><a href="#">Loewm</a></li>
                <li><a href="#">Loewm</a></li>
            </ul>
        </div>
         <div class="col-md-3">
         <ul>
            
            <li><h6>Follow Easy</h6></li>
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"> Facebook</i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"> Twiterr</i></a></li>
            <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"> youtube</i></a></li>

            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"> Facebook</i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"> Twiterr</i></a></li>
            <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"> youtube</i></a></li>
        </ul>
    </div>
    </div>

    </footer>

    </div>
    <hr>
    <div class="creaditArea text-center">
        <a class="" href="#">© 2018 Etsy, Inc.</a>
    </div>
    </div>
       
    </body>

    </html>