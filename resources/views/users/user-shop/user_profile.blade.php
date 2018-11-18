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
   <?php
        $profile_info = DB::table('users')->where('id',Auth()->user()->id)->first();
        $shop = DB::table('shops')->where('user_id',Auth()->user()->id)->first();
    ?>
<div class="row" style="padding: 15px 50px; background: white;">
	<div class="col-md-3">
		<div class="profile-pro-img">
		<?php 
			if($profile_info){
				if($profile_info->image){

				
			
		?>
			<img src="{{asset('users/profile_image/'.$profile_info->image) }}" class="img-fluid" alt="image">
			<?php }else{  ?>
			<img src="{{asset('users/profile_image/default2.jpg') }}" class="img-fluid" alt="image">
			<?php } } ?>
			<button class="btn btn-outline-secondary btn-icon-only btn-circle btn-lg profile-pro-c-btn" data-toggle="modal" data-target="#exampleModalCenter">
				<i class="fa fa-camera"></i>
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalCenterTitle">Add a profile photo</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="pro-img-s">
							<?php
								if($profile_info->image){
							?>
								<img src="{{asset('users/profile_image/'.$profile_info->image) }}" class="img-fluid" alt="image">
								<?php }else{?>
								<img src="{{asset('users/profile_image/default2.png') }}" class="img-fluid" alt="image">
								<?php } ?>

							</div>
							<div class="pro-u-t1">Upload your profile photo.</div>
							<div class="pro-u-btn">
							<form action="" method="post" enctype="multipart/form-data" id="profile_picture">

								<input type="file" name="profile_image" />
								<button class="btn btn-outline-primary btn-fix btn-upload" type="button">
									<span class="btn-icon"><i class="la la-cloud-upload"></i>Upload</span>
								</button>

								<button class="btn btn-outline-primary btn-fix btn-back">
									<span class="btn-icon"><i class="fa fa-undo"></i>Go back</span>
								</button>
								<button class="btn btn-info btn-fix btn-air btn-save" type="submit">
									<span class="btn-icon"><i class="fa fa-floppy-o"></i>Save</span>
								</button>
								</form>	
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="profile-pro-n">{{$profile_info->name}}</div>
		<div class="profile-pro-flo">
			<a href="#"><b>0</b> Following</a>&emsp; <a href="#"><b>0</b> Follower</a>
		</div>
		<div class="profile-pro-lsn">
			<i class="fa fa-map-marker" aria-hidden="true"></i> {{$profile_info->city}}
		</div>
		<button class="btn btn-outline-info btn-fix profile-pro-edt">
			<a href="{{url('personal_profile_update')}}"><span class="btn-icon"><i class="la la-pencil"></i>Edit</span></a>
		</button>
	</div>
	<div class="col-md-6">
		<div class="profile-pro-abt">About</div>
		<div class="profile-pro-abt-d">Joined 
		<?php
			$timestamp_time = strtotime($profile_info->created_at);
			echo date(' M d Y ',  $timestamp_time);
			
		?>

		</div>
		<div class="profile-pro-abt-shop">
		<?php 
           
           if($shop){

		?>
		
			<a href="{{url('user_create_shop')}}">
				<div class="abt-shop-pic">
				<?php if($shop->image){?>
					<img src="{{asset('users/shop/'.$shop->image) }}" class="img-thumbnail" alt="image">
					<?php }else{ ?>
					<img src="{{asset('users/shop/default.png') }}" class="img-thumbnail" alt="image">
					<?php } ?>
				</div>
				<div class="abt-shop-name">
					{{$shop->shop_name}}
					<div>
						Visit your shop<i class="fa fa-angle-right" aria-hidden="true"></i>
					</div>
				</div>
			</a>
			<?php } else{ ?>
			<a href="{{url('user_create_shop')}}">
				<div class="abt-shop-pic">

					<img src="{{asset('users/profile_image/default.png') }}" class="img-thumbnail" alt="image">
				</div>
				<div class="abt-shop-name">
					No shop created
					<div>
						Create your shop<i class="fa fa-angle-right" aria-hidden="true"></i>
					</div>
				</div>
			</a>
			<?php } ?>






		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="ibox">
			<div class="ibox-head flex-row-reverse">
				<div class="ibox-title"> </div>
				<ul class="nav nav-tabs tabs-line" style="padding: 0 50px;">
					<li class="nav-item">
						<a class="nav-link active" href="#tab-2-1" data-toggle="tab" aria-expanded="true">
							Favourite items
							<div class="itm-cnt">
								8
							</div>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tab-2-2" data-toggle="tab">
							Favourite shops
							<div class="itm-cnt">
								0
							</div>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tab-2-2" data-toggle="tab">
							Lists
							<div class="itm-cnt">
								0
							</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="ibox-body">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="tab-2-1" aria-expanded="true">
						<div class="row" style="padding: 0 50px;">
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
									<div class="sgl-pro-rtg">

										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="whatever1" class="rating-value" value="5">
										</div>
										<div class="rat-cnt"> (5230)</div>
									</div>
									<div class="sgl-pro-p">£13.41</div>
									<div class="sgl-pro-s-i">
										See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</div>
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
									<div class="sgl-pro-rtg">

										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="whatever1" class="rating-value" value="5">
										</div>
										<div class="rat-cnt"> (5230)</div>
									</div>
									<div class="sgl-pro-p">£13.41</div>
									<div class="sgl-pro-s-i">
										See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</div>
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
									<div class="sgl-pro-rtg">

										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="whatever1" class="rating-value" value="5">
										</div>
										<div class="rat-cnt"> (5230)</div>
									</div>
									<div class="sgl-pro-p">£13.41</div>
									<div class="sgl-pro-s-i">
										See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</div>
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
									<div class="sgl-pro-rtg">

										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="whatever1" class="rating-value" value="5">
										</div>
										<div class="rat-cnt"> (5230)</div>
									</div>
									<div class="sgl-pro-p">£13.41</div>
									<div class="sgl-pro-s-i">
										See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</div>
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
									<div class="sgl-pro-rtg">

										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="whatever1" class="rating-value" value="5">
										</div>
										<div class="rat-cnt"> (5230)</div>
									</div>
									<div class="sgl-pro-p">£13.41</div>
									<div class="sgl-pro-s-i">
										See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</div>
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
									<div class="sgl-pro-rtg">

										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="whatever1" class="rating-value" value="5">
										</div>
										<div class="rat-cnt"> (5230)</div>
									</div>
									<div class="sgl-pro-p">£13.41</div>
									<div class="sgl-pro-s-i">
										See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</div>
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
									<div class="sgl-pro-rtg">

										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="whatever1" class="rating-value" value="5">
										</div>
										<div class="rat-cnt"> (5230)</div>
									</div>
									<div class="sgl-pro-p">£13.41</div>
									<div class="sgl-pro-s-i">
										See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</div>
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
									<div class="sgl-pro-rtg">

										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="whatever1" class="rating-value" value="5">
										</div>
										<div class="rat-cnt"> (5230)</div>
									</div>
									<div class="sgl-pro-p">£13.41</div>
									<div class="sgl-pro-s-i">
										See similar item <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</div>
								</a>
							</div>
						</div>
					</div>
					<div class="tab-pane fade text-center" id="tab-2-2">
						<div class="empty-pro">
							<img src="{{asset('users/assets/img/userProfile/empty_favorite_shops.svg') }}" class="img-fluid" alt="image">
						</div>
						<div class="empty-txt">
							You don’t have any favourite shops yet! Explore Etsy and find a shop you’ll love.
						</div>
					</div>
					<div class="tab-pane fade text-center" id="tab-2-3">
						<div class="empty-pro">
							<img src="{{asset('users/assets/img/userProfile/empty_favorite_shops.svg') }}" class="img-fluid" alt="image">
						</div>
						<div class="empty-txt">
							You don’t have any favourite shops yet! Explore Etsy and find a shop you’ll love.
						</div>
					</div>
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

		$('.modal-body .pro-u-btn .btn-upload').click(function() {
			$(".modal-body .pro-u-btn input").click();
		});

		$(document).on('change', '.pro-u-btn :file', function() {
			var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		// $('.pro-u-btn :file').on('fileselect', function(event, label) {

		// 	var input = $(this).parents('.input-group').find(':text'),
		// 	log = label;

		// 	if( input.length ) {
		// 		input.val(log);
		// 	} else {
		// 		if( log ) alert(log);
		// 	}

		// });
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('.pro-img-s img').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);

				$(".pro-u-btn .btn-upload").css({'display': 'none'});
				$('.pro-u-btn .btn-back, .pro-u-btn .btn-save').css({'display': 'inline-block'});
			}
		}

		$(".pro-u-btn input").change(function(){
			readURL(this);
		}); 

		$('.pro-u-btn .btn-back').click(function() {
			$(".pro-u-btn .btn-upload").css({'display': 'inline-block'});
			$('.pro-u-btn .btn-back, .pro-u-btn .btn-save').css({'display': 'none'});
		});
	});
</script>
<script type="text/javascript">
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


   $(document).ready(function(){
        $('#profile_picture').on('submit', function(){
            $.ajax({
                type:'POST',
                url:'change_profile_picture',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
	            	// if(response=='success')
	             //      window.location = '{{url("user_profile")}}';
	             //    }
              //       console.log(response);

              if(response=='success'){
              	 window.location = '{{url("user_profile")}}';
              }

                   
                    
                }
            });

            return false;
        });
        
    });

    </script>
@endsection
