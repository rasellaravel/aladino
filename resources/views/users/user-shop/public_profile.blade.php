@extends('users.layout')
@section('page_style')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href="{{asset('users/skdslider/src/skdslider.css')}}" rel="stylesheet">
@endsection

@section('row_style')
<style type="text/css">
    .nav-section{
      width: 100%;
     
   }
   .nav-section .nav{
      background: #1e268a38;
      padding: 10px 0px;
      position: absolute;
      width: 100%;
      z-index: 99;

   }
   .nav li{
          list-style-type: none;
          display: inline-block;
          padding-right: 30px;
          padding-top: 9px;
          text-align: center;
          color: black;
          font-size: 15px;
   }

   .box{

   }
   .popular-item{

   }
   .single-pro-box {
    padding: 7px;
    border-radius: 5px;
    margin-bottom: 25px;
}

.single-pro-box:hover {

    background: white;
    -webkit-box-shadow: 0px 0px 15px -1px rgb(242, 243, 250);
    -moz-box-shadow: 0px 0px 15px -1px rgb(242, 243, 250);
    box-shadow: 0px 0px 15px -1px rgb(242, 243, 250);
    transition: all .25s;
}

.single-pro-box a {
    color: black;
}

.single-pro-box .love-icn {
    position: absolute;
    background: white;
    z-index: 222222;
    right: 10px;
    top: 10px;
    display: none;
}

.single-pro-box:hover .love-icn {
    transition: all .25s;
    display: block;
}

.single-pro-box .sgl-pro-t {
    font-size: 12px;
    padding-top: 10px;
    width: 100%;
}

.single-pro-box .sgl-pro-s-n {
    font-size: 12px;
    width: 100%;
    color: #595959;
}

.single-pro-box .sgl-pro-rtg {
    width: 100%;
}

.single-pro-box .sgl-pro-rtg .star-rating {
    font-size: 15px;
}

.single-pro-box .fa-star {
    color: black;
}

.single-pro-box .sgl-pro-rtg .rat-cnt {
    font-size: 12px;
    color: #595959;
    position: relative;
    top: 8px;
    left: 5px;
}

.single-pro-box .sgl-pro-p {
    width: 100%;
    margin-top: 15px;
    font-weight: bold;
    padding-bottom: 5px;
}

.single-pro-box .sgl-pro-s-i {
    font-size: 12px;
    width: 100%;
    border-top: 1px solid rgb(242, 243, 250);
    padding: 5px 0 5px 5px;
    position: absolute;
    z-index: 90;
    left: 0;
    background: white;
    display: none;
/*    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    -webkit-box-shadow: 0px 6px 15px -1px rgba(128,123,128,1);
    -moz-box-shadow: 0px 6px 15px -1px rgba(128,123,128,1);
    box-shadow: 0px 6px 15px -1px rgba(128,123,128,1);
    color: #595959;*/
}

.single-pro-box .sgl-pro-s-i i {
    padding-left: 5px;
    transition: all .25s;
}

.single-pro-box .sgl-pro-s-i:hover i {
    padding-left: 10px;
}

.single-pro-box:hover .sgl-pro-s-i {
    display: block;
}

</style>

@endsection


@section('content')
<!-- banner -->
<?php
    if($shop_id){
        $public_profile_info = DB::table('shops')->where('id',$shop_id)->first();
    }
    if($public_profile_info){
        if($public_profile_info->banner){
?>

<img src="{{asset('users/shop/'.$public_profile_info->banner)}}">
<?php }else { ?>    
<!-- end banner -->
<!-- Start Slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
  <?php
    $find_slider = DB::table('shop_carousels')->where('shop_id',$shop_id)->get();
    if($find_slider){
        $i = 0;
        foreach ($find_slider as $key => $slider) {
                                $i++;
  ?>
    <div class="carousel-item <?php if($i==1){echo 'active';}?>">
      <img class="d-block w-100" src="{{asset('users/shop/'.$slider->image)}}" alt="First slide">
    </div>
 <?php } } ?>

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
<?php } } ?>

    <!-- End slider -->
<input type="text" name="selected_custom_category" id="selected_custom_category" value="">
    <!-- Start profile section -->
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-2">
                <img src="{{asset('users/shop/'.$public_profile_info->image)}}" class="img-fluid">
            </div>
            <div class="col-md-7">
                <h3>{{$public_profile_info->shop_name}}</h3>
                <p style="line-height: 14px;"> <i class="fas fa-map-marker-alt" style="margin-right: 4px;"></i>{{$public_profile_info->shop_title}}</p>
                <p> {{$public_profile_info->address}} <span style="opacity: 0.2">|</span> 0 Sales <span style="opacity: 0.2">|</span> On Aladino since 
                    <?php 
                        $makeTime = strtotime($public_profile_info->created_at);
                        echo date('Y',$makeTime);
                    ?>
                </p>
                <p style="line-height: 0px;">
                <i class="fas fa-star" style="color: #FFA300"></i>
                <i class="fas fa-star" style="color: #FFA300"></i>
                <i class="fas fa-star" style="color: #FFA300"></i>
                <i class="fas fa-star" style="color: #FFA300"></i>
                <i class="fas fa-star" style="color: #FFA300"></i>
                (0)
                </p>

                <p>
                    <button class="btn btn-gradient-blue-pink btn-fix">
                        <span class="btn-icon"><i class="la la-heart-o"></i>Favourite Shop (0)</span>
                    </button>
                    <button class="btn btn-soc-facebook btn-fix">
                        <span class="btn-icon"><i class="fab fa-facebook"></i>Facebook</span>
                    </button>
                    <button class="btn btn-soc-pinterest btn-fix">
                        <span class="btn-icon"><i class="fab fa-pinterest-p"></i>Pinterest</span>
                    </button>
                    <button class="btn btn-soc-twitter btn-fix">
                        <span class="btn-icon"><i class="fab fa-twitter"></i>Twitter</span>
                    </button>
                </p>
            </div>
            <div class="col-md-3 text-center">
                <p>SHOP OWNER</p>
                <?php
                    $profile_image = DB::table('users')->where('id',$public_profile_info->user_id)->first();
                ?>
                <img src="{{asset('users/profile_image/'.$profile_image->image)}}" class="img-fluid rounded-circle" style="height: 74px; width: 74px;">
                <p style="margin-bottom: 3px;">{{$profile_image->name}}</p>
                <p><i class="la la-comments" style="color: #FFA300;"></i> Contact</p>
            </div>
        </div>
    </div>


    <!-- End profile section -->

    <!-- start navbar -->


<section class="nav-section" style="margin-top: 50px;">
   <div class="nav" id="nav">
       <div class="container">
            <ul>
             <a href=""><li>Items (513)</li></a>
             <a href=""><li>Reviews</li></a>
             <a href="#about"><li>About</li></a>
             <a href="#policies"><li>Policies</li></a>
             <a href="#more"><li>More</li></a>
             <li style="float: right;"> <div class="input-group-icon input-group-icon-left">
                    <span class="input-icon input-icon-left"><i class="fas fa-search"></i></span>
                    <input class="form-control form-control-rounded" type="text" placeholder="Search...." style="margin-top:-5px;">
                </div>
            </li>
          </ul>
       </div>
   </div> 
</section>
<section class="box" style="margin-top: 40px;">
     <div class="container">
       <div class="row">

       <?php
        $special_product = DB::table('user_products')->where('shop_id',$shop_id)->where('special_product',1)->orderBy('id','DESC')->take(4)->get();
        if($special_product){
            foreach ($special_product as $key => $special_product) {
       ?>

           <div class="col-md-3 single-pro-box" style="float: left;">
           <!--  <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button> -->
            <a href="{{url('product_view',$special_product->id)}}">
                <img src="{{asset('users/product-image/'.$special_product->image)}}" class="img-fluid" alt="image">
                <div class="sgl-pro-t">
                    <?php echo substr($special_product->product_title,0,40);?>
                                ...
                </div>
                <div class="sgl-pro-s-n">
                    {{$public_profile_info->shop_name}}
                </div>
                <div class="sgl-pro-rtg">
<!-- 
                    <div class="star-rating">
                        <span class="fa fa-star-o" data-rating="1"></span>
                        <span class="fa fa-star-o" data-rating="2"></span>
                        <span class="fa fa-star-o" data-rating="3"></span>
                        <span class="fa fa-star-o" data-rating="4"></span>
                        <span class="fa fa-star-o" data-rating="5"></span>
                        <input type="hidden" name="whatever1" class="rating-value" value="5">
                    </div>
                    <div class="rat-cnt"> (0)</div> -->
                </div>
                <div class="sgl-pro-p">US {{$special_product->price}}</div>
               <!--  <div class="sgl-pro-s-i">
                    See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div> -->
            </a>
        </div>

        <?php } } ?>
        




       </div>
   </div>
</section>

<section class="" style="margin-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p><b>Announcement</b></p>
                <p style="line-height: 0px;">Last updated on 
                <?php 
                if($public_profile_info->update_date){
                   $update_date = strtotime($public_profile_info->update_date);
                   echo date('d M Y',$update_date); 
                }
                ?>

                </p>
            </div>
            <div class="col-md-9">
                <p>{!! $public_profile_info->announcement !!} <!-- <a href="" style="color:red">Read More</a> --></p>
            </div>
        </div>
    </div>
</section>

<section class="" style="margin-top: 40px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="text-left">
                 <h3> Items </h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                     <div class="form-group mb-4">
                          <label></label>
                          <select class="form-control" name="product_filter" id="product_filter">
                          <option  selected value> Sort: Custom</option>
                          <option value="height_price">Height Price</option>
                          <option value="lowest_price">Lowest Price</option>
                          </select>
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-3" style="padding: 0px;">
                <ul class="list-group">
                  <a href="" class="find_product_by_category" id="all"><li class="list-group-item d-flex justify-content-between align-items-center">
                    All

                     <?php
                        $all_product = DB::table('user_products')->where('shop_id',$shop_id)->count();
                    ?>
                    <span class="badge badge-primary badge-pill">
                        <?php
                            if($all_product){
                                echo $all_product;
                            }else{
                                echo '0';
                            }
                        ?>
                    </span>
                  </li></a>
                  <?php
                    $custom_category = DB::table('custom_categories')->where('shop_id',$shop_id)->orderBy('id','DESC')->get();
                    if($custom_category){
                        foreach ($custom_category as $key => $custom_category) {

                  ?>
                  <a href="" class="find_product_by_category" id="<?php echo $custom_category->id;?>"> <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$custom_category->category}}
                    <?php
                        $product_count = 0;
                        $product_count = DB::table('user_products')->where('custom_category',$custom_category->id)->count();
                    ?>
                    <span class="badge badge-primary badge-pill">
                        <?php
                            
                                echo $product_count;
                      
                        ?>
                    </span>
                  </li>
                  </a>
                  <?php } } ?>

                   
                </ul>

                <div class="custom-order">
                    <button class="btn btn-gradient-purple btn-fix" style="width: 100%; margin-bottom: 10px;">
                        <span class="btn-icon"><i class="ti-gift"></i>Request Custom Order</span>
                    </button>
                    <button class="btn btn-gradient-blue-pink btn-fix" style="width: 100%">
                        <span class="btn-icon"><i class="ti-comments"></i>Contact Shop Onwer</span>
                    </button>
                </div>
            </div>
            <div class="col-md-9" id="custom_category_called_data"> 
                <div class="inital_all_item">
                <?php
                    $inital_product = DB::table('user_products')->where('shop_id',$shop_id)->get();
                    if($inital_product){
                        foreach ($inital_product as $key => $inital_product) {
                   ?>

                       <div class="col-md-3 single-pro-box" style="float: left;">
                       <!--  <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button> -->
                        <a href="{{url('product_view',$inital_product->id)}}">
                            <img src="{{asset('users/product-image/'.$inital_product->image)}}" class="img-fluid" alt="image">
                            <div class="sgl-pro-t">
                                <?php echo substr($inital_product->product_title,0,40);?>
                                            ...
                            </div>
                            <div class="sgl-pro-s-n">
                                {{$public_profile_info->shop_name}}
                            </div>
                            <div class="sgl-pro-rtg">
            <!-- 
                                <div class="star-rating">
                                    <span class="fa fa-star-o" data-rating="1"></span>
                                    <span class="fa fa-star-o" data-rating="2"></span>
                                    <span class="fa fa-star-o" data-rating="3"></span>
                                    <span class="fa fa-star-o" data-rating="4"></span>
                                    <span class="fa fa-star-o" data-rating="5"></span>
                                    <input type="hidden" name="whatever1" class="rating-value" value="5">
                                </div>
                                <div class="rat-cnt"> (0)</div> -->
                            </div>
                            <div class="sgl-pro-p">US {{$inital_product->price}}</div>
                           <!--  <div class="sgl-pro-s-i">
                                See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </div> -->
                        </a>
                    </div>

                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="about">
    <div class="container">
    <hr>
        <div class="row" style="margin-top: 70px; margin-bottom: 30px">
            <div class="col-md-3">
                <h4>About</h4>
            </div>
            <div class="col-md-9">
                {!! $public_profile_info->about_shop!!}
            </div>
        </div>

    </div>
</section>

<section id="policies">
    <div class="container">
    <hr>
        <div class="row" style="margin-top: 70px; margin-bottom: 30px">
            <div class="col-md-3">
                <h4>Policies</h4>
            </div>
            <div class="col-md-9">
                {!! $public_profile_info->police!!}
            </div>
        </div>

    </div>
</section>

<section id="more">
    <div class="container">
    <hr>
        <div class="row" style="margin-top: 70px; margin-bottom: 30px">
            <div class="col-md-3">
                <h4>More</h4>
            </div>
            <div class="col-md-9">
                {!! $public_profile_info->more!!}
            </div>
        </div>

    </div>
</section>





    <!-- end navbar -->

@endsection
@section('page_level')
<script src="{{asset('users/skdslider/src/skdslider.min.js')}}"></script>
@endsection

@section('core_script')
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#demo1').skdslider({
          slideSelector: '.slide',
          delay:5000,
          animationSpeed:2000,
          showNextPrev:true,
          showPlayButton:true,
          autoSlide:true,
          animationType:'fading'
        });

        
    });
</script>
<script type="text/javascript">
    
     var nav = document.getElementById('nav');

       window.onscroll = function () {

         if(window.pageYOffset > 690){

          nav.style.position = "fixed";
          nav.style.top = 0;
          nav.style.background = "#656dd0";

          }else{
            // nav.style.position = "absolute";
            nav.style.position = 'relative'; //fixed
            nav.style.top = 100;
            nav.style.background = "";

          }
       }


</script>
<script type="text/javascript">
    $(function() {

        var $star_rating = $('.star-rating .fa');

        var SetRatingStar = function() {
            return $star_rating.each(function() {
                if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                    return $(this).removeClass('fa-star-o').addClass('fa-star');
                } else {
                    return $(this).removeClass('fa-star').addClass('fa-star-o');
                }
            });
        };

        SetRatingStar();

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

<!-- '''''''''''''''''''''product getting by category'''''''''''''''''' -->
<script type="text/javascript">
 $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

  $(document).ready(function(){
    $('.find_product_by_category').click(function(event){
      var category_id = $(this).attr('id');
      $('#selected_custom_category').val(category_id);
       $.ajax({
            type:'POST',
            url:'{{url("view_shop_product_by_category")}}',
            data: {category_id:category_id,shop_id:<?php echo $shop_id;?>},
            success:function(response){
              $("#product_filter option:selected").prop("selected", false);
                $('#custom_category_called_data').html(response);    
            }
        });

      return false;
    });
  });



  $(document).ready(function(){
    $('#product_filter').change(function(event){
      var filter_value = $(this).val();
      var category_id = $('#selected_custom_category').val();
       $.ajax({
            type:'POST',
            url:'{{url("public_shop_product_filter")}}',
            data: {filter_value:filter_value,category_id:category_id,shop_id:<?php echo $shop_id;?>},
            success:function(response){
                // $('#custom_category_called_data').html(response);
                $('#custom_category_called_data').html(response);
                console.log(response);
                
            }
        });

      return false;
    });
  });

</script>

@endsection



