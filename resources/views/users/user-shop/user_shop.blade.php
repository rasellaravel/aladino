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

<div class="row" style="background: white;">
	<div class="col-md-12">
		<img src="{{asset('users/assets/img/userShop/banner.jpg') }}" class="img-fluid" alt="image">
	</div>
	<div class="col-md-12">
		<div class="container">
			<div class="row shop-profile-details">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-3">
							<div class="profile-pic">
								<img src="{{asset('users/assets/img/userShop/profile_pic.jpg') }}" class="img-fluid" alt="image">
							</div>
						</div>
						<div class="col-md-9">
							<div class="shop-details">
								<h3>LeRoseGifts</h3>
								<div class="shop-details-ex">
									Le Rose Gifts | Bridesmaid Robes | Floral Robes
								</div>
								<div class="shop-details-location">
									<ul>
										<li>
											<i class="fa fa-map-marker" aria-hidden="true"></i> 
											Sydney, Australia
										</li>
										<li>53024 Sales</li>
										<li>On Etsy since 2014</li>
									</ul>
								</div>
								<div class="shop-details-rating">

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
								<div class="shop-details-ss">
									<ul>
										<li>
											<button class="btn btn-outline-secondary btn-fix">
												<span class="btn-icon"><i class="fa fa-heart-o"></i> Favourite Shop (12217)</span>
											</button>
										</li>
										<li>
											<button class="btn btn-outline-secondary btn-fix">
												<span class="btn-icon"><i class="fa fa-facebook-official"></i> Share</span>
											</button>
										</li>
										<li>
											<button class="btn btn-outline-secondary btn-fix">
												<span class="btn-icon"><i class="fa fa-pinterest"></i> Save</span>
											</button>
										</li>
										<li>
											<button class="btn btn-outline-secondary btn-fix">
												<span class="btn-icon"><i class="fa fa-twitter"></i> Tweet</span>
											</button>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 shop-owner">
					<h6>SHOP OWNER</h6>
					<div class="shop-owner-name"><div>LE ROSE</div></div>
					<div class="shop-owner-s-n"><a href="#">LeRoseGifts</a></div>
					<div class="shop-owner-s-c"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Contact</a></div>
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

		// $star_rating.on('click', function() {
		// 	$star_rating.siblings('input.rating-value').val($(this).data('rating'));
		// 	return SetRatingStar();
		// });

		SetRatingStar();
	});
</script>
@endsection
