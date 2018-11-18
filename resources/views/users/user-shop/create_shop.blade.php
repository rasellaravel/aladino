@extends('users.layout')
@section('page_style')
<link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />
@endsection

@section('row_style')
<style type="text/css">
	sup{
		color:red;
	}
</style>
@endsection


@section('content')
<div class="container" style="margin-top: 50px;">
	   <div class="ibox">
        <form action="{{url('user_create_shop-update')}}" method="post">
        	@csrf
            <div class="ibox-head">
                <div class="ibox-title">
                @if($shops)
                	Update Your Shop
                @else
                	Create Your Shop
                @endif
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                	<div class="col-md-12">
                	@if(session('success'))
                		 <div class="alert alert-primary alert-dismissable fade show has-icon"><i class="la la-check alert-icon"></i>
                        <button class="close" data-dismiss="alert" aria-label="Close"></button><strong>Well done!</strong><br>{{session('success')}}</div>
                    @endif   
                	</div>
                    <div class="col-md-6">
                       <div class="form-group mb-4">
	                        <label>Shop Language <sup>*</sup></label>
	                        <select class="form-control" name="language" required>
	                        <option  selected value> Select Language </option>
	                         @foreach($ShopLanguage as $ShopLanguage)
	                             <option value="{{$ShopLanguage->id}}"
					            @if($shops->language_id==$ShopLanguage->id)
					            selected
					            @endif
					            >{{$ShopLanguage->language}}</option>
	                         @endforeach  
	                        </select>
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Shop Currency <sup>*</sup></label>
	                        <select class="form-control" name="currency" required>
	                        <option  selected value> Select Currency </option>
	                            @foreach($ShopCurrency as $ShopCurrency)
					              <option value="{{$ShopCurrency->id}}"
					              @if($shops->currency_id==$ShopCurrency->id)
					                selected
					              @endif

					              >{{$ShopCurrency->currency}}</option>
					            @endforeach  
	                        </select>
	                    </div>

                       
                        <div class="form-group mb-4">
                            <label>Shop Title <sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="Enter Email" value="{{$shops->shop_title}}" name="shoptitle" required>
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                       <div class="form-group mb-4">
	                        <label>Shop Country <sup>*</sup></label>
	                        <select class="form-control" name="country">
	                        <option  selected value> Select Country </option>
	                            @foreach($ShopCountry as $ShopCountry)
					              <option value="{{$ShopCountry->id}}"
					                @if($shops->country_id==$ShopCountry->id)
					                selected
					                @endif
					              >{{$ShopCountry->shop_country}}</option>
					            @endforeach 
	                        </select>
	                    </div>
                         <div class="form-group mb-4">
                            <label>Shop Name <sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="Enter Shop Name" value="{{$shops->shop_name}}" name="shopname" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Shop Sub title <sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="Enter Shop Sub-Title" value="{{$shops->sub_title}}" name="subtitle" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>About Shop <sup>*</sup></label>
                    	 <textarea id="summernote" data-plugin="summernote" data-air-mode="true"  name="aboutshop" required>
                    	 {{$shops->about_shop}}
                    	 </textarea>
                    </div>

                        
                </div>
                
            </div>
            <div class="ibox-footer">
                <button type="submit" class="btn btn-primary mr-2" type="button">
                	@if($shops)
                	Update Shop
                	@else
                	Create Shop
                	@endif
                </button>
                <button class="btn btn-outline-secondary" type="reset">Cancel</button>
            </div>
        </form>
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
            $('#summernote').summernote();
            $('#summernote_air').summernote({
                airMode: true
            });
        });
    </script>
@endsection



