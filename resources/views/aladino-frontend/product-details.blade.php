<!DOCTYPE html>
<html lang="en">

<head>
     <title>Etsy</title>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <script type="text/javascript" src="{{asset('aladino-frontend/js/jquery-3.2.1.min.js')}}"></script>

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Bootstrap-->

    <!--Main Menu File-->
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('aladino-frontend/css/webslidemenu.css')}}" />
    <script type="text/javascript" src="{{asset('aladino-frontend/js/webslidemenu.js')}}"></script>
    <!--Main Menu File-->

    <!-- font awesome -->
    <link rel="stylesheet" href="{{asset('aladino-frontend/font-awesome/css/font-awesome.min.css')}}" />
    <!-- font awesome -->

    <!--For Demo Only (Remove below css file and Javascript) -->
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('aladino-frontend/css/demo.css')}}" />
    <link rel="stylesheet"  href="{{asset('aladino-frontend/css/lightslider.css')}}"/>
    <link rel="stylesheet" href="{{asset('aladino-frontend/css/style.css')}}">
    <!--
   <script type='text/javascript'>
    $(document).ready(function() {
      $(".gry, .blue, .green, .red, .orange, .yellow, .purple, .pink, .whitebg, .tranbg").on("click", function() {
        $(".headerfull")
          .removeClass()
          .addClass('headerfull pm_' + $(this).attr('class'));
      });

      $(".blue-grdt, .gry-grdt, .green-grdt, .red-grdt, .orange-grdt, .yellow-grdt, .purple-grdt, .pink-grdt").on("click", function() {
        $(".headerfull")
          .removeClass()
          .addClass('headerfull pm_' + $(this).attr('class'));
      });
    });
  </script>
  For Demo Only (End Removable) -->
  <script src="{{asset('aladino-frontend/js/lightslider.js')}}"></script> 
  <script>
         $(document).ready(function() {
            $("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
        });
    </script>


</head>

<body>
    <!--Header-Area-Start-->
    <div class="wsmenucontainer clearfix">
        <div id="overlapblackbg"></div>
        <div class="TopperArea">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
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
                       
                    
                    <div class="col-md-4">
                        <div class="topperMenu">
                                <ul>
                                    <li><a href="#">Sell on Aladino</a></li>
                                    <li><a href="#">Register</a></li>
                                    <li><a href="after-login.html"><button type="button" class="inputThree btn btn-outline-warning">Sign in</button></a></li>
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
                        <li><a href="#" class="navtext"><span></span> <span>Department</span></a>
                            <div class="wsshoptabing wtsdepartmentmenu clearfix">
                                <div class="wsshopwp clearfix">
                                    <ul class="wstabitem clearfix">
                                        <li class="wsshoplink-active"><a href="#"><i class="fa fa-male" ></i> Women's Clothing &amp; Accessories</a>
                                            <div class="wstitemright clearfix wstitemrightactive">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12 clearfix">
                                                            <div class="wstheading clearfix">Women's Clothing</div>
                                                            <ul class="wstliststy01 clearfix">
                                                                <li><a href="#">Sweatshirts</a></li>
                                                                <li><a href="#">Fashion Hoodies <span class="wstmenutag greentag">New</span></a></li>
                                                                <li><a href="#">Jeans &amp; Trousers</a></li>
                                                                <li><a href="#">Capris and Shorts <span class="wstmenutag bluetag">Trending</span></a></li>
                                                                <li><a href="#">Leggings</a></li>
                                                                <li><a href="#">Swimsuits &amp; Cover Ups</a></li>
                                                                <li><a href="#">Lingerie, Sleep &amp; Lounge</a></li>
                                                                <li><a href="#">Inner &amp; Nightwear</a> <span class="wstmenutag redtag">Sale</span></li>
                                                                <li><a href="#">Jumpsuits, Rompers </a></li>
                                                                <li><a href="#">Coats, Jackets &amp; Vests</a></li>
                                                                <li><a href="#">Suiting &amp; Blazers </a></li>
                                                                <li><a href="#">Socks &amp; Hosiery</a></li>
                                                            </ul>
                                                            <div class="wstheading clearfix">Handbags & Wallets</div>
                                                            <ul class="wstliststy01 clearfix">
                                                                <li><a href="#">Clutches</a> </li>
                                                                <li><a href="#">Cross-Body Bags</a> </li>
                                                                <li><a href="#">Evening Bags</a> </li>
                                                                <li><a href="#">Shoulder Bags</a> <span class="wstmenutag orangetag">Hot</span></li>
                                                                <li><a href="#">Top-Handle Bags</a> </li>
                                                                <li><a href="#">Wristlets</a> </li>
                                                            </ul>
                                                            <div class="wstheading clearfix">Accessories</div>
                                                            <ul class="wstliststy01 clearfix">
                                                                <li><a href="#">Handbag Accessories</a> </li>
                                                                <li><a href="#">Sunglasses Accessories</a> </li>
                                                                <li><a href="#">Eyewear Accessories</a> </li>
                                                                <li><a href="#">Scarves & Wraps</a> </li>
                                                                <li><a href="#">Gloves & Mittens</a> </li>
                                                                <li><a href="#">Hats & Caps</a> </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 clearfix">
                                                            <div class="wstbootslider clearfix">
                                                                <div id="demo" class="carousel slide" data-ride="carousel">

                                                                    <!-- The slideshow -->
                                                                    <div class="carousel-inner">
                                                                        <div class="carousel-item active"><img src="images/woman-ad-img.jpg" alt="" />
                                                                            <div class="carousel-caption">
                                                                                <h3>Slider Caption 01</h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="carousel-item"><img src="images/woman-ad-img02.jpg" alt="" />
                                                                            <div class="carousel-caption">
                                                                                <h3>Slider Caption 01</h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Left and right controls -->
                                                                    <a class="carousel-control-prev" href="#demo" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#demo" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="#"><i class="fa fa-female"></i> Men's Clothing &amp; Accessories</a>
                                            <div class="wstitemright clearfix">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12 clearfix">
                                                            <div class="wstheading clearfix">Men's Clothing</div>
                                                            <ul class="wstliststy01 clearfix">
                                                                <li><a href="#">Shirts <span class="wstmenutag greentag">New</span></a></li>
                                                                <li><a href="#">Fashion Hoodies & Sweatshirts </a></li>
                                                                <li><a href="#">Pants &amp; Trousers</a></li>
                                                                <li><a href="#">Capris and Shorts </a></li>
                                                                <li><a href="#">Swim</a></li>
                                                                <li><a href="#">Suits & Sport Coats</a></li>
                                                                <li><a href="#">Underwear</a></li>
                                                                <li><a href="#">Socks</a> </li>
                                                                <li><a href="#">Sleep & Lounge</a></li>
                                                                <li><a href="#">T-Shirts & Tanks <span class="wstmenutag redtag">20% off Sale</span></a></li>
                                                                <li><a href="#">Active</a></li>
                                                                <li><a href="#">Sport Coats <span class="wstmenutag bluetag">Trending</span></a></li>
                                                            </ul>
                                                            <div class="wstheading clearfix">Shoes & Wallets</div>
                                                            <ul class="wstliststy01 clearfix">
                                                                <li><a href="#">Athletic</a> </li>
                                                                <li><a href="#">Boots</a> <span class="wstmenutag orangetag">Exclusive</span></li>
                                                                <li><a href="#">Fashion Sneakers</a> </li>
                                                                <li><a href="#">Loafers & Slip-Ons</a> </li>
                                                                <li><a href="#">Mules & Clogs</a> </li>
                                                                <li><a href="#">Outdoor</a> </li>
                                                                <li><a href="#">Oxfords</a> </li>
                                                                <li><a href="#">Sandals</a> </li>
                                                                <li><a href="#">Slippers</a> </li>
                                                            </ul>
                                                            <div class="wstheading clearfix">Accessories</div>
                                                            <ul class="wstliststy01 clearfix">
                                                                <li><a href="#">Belts</a> </li>
                                                                <li><a href="#">Suspenders</a> </li>
                                                                <li><a href="#">Eyewear Accessories</a> </li>
                                                                <li><a href="#">Neckties</a> </li>
                                                                <li><a href="#">Bow Ties & Cummerbunds</a> </li>
                                                                <li><a href="#">Collar Stays</a> </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 clearfix"><a href="#" class="wstmegamenucolr"><img src="images/man-ad-img.jpg" alt="" ></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="#"><i class="fa fa-play-circle"></i> Movies, Music &amp; Games</a>
                                            <div class="wstitemright clearfix">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12 clearfix">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li class="wstheading clearfix">Latest Movies</li>
                                                                <li><a href="#">Action & Adventure <span class="wstmenutag greentag">New</span></a></li>
                                                                <li><a href="#">Bollywood </a></li>
                                                                <li><a href="#">Documentary</a></li>
                                                                <li><a href="#">Educational</a></li>
                                                                <li><a href="#">Exercise & Fitness </a></li>
                                                                <li><a href="#">Faith & Spirituality</a></li>
                                                                <li><a href="#">Fantasy</a></li>
                                                                <li><a href="#">Romance</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12 clearfix">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li class="wstheading clearfix">Newest Games</li>
                                                                <li><a href="#">PlayStation 4 </a> </li>
                                                                <li><a href="#">Xbox One </a> <span class="wstmenutag orangetag">Most Viewed</span></li>
                                                                <li><a href="#">Nintendo DS</a> </li>
                                                                <li><a href="#">PlayStation Vita </a> </li>
                                                                <li><a href="#">Retro Gaming</a> </li>
                                                                <li><a href="#">Digital Games</a> </li>
                                                                <li><a href="#">Microconsoles</a> </li>
                                                                <li><a href="#">Kids & Family </a> </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12 clearfix">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li class="wstheading clearfix">Popular Music Genre</li>
                                                                <li><a href="#">Alternative & Indie Rock</a> </li>
                                                                <li><a href="#">Broadway & Vocalists</a> </li>
                                                                <li><a href="#">Children's Music</a> </li>
                                                                <li><a href="#">Christian <span class="wstmenutag bluetag">50% off</span></a> </li>
                                                                <li><a href="#">Classic Rock</a> </li>
                                                                <li><a href="#">Comedy & Miscellaneous </a> </li>
                                                                <li><a href="#">Country</a> </li>
                                                                <li><a href="#">Dance & Electronic</a> </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12 clearfix">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li class="wstheading clearfix">Popular Music Genre</li>
                                                                <li><a href="#">Alternative & Indie Rock</a> </li>
                                                                <li><a href="#">Broadway & Vocalists</a> </li>
                                                                <li><a href="#">Children's Music <span class="wstmenutag redtag">Discounted</span></a>
                                                                </li>
                                                                <li><a href="#">Classical</a> </li>
                                                                <li><a href="#">Classic Rock</a> </li>
                                                                <li><a href="#">Comedy & Miscellaneous</a> </li>
                                                                <li><a href="#">Country</a> </li>
                                                                <li><a href="#">Dance & Electronic</a> </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-6 wstadsize01 clearfix"><a href="#"><img src="images/ad-size01.jpg" alt="" ></a></div>
                                                        <div class="col-lg-6 wstadsize02 clearfix"><a href="#"><img src="images/ad-size02.jpg" alt="" ></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="#"><i class="fa fa-cutlery"></i>Home &amp; Kitchen</a>
                                            <div class="wstitemright clearfix kitchenmenuimg">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li class="wstheading clearfix">Home Appliances</li>
                                                                <li><a href="#">Air Conditioners <span class="wstmenutag greentag">New</span></a></li>
                                                                <li><a href="#">Air Coolers </a></li>
                                                                <li><a href="#">Fans</a></li>
                                                                <li><a href="#">Microwaves</a></li>
                                                                <li><a href="#">Refrigerators</a></li>
                                                                <li><a href="#">Washing Machines </a></li>
                                                                <li><a href="#">Jars & Containers </a></li>
                                                                <li><a href="#">LED & CFL bulbs </a></li>
                                                                <li><a href="#">Drying Racks </a></li>
                                                                <li><a href="#">Laundry Baskets</a> <span class="wstmenutag orangetag">New</span></li>
                                                                <li><a href="#">Washing Machines </a></li>
                                                                <li><a href="#">Bedsheets </a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li class="wstheading clearfix">Kitchen Appliances</li>
                                                                <li><a href="#">Air Fryers </a></li>
                                                                <li><a href="#">Espresso Machines</a></li>
                                                                <li><a href="#">Food Processors</a> <span class="wstmenutag bluetag">Popular</span></li>
                                                                <li><a href="#">Hand Blenders</a></li>
                                                                <li><a href="#">Induction Cooktops</a></li>
                                                                <li><a href="#">Microwave Ovens</a></li>
                                                                <li><a href="#">Mixers & Grinders</a></li>
                                                                <li><a href="#">Rice Cookers</a></li>
                                                                <li><a href="#">Stand Mixers</a></li>
                                                                <li><a href="#">Sandwich Makers</a></li>
                                                                <li><a href="#">Tandoor & Grills</a></li>
                                                                <li><a href="#">Toasters</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="#"><i class="fa fa-television"></i>Electronics Appliances</a>
                                            <div class="wstitemright clearfix">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li><img src="images/ele-menu-img01.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix">TV & Audio</li>
                                                                <li><a href="#">4K Ultra HD TVs </a></li>
                                                                <li><a href="#">LED & LCD TVs</a></li>
                                                                <li><a href="#">OLED TVs</a> <span class="wstmenutag bluetag">Popular</span></li>
                                                                <li><a href="#">Plasma TVs</a></li>
                                                                <li><a href="#">Smart TVs</a></li>
                                                                <li><a href="#">Home Theater</a></li>
                                                                <li><a href="#">Wireless & streaming</a></li>
                                                                <li><a href="#">Stereo System</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li><img src="images/ele-menu-img02.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix">Camera, Photo & Video</li>
                                                                <li><a href="#">Accessories <span class="wstcount">(1145)</span></a></li>
                                                                <li><a href="#">Bags & Cases <span class="wstcount">(445)</span></a></li>
                                                                <li><a href="#">Binoculars & Scopes <span class="wstcount">(45)</span></a></li>
                                                                <li><a href="#">Digital Cameras <span class="wstcount">(845)</span></a> </li>
                                                                <li><a href="#">Film Photography <span class="wstcount">(245)</span></a> <span class="wstmenutag bluetag">Popular</span></li>
                                                                <li><a href="#">Flashes <span class="wstcount">(105)</span></a></li>
                                                                <li><a href="#">Lenses <span class="wstcount">(445)</span></a></li>
                                                                <li><a href="#">Video <span class="wstcount">(145)</span></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li><img src="images/ele-menu-img03.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix">Cell Phones & Accessories</li>
                                                                <li><a href="#">Unlocked Cell Phones </a></li>
                                                                <li><a href="#">Smartwatches </a></li>
                                                                <li><a href="#">Carrier Phones</a></li>
                                                                <li><a href="#">Cell Phone Cases</a> <span class="wstmenutag orangetag">Hot</span></li>
                                                                <li><a href="#">Bluetooth Headsets</a></li>
                                                                <li><a href="#">Cell Phone Accessories</a></li>
                                                                <li><a href="#">Fashion Tech</a></li>
                                                                <li><a href="#">Headphone</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy02 clearfix">
                                                                <li><img src="images/ele-menu-img04.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix">Wearable Device</li>
                                                                <li><a href="#">Activity Trackers </a></li>
                                                                <li><a href="#">Sports & GPS Watches</a></li>
                                                                <li><a href="#">Smart Watches</a> <span class="wstmenutag greentag">New</span></li>
                                                                <li><a href="#">Virtual Reality Headsets</a></li>
                                                                <li><a href="#">Wearable Cameras</a></li>
                                                                <li><a href="#">Smart Glasses</a></li>
                                                                <li><a href="#">Kids & Pets</a></li>
                                                                <li><a href="#">Smart Sport Accessories</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="#"><i class="fa fa-laptop"></i>Computers &amp; Accessories</a>
                                            <div class="wstitemright clearfix computermenubg">
                                                <div class="wstmegamenucoll01 clearfix">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <div class="wstheading clearfix">Monitors <a href="#" class="wstmorebtn">View All</a></div>
                                                                <ul class="wstliststy03 clearfix">
                                                                    <li><a href="#">50 Inches & Above <span class="wstmenutag greentag">New</span></a></li>
                                                                    <li><a href="#">40 to 49.9 Inches </a></li>
                                                                    <li><a href="#">30 to 39.9 Inches</a></li>
                                                                    <li><a href="#">26 to 29.9 Inches</a></li>
                                                                    <li><a href="#">18 to 19.9 Inches</a></li>
                                                                    <li><a href="#">16 to 17.9 Inches</a></li>
                                                                    <li><a href="#">26 to 29.9 Inches</a></li>
                                                                    <li><a href="#">18 to 19.9 Inches</a></li>
                                                                    <li><a href="#">16 to 17.9 Inches</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="wstheading clearfix">Software <a href="#" class="wstmorebtn">View All</a></div>
                                                                <ul class="wstliststy03 clearfix">
                                                                    <li><a href="#">Antivirus & Security</a> </li>
                                                                    <li><a href="#">Business & Office</a> <span class="wstmenutag orangetag">Exclusive</span></li>
                                                                    <li><a href="#">Web Design</a> </li>
                                                                    <li><a href="#">Digital Software</a> </li>
                                                                    <li><a href="#">Education & Reference</a> </li>
                                                                    <li><a href="#">Lifestyle & Hobbies</a> </li>
                                                                    <li><a href="#">Digital Software</a> </li>
                                                                    <li><a href="#">Education & Reference</a> </li>
                                                                    <li><a href="#">Lifestyle & Hobbies</a> </li>
                                                                </ul>

                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="wstheading clearfix">Accessories <a href="#" class="wstmorebtn">View All</a></div>
                                                                <ul class="wstliststy03 clearfix">
                                                                    <li><a href="#">Audio & Video Accessories</a> </li>
                                                                    <li><a href="#">Cable Security Devices</a> </li>
                                                                    <li><a href="#">Input Devices </a> </li>
                                                                    <li><a href="#">Memory Cards</a> </li>
                                                                    <li><a href="#">Monitor Accessories</a> </li>
                                                                    <li><a href="#">USB Gadgets</a> </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="#"><i class="fa fa-car"></i>Auto accessories</a>
                                            <div class="wstitemright clearfix wstpngsml">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy04 clearfix">
                                                                <li><img src="images/auto-menu-img01.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix"><a href="#">Interior</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy04 clearfix">
                                                                <li><img src="images/auto-menu-img02.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix"><a href="#">Styling</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy04 clearfix">
                                                                <li><img src="images/auto-menu-img03.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix"><a href="#">Utility</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy04 clearfix">
                                                                <li><img src="images/auto-menu-img04.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix"><a href="#">Spare Parts</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy04 clearfix">
                                                                <li><img src="images/auto-menu-img05.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix"><a href="#">Protection</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy04 clearfix">
                                                                <li><img src="images/auto-menu-img06.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix"><a href="#">Cleaning</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy04 clearfix">
                                                                <li><img src="images/auto-menu-img07.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix"><a href="#">Car Audio</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12">
                                                            <ul class="wstliststy04 clearfix">
                                                                <li><img src="images/auto-menu-img08.jpg" alt=" "></li>
                                                                <li class="wstheading clearfix"><a href="#">Gear & Accessories</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="#"><i class="fa fa-heartbeat"></i>Health Care Products</a>
                                            <div class="wstitemright clearfix wstpngsml">
                                                <div class="container-fluid">


                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-12 wstmegamenucolr03 clearfix"> <img src="images/health-menu-img01.jpg" alt=""> </div>
                                                        <div class="col-lg-8 col-md-12 clearfix">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-12">
                                                                        <ul class="wstliststy05 clearfix">
                                                                            <li><img src="images/health-menu-img02.jpg" alt=" "></li>
                                                                            <li class="wstheading clearfix">Health Care</li>
                                                                            <li><a href="#">Diabetes </a></li>
                                                                            <li><a href="#">Incontinence </a></li>
                                                                            <li><a href="#">Cough & Cold</a></li>
                                                                            <li><a href="#">Baby & Child Care</a> <span class="wstmenutag bluetag">Popular</span></li>
                                                                            <li><a href="#">Women's Health</a></li>
                                                                            <li><a href="#">First Aid</a></li>
                                                                            <li><a href="#">Smoking Cessation</a></li>
                                                                            <li><a href="#">Sleep & Snoring</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-12">
                                                                        <ul class="wstliststy05 clearfix">
                                                                            <li><img src="images/health-menu-img03.jpg" alt=" "></li>
                                                                            <li class="wstheading clearfix">Personal Care</li>
                                                                            <li><a href="#">Shaving & Hair Removal</a></li>
                                                                            <li><a href="#">Feminine Hygiene</a></li>
                                                                            <li><a href="#">Oral Care</a></li>
                                                                            <li><a href="#">Foot Care</a> <span class="wstmenutag bluetag">Popular</span></li>
                                                                            <li><a href="#">Hand Care</a></li>
                                                                            <li><a href="#">Personal Care Appliances</a></li>
                                                                            <li><a href="#">Shaving Foams & Creams</a></li>
                                                                            <li><a href="#">Hair Removal Creams</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-12">
                                                                        <ul class="wstliststy05 clearfix">
                                                                            <li><img src="images/health-menu-img04.jpg" alt=" "></li>
                                                                            <li class="wstheading clearfix">Medical Equipment</li>
                                                                            <li><a href="#">Crepe Bandages, Tapes & Supplies </a></li>
                                                                            <li><a href="#">Neck Supports</a></li>
                                                                            <li><a href="#">Arm Supports</a> <span class="wstmenutag bluetag">Popular</span></li>
                                                                            <li><a href="#">Elbow Braces</a></li>
                                                                            <li><a href="#">Knee & Leg Braces</a></li>
                                                                            <li><a href="#">Ankle Braces</a></li>
                                                                            <li><a href="#">Foot Supports</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li><a href="#" class="navtext"><span></span> <span>MegaMenu</span></a>
                            <div class="megamenu clearfix">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-12">
                                            <ul class="wstliststy02 clearfix">
                                                <li class="wstheading clearfix"> Skype Products </li>
                                                <li><a href="#">List Products 01 </a> <span class="wstmenutag redtag">Popular</span></li>
                                                <li><a href="#">List Products 02</a></li>
                                                <li><a href="#">List Products 03</a></li>
                                                <li><a href="#">List Products 04</a> </li>
                                                <li><a href="#">List Products 05</a> </li>
                                                <li><a href="#">List Products 06</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <ul class="wstliststy02 clearfix">
                                                <li class="wstheading clearfix">Paypal Products</li>
                                                <li><a href="#">List Products 07 </a></li>
                                                <li><a href="#">List Products 08</a></li>
                                                <li><a href="#">List Products 09</a></li>
                                                <li><a href="#">List Products 10</a> </li>
                                                <li><a href="#">List Products 11 </a></li>
                                                <li><a href="#">List Products 12</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <ul class="wstliststy02 clearfix">
                                                <li class="wstheading clearfix">Sound Cloud Products</li>
                                                <li><a href="#">List Products 13 </a> <span class="wstmenutag orangetag">20% off</span></li>
                                                <li><a href="#">List Products 14</a></li>
                                                <li><a href="#">List Products 15</a></li>
                                                <li><a href="#">List Products 16</a> </li>
                                                <li><a href="#">List Products 17</a></li>
                                                <li><a href="#">List Products 18</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <ul class="wstliststy02 clearfix">
                                                <li class="wstheading clearfix">Get Pocket Products</li>
                                                <li><a href="#">List Products 19 </a> <span class="wstmenutag bluetag">Winter Offer</span></li>
                                                <li><a href="#">List Products 20</a></li>
                                                <li><a href="#">List Products 21</a></li>
                                                <li><a href="#">List Products 22</a> </li>
                                                <li><a href="#">List Products 23</a></li>
                                                <li><a href="#">List Products 24</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#" class="navtext">Home & Living</a></li>
                        <li><a href="#" class="navtext">Wedding & Party</a></li>
                        <li><a href="#" class="navtext">Toy & Entertainment</a></li>
                        <li><a href="#" class="navtext">Atr & Celebration</a></li>
                        <li><a href="#" class="navtext">Craft Supplies & Tools</a></li>
                        <li><a href="#" class="navtext">Vintage</a></li>
                        <li><a href="#" class="navtext">Contact</a></li>
                        
                    </ul>
                </nav>
            </div>
        </div>
        </div>
    </div>
    <div class="product-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="product-logo">
                        <ul>
                            <li>
                                <a href="#"><img src="{{asset('aladino-frontend/images/product-view/product-logo.jpg')}}" alt="Product-logo" class="img-fluid"></a>
                            </li>
                            <li>
                                <a href="#">Badimyon <br><span><i class="fa fa-heart-o"> Favorite Shop</i></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <div class="product-nav">
                        <ul>
                            <li>
                                 <a href="#"><img src="{{asset('aladino-frontend/images/product-view/product-menu.jpg')}}" alt="img" class="img-fluid"></a>
                            </li>
                            <li>
                                 <a href="#"><img src="{{asset('aladino-frontend/images/product-view/product-menu.jpg')}}" alt="img" class="img-fluid"></a>
                            </li>
                            <li>
                                 <a href="#"><img src="{{asset('aladino-frontend/images/product-view/product-menu.jpg')}}" alt="img" class="img-fluid"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('aladino-frontend/images/product-view/product-menu.jpg')}}" alt="img" class="img-fluid"></a>
                            </li>
                            <li class="last-li">
                                <a class="text-center" href="#"><span >83</span><br>items</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><hr>
    <div class="product-view">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="product-view-left">
                        <div class="alert alert-secondary" role="alert">
                            <p style="font-size: 15px;"><strong>Like this item?</strong><br>
                            Add it to your favorites to revisit it later.</p>
                        </div>
                        <div class="product-slider">
                            <div class="demo">
                                <div class="item">            
                                    <div class="clearfix">
                                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-1.jpg')}}"> 
                                                <img class="item-img" src="{{asset('aladino-frontend/img/thumb/cS-1.jpg')}}" />
                                            </li>
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-2.jpg')}}"> 
                                                <img class="item-img" src="{{asset('aladino-frontend/img/thumb/cS-2.jpg')}}" />
                                            </li>
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-3.jpg')}}"> 
                                                <img class="item-img" src="{{asset('aladino-frontend/img/thumb/cS-3.jpg')}}" />
                                            </li>
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-4.jpg')}}"> 
                                                <img class="item-img" src="{{asset('aladino-frontend/img/thumb/cS-4.jpg')}}" />
                                            </li>
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-5.jpg')}}"> 
                                                <img class="item-img" src="{{asset('aladino-frontend/img/thumb/cS-5.jpg')}}" />
                                            </li>
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-6.jpg')}}"> 
                                                <img src="{{asset('aladino-frontend/img/thumb/cS-6.jpg')}}" />
                                            </li>
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-7.jpg')}}"> 
                                                <img src="{{asset('aladino-frontend/img/thumb/cS-7.jpg')}}" />
                                            </li>
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-8.jpg')}}"> 
                                                <img src="{{asset('aladino-frontend/img/thumb/cS-8.jpg')}}" />
                                            </li>
                                            <li data-thumb="{{asset('aladino-frontend/img/thumb/cS-9.jpg')}}"> 
                                                <img src="{{asset('aladino-frontend/img/thumb/cS-9.jpg')}}" />
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{asset('aladino-frontend/images/product-view/product-logo.jpg')}}" alt="img" class="img-fluid">
                                </div>
                                <div class="col-md-10">
                                    <div class="alert alert-secondary" role="alert">
                                        <p style="font-size: 15px;"><strong style="color: #F56400; cursor: pointer">Request a custom order</strong>
                                         and have something made just for you.</p>
                                    </div>
                                </div>
                            </div><hr>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="product-view-right">
                        <div class="product-right-title">
                            <h2 style="font-size: 22px; line-height: 26px; font-weight: 400;">Pattern backpack, canvas backpack women, vegan backpack, college backpack, birthday gifts for her, gift for sister, Bohemian patchwork bag</h2><br>
                        </div>
                        <div class="product-price-curt">
                            <div class="price">
                                <div class="price-item">
                                    <ul>
                                        <li><a href="#">USD 80.75+</a></li>
                                        <li><a href="#">Ask a question</a></li>
                                     </ul><br><br>
                                </div>
                                <p class="p98">Local taxes included (where applicable) <br><br>Free shipping with USD 85 purchase from Badimyon</p>
                               <div class="combo-area">
                                    <p>combo</p>
                                    <div class="dropdown">
                                      <button style="float: left" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select an option
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                      </div>
                                    </div>
                               </div>
                               <br><br><br>
                               <div class="quantity-area">
                                   <div class="combo-area">
                                    <p>Quality</p>
                                    <div class="dropdown">
                                      <button style="float: left" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        1
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">4</a>
                                        <a class="dropdown-item" href="#">3</a>
                                        <a class="dropdown-item" href="#">2</a>
                                      </div>
                                    </div>
                                   </div>
                              </div><br><br><br><!--  2nd dropdown end-->
                               <div class="add-to-cart">
                                   <a href="#">Add to cart</a>
                               </div><br>
                               <div class="cart-menu">
                                   <ul style="display: flex">
                                       <li><a href="#"><i style="font-size: 35px;color: #F56400; margin-right: 20px;" class="fa fa-cart-plus" aria-hidden="true"></i></a></li>
                                       <li><a style="text-decoration: none;color: #777;font-size: 15px;" href="#"><p><strong>Other people want this.</strong> 3 people have this in their carts right now.</p></a></li>
                                   </ul>
                               </div><br><hr> <!-- cart end -->
                               <div class="overview">
                                   <ul style="list-style: circle; font-weight: 600">Overview
                                       <li style="margin-left:20px; font-size:15px;font-weight:100;">Lorem ipsum dolor</li>
                                       <li style="margin-left:20px; font-size:15px;font-weight:100;">Lorem ipsum dolor</li>
                                       <li style="margin-left:20px; font-size:15px;font-weight:100;">Lorem ipsum dolor</li>
                                       <li style="margin-left:20px; font-size:15px;font-weight:100;">Lorem ipsum dolor</li>
                                       <li style="margin-left:20px; font-size:15px;font-weight:100;">Lorem ipsum dolor</li>
                                   </ul>
                               </div> <br><hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-view-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                   <div class="sale-details">
                       <p><b>Sale details </b><br>
                        Back To School Sale - 15% OFF <br>
                        All Messenger Bags, Student Bags, and Backpacks</p>
                   </div><hr>
                   <div class="description-area">
                        <h5>Description</h5>
                        <p>** Bestseller! Grab one before this fabric is gone! **</p>
                        <div class="more">
                          Morbi placerat imperdiet risus quis blandit. Ut lobortis elit luctus, feugiat erat vitae, interdum diam. Nam sit amet arcu vitae justo lacinia ultricies nec eget tellus. Curabitur id sapien massa. In hac <a href="#">habitasse</a> platea dictumst. Integer tristique leo consectetur libero pretium pretium. Nunc sed mauris magna. Praesent varius purus id turpis iaculis iaculis. Nulla <em>convallis magna nunc</em>, id rhoncus massa ornare in. Donec et feugiat sem, ac rhoncus mauris. Quisque eget tempor massa.
                          
                        </div>
                    </div><hr>
                    <div class="review-area">
                        <h5>Reviews <span style="color: #f56400">&#9733;&#9733;&#9733;&#9733;&#9733;</span> (41240)</h5><br><br>
                        <div class="row">
                            <div class="col-md-3 text-center">
                               <img src="{{asset('aladino-frontend/img/reviews-avatar%5D.png')}}" alt="image" class="img-fluid rv-av">
                                <p>Reviewed by <br>
                                Brenda Rutherford</p>
                            </div>
                            <div class="col-md-9">
                                <h5 style="color: #f56400">&#9733;&#9733;&#9733;&#9733;&#9733;<span style="color: #000; float: right; font-size: 15px;">Aug 15, 2018</span></h5><br><br>
                                <p class="p11">The dress is beautiful and well made but it is a very shiny material not like I expected it to be. I ordered it a size smaller than I wear because reviews said it runs big but it is still very large. I didn’t want to send it back and get a smaller size because it took so long to get it and returns are hard to China. I found this out when I ordered a skirt before. I haven’t washed it yet so when I do I hope it isn’t so shiny and hopefully it will soften up and will flow and drape better.</p><br>
                                <div class="mq11">
                                    <img src="{{asset('aladino-frontend/img/cS-9.jpg')}}" alt="img" class="img-fluid">
                                    <p class="p12">The dress is beautiful and well made but it is a very shiny material not like I expected it to be. I ordered it a size smaller than I wear because reviews said it runs big but it is still very large.I found this out when I ordered a skirt before. I haven’t  I didn’t want to send it back and get a smaller size because it took </p>
                                </div>
                            </div>
                            
                        </div><br><hr>
                        <div class="row">
                            <div class="col-md-3 text-center">
                               <img src="{{asset('aladino-frontend/img/reviews-avatar%5D.png')}}" alt="image" class="img-fluid rv-av">
                                <p>Reviewed by <br>
                                Brenda Rutherford</p>
                            </div>
                            <div class="col-md-9">
                                <h5 style="color: #f56400">&#9733;&#9733;&#9733;&#9733;&#9733;<span style="color: #000; float: right; font-size: 15px;">Aug 15, 2018</span></h5><br><br>
                                <p class="p11">The dress is beautiful and well made but it is a very shiny material not like I expected it to be. I ordered it a size smaller than I wear because reviews said it runs big but it is still very large. I didn’t want to send it back and get a smaller size because it took so long to get it and returns are hard to China. I found this out when I ordered a skirt before. I haven’t washed it yet so when I do I hope it isn’t so shiny and hopefully it will soften up and will flow and drape better.</p><br>
                                <div class="mq11">
                                    <img src="{{asset('aladino-frontend/img/cS-9.jpg')}}" alt="img" class="img-fluid">
                                    <p class="p12">The dress is beautiful and well made but it is a very shiny material not like I expected it to be. I ordered it a size smaller than I wear because reviews said it runs big but it is still very large.I found this out when I ordered a skirt before. I haven’t  I didn’t want to send it back and get a smaller size because it took </p>
                                </div>
                            </div>
                            
                        </div><br><hr>
                        <div class="row">
                            <div class="col-md-3 text-center">
                               <img src="{{asset('aladino-frontend/img/reviews-avatar%5D.png')}}" alt="image" class="img-fluid rv-av">
                                <p>Reviewed by <br>
                                Brenda Rutherford</p>
                            </div>
                            <div class="col-md-9">
                                <h5 style="color: #f56400">&#9733;&#9733;&#9733;&#9733;&#9733;<span style="color: #000; float: right; font-size: 15px;">Aug 15, 2018</span></h5><br><br>
                                <p class="p11">The dress is beautiful and well made but it is a very shiny material not like I expected it to be. I ordered it a size smaller than I wear because reviews said it runs big but it is still very large. I didn’t want to send it back and get a smaller size because it took so long to get it and returns are hard to China. I found this out when I ordered a skirt before. I haven’t washed it yet so when I do I hope it isn’t so shiny and hopefully it will soften up and will flow and drape better.</p><br>
                                <div class="mq11">
                                    <img src="{{asset('aladino-frontend/img/cS-9.jpg')}}" alt="img" class="img-fluid">
                                    <p class="p12">The dress is beautiful and well made but it is a very shiny material not like I expected it to be. I ordered it a size smaller than I wear because reviews said it runs big but it is still very large.I found this out when I ordered a skirt before. I haven’t  I didn’t want to send it back and get a smaller size because it took </p>
                                </div>
                            </div>
                            
                        </div><br><hr>
                        <div class="row">
                            <div class="col-md-3 text-center">
                               <img src="{{asset('aladino-frontend/img/reviews-avatar%5D.png')}}" alt="image" class="img-fluid rv-av">
                                <p>Reviewed by <br>
                                Brenda Rutherford</p>
                            </div>
                            <div class="col-md-9">
                                <h5 style="color: #f56400">&#9733;&#9733;&#9733;&#9733;&#9733;<span style="color: #000; float: right; font-size: 15px;">Aug 15, 2018</span></h5><br><br>
                                <p class="p11">The dress is beautiful and well made but it is a very shiny material not like I expected it to be. I ordered it a size smaller than I wear because reviews said it runs big but it is still very large. I didn’t want to send it back and get a smaller size because it took so long to get it and returns are hard to China. I found this out when I ordered a skirt before. I haven’t washed it yet so when I do I hope it isn’t so shiny and hopefully it will soften up and will flow and drape better.</p><br>
                                <div class="mq11">
                                    <img src="{{asset('aladino-frontend/img/cS-9.jpg')}}" alt="img" class="img-fluid">
                                    <p class="p12">The dress is beautiful and well made but it is a very shiny material not like I expected it to be. I ordered it a size smaller than I wear because reviews said it runs big but it is still very large.I found this out when I ordered a skirt before. I haven’t  I didn’t want to send it back and get a smaller size because it took </p>
                                </div>
                            </div>
                            
                        </div><br><hr>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="shipping">
                        <h5>Shipping & returns</h5>
                        <h6><b>Ready to ship in 3–7 business days</b></h6>
                        From Israel <br>
                        Free shipping to Bangladesh <br>
                        Shipping upgrades available in the cart <br><br>
                        <b>Returns and exchanges accepted</b><br>
                        Exceptions may apply. See return policy
                    </div><br><hr>
                    <div class="socila-media-area">
                        <ul>
                            <li>
                                <a href="#"><i style="font-size: 25px;" class="fa fa-facebook-square" aria-hidden="true"><span style="color: #000;font-size: 15px;">&nbsp;Share</span></i></a>
                            </li>
                            <li>
                                <a href="#"><i style="color: #CE2029; font-size: 25px;" class="fa fa-pinterest" aria-hidden="true"><span style="color: #000;font-size: 15px;">&nbsp;Shave</span></i></a>
                            </li>
                            <li>
                                <a href="#"><i style="font-size: 25px;" class="fa fa-twitter" aria-hidden="true"><span style="color: #000;font-size: 15px;">&nbsp;Tweet</span></i></a>
                            </li>
                        </ul>
                    </div><br><hr>
                    <div class="sub-product">
                        <div class="sub-pr-top text-center">
                           <img src="{{asset('aladino-frontend/images/product-view/product-logo.jpg')}}" alt="" class="img-fluid">
                            <h4><a href="#">camelliatune</a></h4>
                            <p>in Wuhan, China</p>
                        </div>
                        <div class="sub-pr-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="clothing-item">
                                        <img src="{{asset('aladino-frontend/img/cS-1.jpg')}}" alt="Item" class="img-fluid">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="clothing-item-bottom">
                                        <p>Lorem ipsum dolor sit amet,....</p>
                                        <p class="clothing-p2">ObviousState</p>
                                        <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                        <p><strong>USD $24.00</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="clothing-item">
                                       <img src="{{asset('aladino-frontend/img/cS-1.jpg')}}" alt="Item" class="img-fluid">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="clothing-item-bottom">
                                        <p>Lorem ipsum dolor sit amet,....</p>
                                        <p class="clothing-p2">ObviousState</p>
                                        <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                        <p><strong>USD $24.00</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="clothing-item">
                                        <img src="{{asset('aladino-frontend/img/cS-1.jpg')}}" alt="Item" class="img-fluid">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="clothing-item-bottom">
                                        <p>Lorem ipsum dolor sit amet,....</p>
                                        <p class="clothing-p2">ObviousState</p>
                                        <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                        <p><strong>USD $24.00</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="clothing-item">
                                        <img src="{{asset('aladino-frontend/img/cS-1.jpg')}}" alt="Item" class="img-fluid">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="clothing-item-bottom">
                                        <p>Lorem ipsum dolor sit amet,....</p>
                                        <p class="clothing-p2">ObviousState</p>
                                        <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                        <p><strong>USD $24.00</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="clothing-item">
                                        <img src="{{asset('aladino-frontend/img/cS-1.jpg')}}" alt="Item" class="img-fluid">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="clothing-item-bottom">
                                        <p>Lorem ipsum dolor sit amet,....</p>
                                        <p class="clothing-p2">ObviousState</p>
                                        <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                        <p><strong>USD $24.00</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="clothing-item">
                                         <img src="{{asset('aladino-frontend/img/cS-1.jpg')}}" alt="Item" class="img-fluid">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="clothing-item-bottom">
                                        <p>Lorem ipsum dolor sit amet,....</p>
                                        <p class="clothing-p2">ObviousState</p>
                                        <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                        <p><strong>USD $24.00</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="clothing-item">
                                        <img src="{{asset('aladino-frontend/img/cS-1.jpg')}}" alt="Item" class="img-fluid">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="clothing-item-bottom">
                                        <p>Lorem ipsum dolor sit amet,....</p>
                                        <p class="clothing-p2">ObviousState</p>
                                        <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                        <p><strong>USD $24.00</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="clothing-item">
                                        <img src="{{asset('aladino-frontend/img/cS-1.jpg')}}" alt="Item" class="img-fluid">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="clothing-item-bottom">
                                        <p>Lorem ipsum dolor sit amet,....</p>
                                        <p class="clothing-p2">ObviousState</p>
                                        <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                        <p><strong>USD $24.00</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="releted-type">
        <div class="container">
            <h5>Related to this item</h5><br>
            <div class="rlt-nav">
                <ul>
                    <li><a href="#">Lorem Lorem</a></li>
                    <li><a href="#">Lorem</a></li>
                    <li><a href="#">Lorem Lorem</a></li>
                    <li><a href="#">Lorem</a></li>
                    <li><a href="#">Lorem Lorem</a></li>
                    <li><a href="#">Lorem</a></li>
                     <li><a href="#">Lorem Lorem</a></li>
                    <li><a href="#">Lorem</a></li>
                    
                    
                </ul><br><br><br>
                <ul>
                    <li><a href="#">Lorem Lorem</a></li>
                    <li><a href="#">Lorem</a></li>
                    <li><a href="#">Lorem Lorem</a></li>
                    <li><a href="#">Lorem</a></li>
                    <li><a href="#">Lorem Lorem</a></li>
                    <li><a href="#">Lorem</a></li>
                    
                </ul>
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
    <script type="text/javascript">
        $(document).ready(function() {
            // Configure/customize these variables.
            var showChar = 100;  // How many characters are shown by default
            var ellipsestext = "...";
            var moretext = "Show more >";
            var lesstext = "Show less";


            $('.more').each(function() {
                var content = $(this).html();

                if(content.length > showChar) {

                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);

                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                    $(this).html(html);
                }

            });

            $(".morelink").click(function(){
                if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().toggle();
                $(this).prev().toggle();
                return false;
            });
        });
    </script>   
</body>

</html>