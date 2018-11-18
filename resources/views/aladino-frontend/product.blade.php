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
       
    <div class="clothing-area">
        <div class="container-fluid">
            <div class="clothing-top">
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li><a href="#">Home > &nbsp;</a></li>
                            <li><a href="#"> clothing & shoes &nbsp;</a></li>
                            <li><a href="#"> (5,480,742 items)</a></li>
                        </ul>
                        <h3>Clothing & Shoes</h3>
                    </div>
                    <div class="col-md-6">
                        <a style="float: right; font-size: 15px;color: #777;font-family: arial;text-transform: capitalize; margin: 15px 50px; text-decoration: none" href="#">Sort by:</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    Clothing-Top-End-->
    <section class="clothing-service">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="step1">
                            <ul>
                                <li><a href="#"><i class="fa fa-arrow-left" aria-hidden="true"> </i>&nbsp; All catagories</a></li>
                                <li><a href="#">Clothing & Shoes</a></li>
                            </ul>
                        </div>
                        <br><br>
                        
                        <div class="step1">
                            <ul><p>Shipping</p>
                                <li><a href="#"><input type="checkbox" aria-label="Checkbox for following text input">&nbsp;Free shipping</a></li>
                                
                                <li><a href="#"><input type="checkbox" aria-label="Checkbox for following text input">&nbsp;Ready to ship in 1 business day</a></li>
                                
                                <li><a href="#"><input type="checkbox" aria-label="Checkbox for following text input">&nbsp;Ready to ship within 3 business days</a></li>
                            </ul>
                        </div>
                        <br>
                        <br>
                        <div class="step1">
                            <ul><p>Special offers</p>
                                <li><a href="#"><input type="checkbox" aria-label="Checkbox for following text input">&nbsp;On sale</a></li>
                            </ul>
                        </div>
                        <br>
                        <br>
                        <div class="step1">
                            <ul><p>Shop location</p>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;Anywhere</a></li>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;Custom</a></li>
                                <div class="input-group mb-3"><br>
                                  <input type="text" class="form-control" placeholder="Enter Location" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                                  </div>
                            </div>
                            </ul>
                        </div>
                        <br>
                        <br>
                        <div class="step1">
                            <ul><p>Item type</p>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;All items</a></li>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;Handmade</a></li>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;Vintage</a></li>
                            </ul>
                        </div>
                        <br><br>
                        <div class="step1">
                            <ul><p>Price ($)</p>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;Any price</a></li>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;Under USD 25</a></li>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;USD 25 to USD 50</a></li>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;USD 50 to USD 100</a></li>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;Over USD 100</a></li>
                                <li><a href="#"><input name="gender" type="radio" aria-label="Radio button for following text input">&nbsp;Custom</a></li><br>
                                <input style="width: 60px;font-size: 15px;padding: 10px;" type="text" placeholder="High"> To <input style="width: 50px;font-size: 15px;padding: 10px;" type="text" placeholder="low">
                            </ul>
                        </div>
                        <br><br>
                        <div class="step1">
                            <ul><p>Ordering options</p>
                               <li><a href="#"><input type="checkbox" aria-label="Checkbox for following text input">&nbsp;Accepts Etsy gift cards</a></li>
                               <li><a href="#"><input type="checkbox" aria-label="Checkbox for following text input">&nbsp;Customizable</a></li>
                               <li><a href="#"><input type="checkbox" aria-label="Checkbox for following text input">&nbsp;Can be gift-wrapped</a></li>
                            </ul>
                        </div>
                        <br><br>
                        <div class="step1">
                            <div class="dropdown show">
                              <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Bangladesh
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Bangladesh</a>
                                <a class="dropdown-item" href="#">India</a>
                                <a class="dropdown-item" href="#">USA</a>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                            <div class="clothing-item-bottom">
                                <p>Lorem ipsum dolor sit amet,....</p>
                                <p class="clothing-p2">ObviousState</p>
                                <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                <p><strong>USD $24.00</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                            <div class="clothing-item-bottom">
                                <p>Lorem ipsum dolor sit amet,....</p>
                                <p class="clothing-p2">ObviousState</p>
                                <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                <p><strong>USD $24.00</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                            <div class="clothing-item-bottom">
                                <p>Lorem ipsum dolor sit amet,....</p>
                                <p class="clothing-p2">ObviousState</p>
                                <p class="clothing-p3">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; <span>(4018)</span></p>
                                <p><strong>USD $24.00</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="clothing-item">
                              <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                        <div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                              <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                              <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                 <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                 <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                 <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                                <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                            
                        </div><div class="col-md-3">
                            <div class="clothing-item">
                               <img src="{{asset('aladino-frontend/images/Clothing/1.jpg')}}" alt="Item" class="img-fluid">
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
                        <nav aria-label="...">
                          <ul class="pagination">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active">
                              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1">3</a>
                            </li>
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1">4</a>
                            </li>
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1">5</a>
                            </li>
                            
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#">Next</a>
                            </li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <hr>
    <br><br>
    
    <section class="recently">
        <div class="container-fluid">
           <h3>Recently viewed</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="clothing-item">
                        <img src="{{asset('aladino-frontend/images/Clothing/2.jpg')}}" alt="Item" class="img-fluid">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </div>
                    <div class="clothing-item-bottom">
                        <p>Lorem ipsum dolor sit amet,....</p>
                        <p class="clothing-p2">ObviousState</p>
                        <p><strong>USD $24.00</strong></p>
                    </div>
                    <br>
                    <br>

                </div>
                <div class="col-md-3">
                    <div class="clothing-item">
                        <img src="{{asset('aladino-frontend/images/Clothing/3.jpg')}}" alt="Item" class="img-fluid">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </div>
                    <div class="clothing-item-bottom">
                        <p>Lorem ipsum dolor sit amet,....</p>
                        <p class="clothing-p2">ObviousState</p>
                        <p><strong>USD $24.00</strong></p>
                    </div>
                    <br>
                    <br>

                </div>
            </div>
        </div>
    </section>
    <br><br><hr>

    
    
    
    
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
                    
                            <li><h6>Follow Aladino</h6></li>
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
            <a class="" href="#">© 2018 Aladino.Lt.</a>
        </div>
    </div>   
</body>

</html>