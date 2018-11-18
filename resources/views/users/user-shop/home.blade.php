@extends('users.layout')
@section('page_style')
<link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />
@endsection

@section('row_style')
<style type="text/css">

</style>
@endsection

@section('content')

<!-- mobile device menu -->
<div id="menu_area" class="menu-area d-block d-md-none">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-light navbar-expand-lg mainmenu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="active"><a href="#">Women’s Clothing</a></li>
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown2</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown3</a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">Service</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<!-- mobile device menu -->
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3" style="margin: 0; padding: 0; padding-left: 5%">
            <div class="ctm-hr1"></div>
            <div class="vertical-menu d-none d-md-block">
                <div class="vertical-menu-title">
                    <span><i class="fa fa-bars"></i> Categories</span>
                </div>
                <nav>
                    <ul class="mcd-menu">
                        <?php
                        $mainMenu = DB::table('menu_categories')->get();
                        foreach ($mainMenu as $key => $value) {

                            $sub = DB::table('menu_sub_categories')->where('category_id',$value->id)->get();
                            ?>
                            <li>
                                <a href="#">
                                    <div class="vertical-m-icon">
                                        <img src="{{asset('users/assets/img/home/woman-tshart.png') }}" class="img-fluid" alt="Responsive image">
                                    </div>
                                    {{$value->category_name}}

                                    <?php if($sub->count()){ ?>
                                        <span class="vm-icon"><i class="fa fa-angle-right"></i></span>  
                                    <?php } ?>
                                </a>
                                <?php

                                if($sub->count()){
                                    ?>
                                    <ul class="vertical-submenu">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <?php
                                                    $nn = 0;
                                                    foreach ($sub as $key => $sub_cat) {
                                                        $nn++;
                                                        ?>
                                                        <div class="col-md-4 vertical-submenu-list">

                                                            <?php if($nn == 1) { ?>

                                                                <div class="mm-arrow"></div>
                                                            <?php } ?>

                                                            <span>{{$sub_cat->sub_category_name}}</span>

                                                            <ol>
                                                                <?php
                                                                $tri_sub = DB::table('menu_tri_sub_categories')->where('sub_category_id',$sub_cat->id)->get();
                                                                if($tri_sub){
                                                                    foreach ($tri_sub as $key => $tri_sub_cat) {

                                                                        ?>
                                                                        <li><a href="{{url('user_product',$tri_sub_cat->id)}}">{{$tri_sub_cat->tri_sub_category_name}}</a></li>
                                                                    <?php } } ?>
                                                                </ol>

                                                            </div>
                                                        <?php } ?>

                                                    </div>

                                                </div>
                                            </div>
                                        </ul>

                                    <?php } ?>
                                </li>


                            <?php }  ?>        

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="row">
                    <div class="col-md-12" style="margin: 0; padding: 0; padding-right: 80px;">
                        <div class="ctm-hr2"></div>
                        <div id="menu-wrapper">

                            <ul class="nav-2nd">
                                <li>
                                    <a href="#">What's new <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4 nav-column">

                                                        <h3>Hot Categories</h3>
                                                        <ul>
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Jackets & Coats</a></li>
                                                            <li><a href="#">Sweaters</a></li>
                                                            <li><a href="#">Jeans</a></li>
                                                            <li><a href="#">Suits & Sets</a></li>
                                                            <li><a href="#">Blouses & Shirts</a></li>
                                                        </ul>
                                                        <h3>Bottoms</h3>
                                                        <ul>
                                                            <li><a href="#">Skirts</a></li>
                                                            <li><a href="#">Leggings</a></li>
                                                            <li><a href="#">Jeans</a></li>
                                                            <li><a href="#">Pants & Capris</a></li>
                                                            <li><a href="#">Wide Leg Pants</a></li>
                                                            <li><a href="#">Shorts</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 nav-column">
                                                        <h3>Outwear & Jackets</h3>
                                                        <ul>
                                                            <li><a href="#">Basic Jackets</a></li>
                                                            <li><a href="#">Real Fur</a></li>
                                                            <li><a href="#">Down Coats</a></li>
                                                            <li><a href="#">Blazers</a></li>
                                                            <li><a href="#">Trench</a></li>
                                                            <li><a href="#">Parkas</a></li>
                                                        </ul>
                                                        <h3>Tops & Sets</h3>
                                                        <ul>
                                                            <li><a href="#">Tank Tops</a></li>
                                                            <li><a href="#">Suits & Sets</a></li>
                                                            <li><a href="#">Jumpsuits</a></li>
                                                            <li><a href="#">Rompers</a></li>
                                                            <li><a href="#">Intimates</a></li>
                                                            <li><a href="#">Sleep & Lounge</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 nav-column">
                                                        <h3>Weddings & Events</h3>
                                                        <ul>
                                                            <li><a href="#">Wedding Dresses</a></li>
                                                            <li><a href="#">Evening Dresses</a></li>
                                                            <li><a href="#">Prom Dresses</a></li>
                                                            <li><a href="#">Bridesmaid Dresses</a></li>
                                                            <li><a href="#">Flower Girl Dresses</a></li>
                                                            <li><a href="#">Cocktail Dresses</a></li>
                                                        </ul>
                                                        <h3>Accessories</h3>
                                                        <ul>
                                                            <li><a href="#">Eyewear & Accessories</a></li>
                                                            <li><a href="#">Hats & Caps</a></li>
                                                            <li><a href="#">Belts & Cummerbunds</a></li>
                                                            <li><a href="#">Scarves & Wraps</a></li>
                                                            <li><a href="#">Gloves & Mittens</a></li>
                                                            <li><a href="#">Prescription Glasses</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">Top rated</a></li>
                                <li>
                                    <a href="#">Earnings <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4 nav-column">

                                                        <h3>Hot Categories</h3>
                                                        <ul>
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Jackets & Coats</a></li>
                                                            <li><a href="#">Sweaters</a></li>
                                                            <li><a href="#">Jeans</a></li>
                                                            <li><a href="#">Suits & Sets</a></li>
                                                            <li><a href="#">Blouses & Shirts</a></li>
                                                        </ul>
                                                        <h3>Bottoms</h3>
                                                        <ul>
                                                            <li><a href="#">Skirts</a></li>
                                                            <li><a href="#">Leggings</a></li>
                                                            <li><a href="#">Jeans</a></li>
                                                            <li><a href="#">Pants & Capris</a></li>
                                                            <li><a href="#">Wide Leg Pants</a></li>
                                                            <li><a href="#">Shorts</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 nav-column">
                                                        <h3>Outwear & Jackets</h3>
                                                        <ul>
                                                            <li><a href="#">Basic Jackets</a></li>
                                                            <li><a href="#">Real Fur</a></li>
                                                            <li><a href="#">Down Coats</a></li>
                                                            <li><a href="#">Blazers</a></li>
                                                            <li><a href="#">Trench</a></li>
                                                            <li><a href="#">Parkas</a></li>
                                                        </ul>
                                                        <h3>Tops & Sets</h3>
                                                        <ul>
                                                            <li><a href="#">Tank Tops</a></li>
                                                            <li><a href="#">Suits & Sets</a></li>
                                                            <li><a href="#">Jumpsuits</a></li>
                                                            <li><a href="#">Rompers</a></li>
                                                            <li><a href="#">Intimates</a></li>
                                                            <li><a href="#">Sleep & Lounge</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 nav-column">
                                                        <h3>Weddings & Events</h3>
                                                        <ul>
                                                            <li><a href="#">Wedding Dresses</a></li>
                                                            <li><a href="#">Evening Dresses</a></li>
                                                            <li><a href="#">Prom Dresses</a></li>
                                                            <li><a href="#">Bridesmaid Dresses</a></li>
                                                            <li><a href="#">Flower Girl Dresses</a></li>
                                                            <li><a href="#">Cocktail Dresses</a></li>
                                                        </ul>
                                                        <h3>Accessories</h3>
                                                        <ul>
                                                            <li><a href="#">Eyewear & Accessories</a></li>
                                                            <li><a href="#">Hats & Caps</a></li>
                                                            <li><a href="#">Belts & Cummerbunds</a></li>
                                                            <li><a href="#">Scarves & Wraps</a></li>
                                                            <li><a href="#">Gloves & Mittens</a></li>
                                                            <li><a href="#">Prescription Glasses</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">Rings</a></li>
                                <li><a href="#">Bracelets</a></li>
                                <li><a href="#">All Categories</a></li> 
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 mm-section" style="margin: 0; padding: 0; margin-top: 10px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="MiddleCarousel" class="carousel slide UACarousel" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#MiddleCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#MiddleCarousel" data-slide-to="1"></li>
                                    <li data-target="#MiddleCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{asset('users/assets/img/home/1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset('users/assets/img/home/2.jpg') }}" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset('users/assets/img/home/3.jpg') }}" alt="Second slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev align-middle" href="#MiddleCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#MiddleCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4 d-none d-md-block" style="margin: 0; padding: 0; padding-right: 7%; margin-top: 10px;">
                    <div style="width: 100%; height: 100%;" class="mm-section">
                        <img src="{{asset('users/assets/img/home/demo.JPG') }}" class="img-fluid">
                        <div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="padding-right: 8%;">
                    <div class="row home-single">
                        <div class="col-md-2 single-pro-box">
                            <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button>
                            <a href="#">
                                <img src="{{asset('users/assets/img/userProfile/pro1.jpg') }}" class="img-fluid" alt="image">
                                <div class="sgl-pro-t">
                                    I Do Want I Want Toddler Life ...
                                </div>
                                <div class="sgl-pro-s-n">
                                    DesiraesCloset
                                </div>
                                <div class="sgl-pro-p">£13.41</div>
                            </a>
                        </div>
                        <div class="col-md-2 single-pro-box">
                            <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button>
                            <a href="#">
                                <img src="{{asset('users/assets/img/userProfile/pro1.jpg') }}" class="img-fluid" alt="image">
                                <div class="sgl-pro-t">
                                    I Do Want I Want Toddler Life ...
                                </div>
                                <div class="sgl-pro-s-n">
                                    DesiraesCloset
                                </div>
                                <div class="sgl-pro-p">£13.41</div>
                            </a>
                        </div>
                        <div class="col-md-2 single-pro-box">
                            <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button>
                            <a href="#">
                                <img src="{{asset('users/assets/img/userProfile/pro1.jpg') }}" class="img-fluid" alt="image">
                                <div class="sgl-pro-t">
                                    I Do Want I Want Toddler Life ...
                                </div>
                                <div class="sgl-pro-s-n">
                                    DesiraesCloset
                                </div>
                                <div class="sgl-pro-p">£13.41</div>
                            </a>
                        </div>
                        <div class="col-md-2 single-pro-box">
                            <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button>
                            <a href="#">
                                <img src="{{asset('users/assets/img/userProfile/pro1.jpg') }}" class="img-fluid" alt="image">
                                <div class="sgl-pro-t">
                                    I Do Want I Want Toddler Life ...
                                </div>
                                <div class="sgl-pro-s-n">
                                    DesiraesCloset
                                </div>
                                <div class="sgl-pro-p">£13.41</div>
                            </a>
                        </div>
                        <div class="col-md-2 single-pro-box">
                            <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button>
                            <a href="#">
                                <img src="{{asset('users/assets/img/userProfile/pro1.jpg') }}" class="img-fluid" alt="image">
                                <div class="sgl-pro-t">
                                    I Do Want I Want Toddler Life ...
                                </div>
                                <div class="sgl-pro-s-n">
                                    DesiraesCloset
                                </div>
                                <div class="sgl-pro-p">£13.41</div>
                            </a>
                        </div>
                        <div class="col-md-2 single-pro-box">
                            <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button>
                            <a href="#">
                                <img src="{{asset('users/assets/img/userProfile/pro1.jpg') }}" class="img-fluid" alt="image">
                                <div class="sgl-pro-t">
                                    I Do Want I Want Toddler Life ...
                                </div>
                                <div class="sgl-pro-s-n">
                                    DesiraesCloset
                                </div>
                                <div class="sgl-pro-p">£13.41</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('page_level')
        <script src="{{asset('users/assets/vendors/summernote/dist/summernote.min.js')}}"></script>
        <script src="{{asset('users/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>
        @endsection

        @section('core_script')
        <script>
            $(function(){
                $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
                    if (!$(this).next().hasClass('show')) {
                        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                    }
                    var $subMenu = $(this).next(".dropdown-menu");
                    $subMenu.toggleClass('show');

                    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                        $('.dropdown-submenu .show').removeClass("show");
                    });

                    return false;
                });

                $(".vertical-menu nav ul > li").hover(function() {
                    var index = $(".vertical-menu nav ul > li").index(this);
                    var top = "-" + (index * 37.97) + "px";
                    var top2 = (index * 37.97) + "px";
                    $(".vertical-menu nav ul > li > .vertical-submenu").css({'top': top});
                    $(".vertical-menu nav ul > li > .vertical-submenu .mm-arrow").css({'top': top2});
                });



                $(".single-pro-box .love-icn").click(function() {
                    if($(this).find('i').attr('class') == 'la la-heart-o') {
                        $(this).find('i').attr('class', 'fa fa-heart');
                        $(this).find('i').css({'color': "red"});
                    } else {
                        $(this).find('i').attr('class', 'la la-heart-o');
                        $(this).find('i').css({'color': "black"});
                    }
                });
            });
        </script>
        @endsection



