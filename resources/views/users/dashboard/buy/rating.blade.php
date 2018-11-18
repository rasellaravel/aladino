@extends('users.dashboard.layout')
@section('otherStyle')

@endsection
@section('otherCss')
<style type="text/css">
.rating-header {
    margin-top: -10px;
    margin-bottom: 10px;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <a href="{{ URL::previous() }}" class="btn btn-secondary btn-fix">Back</a>
            </div>
            <div class="ibox-tools">
                <a class="ibox-remove"><i class="ti-close"></i></a>
            </div>
        </div>
    </div>
</div>
<?php
    $existing_rating = DB::table('feedback')->where('buyed_product_id',$product->id)->first();
?>
<div class="container">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <img src="{{asset('users/shop/shop-img.jpg')}}" style="height: 25px; width: 40px;">
                <?php
                        $shop_name = DB::table('shops')->where('id',$product->seller_shop_id)->first();
                    ?>
                    <a href="{{url('shop-public-profile',$product->seller_shop_id)}}" style="margin-right: 5px; font-size: 14px;">{{$shop_name->shop_name}}</a>
            </div>
            <a href="{{url('shop-public-profile',$product->seller_shop_id)}}" style="font-size: 12px;">Contact Shop</a>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{asset('users/product-image/'.$product->product_image)}}" style="height: 150px; width: 100%;">
                </div>
                <div class="col-md-6">
                    <a href="">{{$product->product_name}}</a>
                    <br>
                    <br>
                    <p>Size: XS (2 US) US women's numeric</p>
                    <u><a href="{{ url('product_view', $product->product_id) }}" target="_blank">View Orginal Product</a></u>
                </div>
                <div class="col-md-1">
                    <div class="form-group mb-4">
                        <input class="form-control" type="text" value="{{ $product->product_qty }}" readonly>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <b>USD {{ $product->total_price }}</b>
                </div>
            </div>
            <div class="col-md-12">
                <hr class="my-4">
                <h5 class="font-strong mb-3"><i class="la la-meh-o mr-2"></i>Rating</h5>
                @if(!$existing_rating)
                <div class="form-group" id="rating-ability-wrapper">
                    <label class="control-label" for="rating">
                        <span class="field-label-header">Please give rating for this product. we will preview your rating </span>
                        <br>
                        <br>
                        <span class="field-label-info"></span>
                        <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
                    </label>
                    <h2 class="bold rating-header" style="">
                <span class="selected-rating">0</span><small> / 5</small>
                </h2>
                    <button type="button" class="btnrating btn btn-default" data-attr="1" id="rating-star-1">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btnrating btn btn-default" data-attr="2" id="rating-star-2">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btnrating btn btn-default" data-attr="3" id="rating-star-3">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btnrating btn btn-default" data-attr="4" id="rating-star-4">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btnrating btn btn-default" data-attr="5" id="rating-star-5">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                </div>
                @endif
                @if($existing_rating)
                <h5>Your given rating is: {{ $existing_rating->rating }} / 5</h5>
                @endif

                <p style="color: red">
                    @if(session('rating_error'))
                        {{ session('rating_error') }}
                    @endif
                </p>

            </div>
            <div class="col-md-12">
                <hr class="my-4">
                <h5 class="font-strong mb-3"><i class="fa fa-comment-o mr-2"></i>Comments</h5>
                <?php
                    $user = DB::table('users')->where('id',Auth()->user()->id)->first();
                ?>
                <ul class="media-list">
                    <li class="media">
                        <a class="media-img" href="javascript:;">
                            <img src="{{ asset('users/profile_image/'.$user->image) }}" alt="image" width="45" />
                        </a>

                        <div class="media-body">
                            <div class="media-heading">
                                <a class="comment-author" href="javascript:;">{{ $user->name }}</a>
                            </div>
                            <p class="m-0">
                                @if($existing_rating)
                                   {{ $existing_rating->comment }}
                                @endif
                            </p>
                        </div>
                    </li>
                </ul>
                @if(!$existing_rating)
                <h5 class="font-strong mt-4 mb-3">Leave A Comment</h5>
                <form action="{{ url('user/buying/give/feedback') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" rows="5" placeholder="Comment here" name="comment" id="comment" required></textarea>
                    </div>
                    <input type="hidden" name="product_rating" id="product_rating" value="">
                    <input type="hidden" name="buyed_product_id" id="buyed_product_id" value="{{$product->id}}">
                    <input type="hidden" name="product_id" id="product_id" value="{{$product->product_id}}">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">SUBMIT</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('otherScript')

@endsection
@section('otherJs')

 <!-- '''''''''''''''''''''''''Ajax Header ''''''''''''''''''''''''''''''-->
<script type="text/javascript">
   $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
</script>
<script>
    jQuery(document).ready(function($){
        
    $(".btnrating").on('click',(function(e) {
    
    var previous_value = $("#selected_rating").val();
    
    var selected_value = $(this).attr("data-attr");
    $("#selected_rating").val(selected_value);
    
    $(".selected-rating").empty();
    $(".selected-rating").html(selected_value);
    $('#product_rating').val(selected_value);
    for (i = 1; i <= selected_value; ++i) {
    $("#rating-star-"+i).toggleClass('btn-warning');
    $("#rating-star-"+i).toggleClass('btn-default');
    }
    
    for (ix = 1; ix <= previous_value; ++ix) {
    $("#rating-star-"+ix).toggleClass('btn-warning');
    $("#rating-star-"+ix).toggleClass('btn-default');
    }
    
    }));        
});
</script>
@endsection



