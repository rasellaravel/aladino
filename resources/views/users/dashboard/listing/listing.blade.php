@extends('users.dashboard.layout')
@section('otherStyle')
<link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />

@endsection

@section('otherCss')
<style type="text/css">
	sup{
		color:red;
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
    
    <?php
        $UserProducts = DB::table('user_products')->where('user_id',Auth()->user()->id)->get();
    ?>
    <div class="col-md-12">

        <div class="ibox">
           <div class="ibox-head">
              <div class="ibox-title">
              Product Listing
              </div>
           </div>
           <div class="ibox-body">
               <div class="row">
               <div class="container">
                     @foreach($UserProducts as $UserProduct)
                      <div class="col-md-3 single-pro-box" style="float: right; margin-bottom: 30px;">
                       <!--  <button type="button" class="btn btn-outline-secondary btn-icon-only btn-circle btn-thick love-icn"><i class="la la-heart-o"></i></button> -->
                        <a href="#">
                            <img src="{{asset('users/product-image/'.$UserProduct->image) }}" class="img-fluid" alt="image">
                            <div class="sgl-pro-t">
                                <?php echo substr($UserProduct->product_title,0,40);?>
                                ...

                            </div>
                            <div class="sgl-pro-s-n">
                                <?php 
                                    $shopName = DB::table('shops')->where('user_id',Auth()->user()->id)->first();
                                    if($shopName){
                                        echo $shopName->shop_name;
                                    }
                                ?>
                            </div>
                            <div class="sgl-pro-rtg">

                                <!-- <div class="star-rating">
                                    <span class="fa fa-star-o" data-rating="1"></span>
                                    <span class="fa fa-star-o" data-rating="2"></span>
                                    <span class="fa fa-star-o" data-rating="3"></span>
                                    <span class="fa fa-star-o" data-rating="4"></span>
                                    <span class="fa fa-star-o" data-rating="5"></span>
                                    <input type="hidden" name="whatever1" class="rating-value" value="5">
                                </div>
                                <div class="rat-cnt"> (0)</div> -->
                            </div>
                            <div class="sgl-pro-p">USD {{$UserProduct->price}}</div>
                            <div class="sgl-pro-s-i">
                                <a href="{{url('product_view',$UserProduct->id)}}" class="btn btn-outline-primary btn-rounded">preview</a>
                                
                                 <a href="{{url('edit_listing',$UserProduct->id)}}" class="btn btn-outline-success btn-rounded" style="margin-left: 20px;">Edit</a>
                            </div>
                        </a>
                    </div>
                @endforeach 
                </div>
                </div>
           </div>
           
        </div>

    </div>

@endsection
@section('otherScript')
<script src="{{asset('users/assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>
@endsection

@section('otherJs')
<script>
        $(function() {
            $('#summernote').summernote();
            $('#summernote_air').summernote({
                airMode: true
            });
        });
</script>
<?php if(session('success')){?>
<script type="text/javascript">
            toastr["success"]("Prifile information successfully updated");
</script>
<?php } ?>
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
<?php if(session('add_listin_success')){?>
<script type="text/javascript">


            toastr["success"]("Product successfully add to listing");


</script>
<?php } ?>

<?php if(session('update_success')){?>
<script type="text/javascript">


            toastr["success"]("Product successfully Updated");


</script>
<?php } ?>



@endsection



