@extends('users.layout')
@section('page_style')
<link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/css/easyzoom.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/css/lightslider.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.1/photoswipe.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.1/default-skin/default-skin.min.css" />
@endsection

@section('row_style')
<style type="text/css">

</style>
@endsection

@section('content')
<?php
    $singleProduct = DB::table('user_products')->where('id',$id)->first();
    if($singleProduct){
        $shop_name = DB::table('shops')->where('id',$singleProduct->shop_id)->first();
    }
?>
<div class="row" style="padding: 0 5%; margin-top: 10px;">
    <div class="col-md-6" style="background: white; padding: 0;">
        <div class="pro_view_shop_img">
            <img src="{{asset('users/shop/'.$shop_name->image) }}" class="img-fluid" alt="Responsive image">
        </div>
        <div class="pro_view_shop_title">
            <div>
                <a href="{{url('shop-public-profile',$singleProduct->shop_id)}}">
                    @if($shop_name)
                        {{$shop_name->shop_name}}
                    @endif
                </a>
            </div>
            <button class="btn btn-info btn-fix">
                <span class="btn-icon"><i class="ti-heart"></i>Favourite Shop</span>
            </button>
        </div>
    </div>
    <div class="col-md-6" style="background: white; padding: 0;">
        <div class="pro_view_shop_product pull-right">
        <?php
            $shop_top_product =DB::table('user_products')->where('shop_id',$singleProduct->shop_id)->orderBy('id','DESC')->take(4)->get();
            $shopTotalProduct =DB::table('user_products')->where('shop_id',$singleProduct->shop_id)->count();
            if($shop_top_product){
                foreach ($shop_top_product as $key => $shop_top_product) {
                    # code...
        ?>
            <div class="pro_view_pro_s">
                <img src="{{asset('users/product-image/'.$shop_top_product->image) }}" alt="image" class="img-thumbnail">
            </div>
            <?php } } ?>
           <a href="{{url('shop-public-profile',$singleProduct->shop_id)}}"> <div class="pro_view_s_more">
                <div>
                    <span>{{$shopTotalProduct}}</span> Item
                </div>
            </div>
            </a>
        </div>
    </div>
</div>

<div class="row" style="padding: 0 5%; margin-top: 10px;">
    <div class="col-md-6" style="background: white; border-right: 1px solid #EEE;">
        <div class="row">

            <div class="col-md-12">
                <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery" style="display: none;">
                     <?php
                        $samePriceImage = DB::table('same_prices')->where('product_id',$id)->get();
                        $i=0; 
                    ?>
                    @foreach($samePriceImage as $samePriceImageName)
                    <?php $i++;?>

                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="{{asset('users/product-image/'.$samePriceImageName->img)}}" itemprop="contentUrl" data-size="964x1024" class="img-z-v-<?php echo $i;?>">
                            <img src="{{asset('users/product-image/'.$samePriceImageName->img)}}" />
                        </a>
                    </figure>
                    @endforeach  

             
                </div>



                <!-- Root element of PhotoSwipe. Must have class pswp. -->
                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                 <!-- Background of PhotoSwipe. 
                    It's a separate element, as animating opacity is faster than rgba(). -->
                    <div class="pswp__bg"></div>

                    <!-- Slides wrapper with overflow:hidden. -->
                    <div class="pswp__scroll-wrap">

                        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
                        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
                        <div class="pswp__container">
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                        </div>

                        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                        <div class="pswp__ui pswp__ui--hidden">

                            <div class="pswp__top-bar">

                                <!--  Controls are self-explanatory. Order can be changed. -->

                                <div class="pswp__counter"></div>

                                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                                <button class="pswp__button pswp__button--share" title="Share"></button>

                                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                                <!-- element will get class pswp__preloader--active when preloader is running -->
                                <div class="pswp__preloader">
                                    <div class="pswp__preloader__icn">
                                        <div class="pswp__preloader__cut">
                                            <div class="pswp__preloader__donut"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                <div class="pswp__share-tooltip"></div> 
                            </div>

                            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                            </button>

                            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                            </button>

                            <div class="pswp__caption">
                                <div class="pswp__caption__center"></div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                    <i class="la la-search-plus z-icon" onclick="showModalImage(1)"></i>
                    <a href="{{asset('users/product-image/'.$singleProduct->image)}}">
                        <img src="{{asset('users/product-image/'.$singleProduct->image)}}" alt="" style="width: 100%;" />
                    </a>
                </div>


            </div>
            <div class="col-md-12">
                <ul id="content-slider" class="content-slider thumbnails">

                <?php
                    $samePriceImage = DB::table('same_prices')->where('product_id',$id)->get();
                    $i=0; 
                ?>
                @foreach($samePriceImage as $samePriceImage)
                <?php $i++;?>
                    <li>
                        <a href="{{asset('users/product-image/'.$samePriceImage->img)}}" data-standard="{{asset('users/product-image/'.$samePriceImage->img)}}" onclick="cngModalF(<?php echo $i;?>)">
                            <img src="{{asset('users/product-image/'.$samePriceImage->img)}}" alt="" />
                        </a>
                    </li>
                 @endforeach   
                </ul>

            </div>
        </div>
    </div>

    
    <div class="col-md-6" style="background: white;">
    <form method="post" id="add_to_cart">
        <input type="hidden" name="shop_id" value="{{$singleProduct->shop_id}}">
        <input type="hidden" name="user_id" value="{{$singleProduct->user_id}}">
        <div class="row">
            <div class="col-md-12 pro-title">
                {{$singleProduct->product_title}}
            </div>
            <div class="col-md-12 pro-review">
                <div class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="whatever1" class="rating-value" value="4.26">
                </div>
                <div class="rating-value-view">
                    0.0
                </div>
                <div class="rating-vote">
                    (0 votes)
                </div>
                <div class="order">
                    0 Order
                </div>
            </div>
            <input type="hidden" name="product_id" value="{{$singleProduct->id}}">
            <div class="col-md-12">
                <table style="margin-top: 10px" class="mm-pro-details">
                    <tr>
                        <td style="width: 100px;">Price : </td>
                        <td>
                            <div class="pro-price-p">
                                <del>£ <?php echo $singleProduct->price;?>/ piece</del>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Discount Price : </td>
                        <td>
                            <span class="d-price">US 
                            <?php
                                $discount= $singleProduct->price*$singleProduct->discount/100;
                                $discount_price = $singleProduct->price-$discount;
                                echo $discount_price;
                            ?>
                            </span> / piece
                            <span class="d-percent">{{$singleProduct->discount}} %</span>
                            <!-- <span class="d-days">5 days left</span> -->
                        </td>
                    </tr>
                    <tr>
                        <td>Color : </td>
                        <td>

                     <?php
                         $samePriceImage1 = DB::table('same_prices')->where('product_id',$id)->get();
                     ?>
                     @foreach($samePriceImage1 as $samePriceImage)

                            <div class="pro-color-img">
                                <img src="{{asset('users/product-image/'.$samePriceImage->img) }}" class="img-fluid" alt="image">
                            </div>
                      @endforeach     
                        </td>
                    </tr>
                    <tr>
                        <td>Size : </td>
                        <td>
                        <?php

                           $size = explode(',', $singleProduct->size);
                            foreach ($size as $key => $size) {
       
                        ?>
                            <div class="pro-size" style="margin-top: 40px;">
                                <?php echo $size;?>
                            </div>
                           <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Shipping :
                        </td>
                        <td>
                           

                            <div>
                            <?php
                                $found = 0;
                                $location = geoip()->getLocation('45.248.151.251');
                                $location['country'];
                                $shippingCost = 0;
                                $have_shop_id = 0;
                                foreach (Cart::content() as $key => $row) {
                                    if($row->options->shop_id==$singleProduct->shop_id){
                                        $have_shop_id = 1;
                                    }
                                }

                                // if($have_shop_id==1){
                                //     $found = 1;
                                //     echo ' <div class="pro-shipping-t">US 2 to '.$location['country'].' Shipping</div>';
                                //     echo '<input type="hidden" name="shipping_cost" value="1">';
                                // }else{

                                if($singleProduct->shipping_origin==$location['country']){
                                     $found = 1;
                                     if($have_shop_id==1){
                                       
                                        echo '<input type="hidden" name="extra_item" value="1">';
                                     }
                                    echo ' <div class="pro-shipping-t">US '.$singleProduct->origin_cost.' to '.$location['country'].' Shipping</div>';
                                    echo '<input type="hidden" name="shipping_cost" value="'.$singleProduct->origin_cost.'">';
                                }else{
                                    $find_shipping = DB::table('product_shipping_locations')->where('location','like','%'.$location['country'].'%')->first();
                                    if($find_shipping){
                                       $found = 1;
                                        if($have_shop_id==1){
                                       
                                          echo '<input type="hidden" name="extra_item" value="1">';
                                        }
                                       echo ' <div class="pro-shipping-t">US '.$find_shipping->cost.' to '.$location['country'].' Shipping</div>';
                                           echo '<input type="hidden" name="shipping_cost" value="'.$find_shipping->cost.'">';
                                    }
                                }
                                if($found != 1){
                                     echo ' <div class="pro-shipping-t">US '.$singleProduct->everywhere_cost.' to '.$location['country'].' Shipping</div>';
                                     echo '<input type="hidden" name="shipping_cost" value="'.$singleProduct->everywhere_cost.'">';
                                }
                            
                            ?>
                                
                            </div>
                            <input type="hidden" name="shipping_location" value="<?php echo $location['country']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Quantity :
                        </td>
                        <td>
                            <div class="pro-qnty">
                                <input type="number" name="qty" min="1" step="1" value="1">
                            </div>
                            <div class="pro-a-pice">
                              <!--   piece (200 pieces avialable) -->
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <!--  Total Price : -->
                        </td>
                        <td>
                            <div class="pro-t-price">
                                <!-- Depends on the product properties you select -->
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>
                            <div class="pro-sub-btn">
                                <!-- <button class="btn btn-success btn-air">Buy Now</button> -->
                                <button type="submit" class="btn btn-danger btn-air">Add to Cart</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
 
            <div class="col-md-12" style="margin-top: 60px;">
             <hr>
               <!-- <div class="pro_view_shop_img">
                    <img src="{{asset('users/shop/'.$shop_name->image) }}" class="img-fluid" alt="Responsive image">
                </div>
                <div class="pro_view_shop_title">
                    <div>
                        <a href="#">
                            @if($shop_name)
                                {{$shop_name->shop_name}}
                            @endif
                        </a>
                    </div>
                    <button class="btn btn-info btn-fix">
                        <span class="btn-icon"><i class="ti-heart"></i>Favourite Shop</span>
                    </button>
                </div> -->

                <div class="shop_info text-center">
                    <img src="{{asset('users/shop/'.$shop_name->image) }}" class="img-fluid" alt="Responsive image" style="height: 70px; width: 80px;"><br>
                   <a href="{{url('shop-public-profile',$singleProduct->shop_id)}}">
                        @if($shop_name)
                            {{$shop_name->shop_name}}
                        @endif
                    </a>
                    <br>
                     @if($shop_name)
                            {{$shop_name->address}}
                        @endif
                </div>
                <?php
                $take20Product = DB::table('user_products')->where('shop_id',$shop_name->id)->take(20)->get();
                ?>
                 @foreach($take20Product as $UserProduct)
                    <div class="col-md-4 single-pro-box" style="float: left;">
                        <button class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button>
                        <a href="{{url('product_view',$UserProduct->id)}}">
                            <img src="{{asset('users/product-image/'.$UserProduct->image) }}" class="img-fluid" alt="image">
                            <div class="sgl-pro-t">
                                <?php echo substr($UserProduct->product_title,0,40);?>
                                ...

                            </div>
                            <div class="sgl-pro-s-n">
                                <?php
                                    $shopName = DB::table('shops')->where('id',$UserProduct->shop_id)->first();
                                    echo $shopName->shop_name;
                                ?>
                            </div>
                            <div class="sgl-pro-rtg">

                            
                            </div>
                            <div class="sgl-pro-p">£ {{$UserProduct->price}}</div>
                            <!-- <div class="sgl-pro-s-i">
                                See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </div> -->
                        </a>
                    </div>
                @endforeach    

            </div>

        </div>

    </div>
    



</div>
<div class="row" style="padding: 0 5%; margin-top: 50px;">
    <div class="col-md-6" style="background: white; padding: 0;">
    <hr>
    <h5>Description</h5>
    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut 
    </div>
</div>
@endsection
@section('page_level')
<script src="{{asset('users/assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>
<script src="{{asset('users/assets/js/easyzoom.js')}}"></script>
<script src="{{asset('users/assets/js/lightslider.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.1/photoswipe.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.1/photoswipe-ui-default.min.js"></script>
    @endsection

    @section('core_script')
    <script>
    $(function(){

        $("#content-slider").lightSlider({
            loop:true,
            keyPress:true,
            item: 6,
            pager: false
        });

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

        $star_rating.on('click', function() {
            $star_rating.siblings('input.rating-value').val($(this).data('rating'));
            return SetRatingStar();
        });

        SetRatingStar();

        $(".pro-color-img").click(function() {
            $(".pro-color-img").css({'border': 'none'});
            $(this).css({'border': '3px solid #27B0B6'});
        });

        $(".pro-size").click(function() {
            $(".pro-size").css({'border': '1px solid #DDD'});
            $(this).css({'border': '2px solid #27B0B6'});
        });

        $(".pro-ship-f").click(function() {
            $(".pro-ship-f").css({'border': '1px solid #DDD'});
            $(this).css({'border': '2px solid #27B0B6'});
        });

        $('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.pro-qnty input');
        $('.pro-qnty').each(function() {
            var spinner = $(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = input.attr('max');

            btnUp.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue + 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
          });

            btnDown.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue - 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
          });

        });

        var initPhotoSwipeFromDOM = function(gallerySelector) {

        // parse slide data (url, title, size ...) from DOM elements 
        // (children of gallerySelector)
        var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

            for(var i = 0; i < numNodes; i++) {

            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes 
            if(figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };



            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML; 
            }

            if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            } 

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if(!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
        childNodes = clickedListItem.parentNode.childNodes,
        numChildNodes = childNodes.length,
        nodeIndex = 0,
        index;

        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) { 
                continue; 
            }

            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }



        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');  
            if(pair.length < 2) {
                continue;
            }           
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
        gallery,
        options,
        items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                rect = thumbnail.getBoundingClientRect(); 

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }

        };

        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used 
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
};

// execute above function
initPhotoSwipeFromDOM('.my-gallery');
});
var $easyzoom = $('.easyzoom').easyZoom();

// Setup thumbnails example
var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

$('.thumbnails').on('click', 'a', function(e) {
    var $this = $(this);

    e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

function showModalImage(n) {
    $(".img-z-v-" + n).click();
}

function cngModalF(n) {
    $(".z-icon").attr("onclick", "showModalImage(" + n + ")");
}
</script>

<!-- '''''''''''''''''''''Add To Cart'''''''''''''''''' -->
<script type="text/javascript">
 $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

  $(document).ready(function(){
    $('#add_to_cart').on('submit',function(event){
      $.ajax({
            type:'POST',
            url:'{{url("add_to_cart")}}',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success:function(response){
                console.log(response);
                window.location.href = "{{URL::to('cart')}}"
            }
        });

      return false;
    });
  });



 

</script>

@endsection



