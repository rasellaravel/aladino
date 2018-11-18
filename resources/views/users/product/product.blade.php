@extends('users.layout')
@section('page_style')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
    z-index: 1111;
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
	<section class="main-product" style="margin-top: 40px;">
		<div class="container">
			<div class="row">
				<!-- <div class="col-md-2">
					
				</div> -->
				<div class="col-md-12">
                @foreach($UserProducts as $UserProduct)
					<div class="col-md-3 single-pro-box" style="float: left;">
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

                                <div class="star-rating">
                                    <span class="fa fa-star-o" data-rating="1"></span>
                                    <span class="fa fa-star-o" data-rating="2"></span>
                                    <span class="fa fa-star-o" data-rating="3"></span>
                                    <span class="fa fa-star-o" data-rating="4"></span>
                                    <span class="fa fa-star-o" data-rating="5"></span>
                                    <input type="hidden" name="whatever1" class="rating-value" value="5">
                                </div>
                                <div class="rat-cnt"> (0)</div>
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
	</section>

@endsection
@section('page_level')

@endsection

@section('core_script')


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

@endsection



