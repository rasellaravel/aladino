@extends('front-end.layout')


@section('content')

<section class="profile-edit-section">
<div class="container">
	<div class="row">
	     <div class="col-md-3">
	     	
	     </div>
		<div class="col-md-9">
		    <div class="edit-section">
		    	<form action="{{url('user-profile-update')}}" method="post" enctype="multipart/form-data">
		    	@csrf
		    	     <div class="form-group row">
					    <label for="inputEmail3" class="col-md-3 col-form-label">Profile Picture</label>
					    <div class="col-md-9">
					     <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
					    </div>
					  </div>
					   <div class="form-group row">
					    <label for="inputEmail3" class="col-md-3 col-form-label"></label>
					    <div class="col-md-9">
					    @if($ProfileInfo->image)	
					      <img src="{{asset('user-image/'.$ProfileInfo->image)}}" class="img-circle img-responsive" style="width: 144px;height: 141px;">
					    @else  
					      <img src="{{asset('user-img.png')}}" class="img-circle img-responsive" style="width: 144px;height: 141px;">
					      @endif

					      <p style="font-size: 11px;">Must be a .jpg, .gif or .png file smaller than 10MB and at least 400px by 400px.</p>
					    </div>
					  </div>
					  <hr>

					  <div class="form-group row">
					    <label for="inputEmail3" class="col-md-3 col-form-label">Your Name</label>
					    <div class="col-md-9">
					     <p style="margin-top: 2px">{{Auth()->user()->name}} &nbsp; &nbsp;<a href="">Change or Remove</a></p>
					    </div>
					  </div>
					  <hr/>
					   <div class="form-group row">
					    <label for="inputEmail3" class="col-md-3 col-form-label">Gender</label>
					    <div class="col-md-9">
					      <div class="form-check form-check-inline">
					         <input class="form-check-input" type="radio" name="gender" id ="exampleRadios1" value="female" <?php
					         if($ProfileInfo->gender=='female') echo'checked';?> >
	                            <label class="form-check-label" for="exampleRadios1">
	                            Female
                               </label>
                                <input class="form-check-input" type="radio" name="gender" id ="exampleRadios1" value="male" <?php
					         if($ProfileInfo->gender=='male') echo'checked';?>>
	                            <label class="form-check-label" for="exampleRadios1">
	                            Male
                               </label>
                                <input class="form-check-input" type="radio" name="gender" id ="exampleRadios1" value="rather not say" <?php
					         if($ProfileInfo->gender=='rather not say') echo'checked';?>>
	                            <label class="form-check-label" for="exampleRadios1">
	                            Rather not say
                               </label>
                               <input class="form-check-input" type="radio" name="gender" id ="exampleRadios1" value="coustom" <?php
					         if($ProfileInfo->gender=='coustom') echo'checked';?> >
	                            <label class="form-check-label" for="exampleRadios1">
	                            Coustom
                               </label>
                               
					      </div>
					    </div>
					  </div>
					  <hr/>
					   <div class="form-group row">
					    <label for="inputEmail3" class="col-md-3 col-form-label">City</label>
					    <div class="col-md-9">
					       <input type="text" class="form-control" name="city" id="inputEmail3" value="{{$ProfileInfo->city}}" placeholder="city">
					    </div>
					  </div>
					  <hr/>

					   <div class="form-group row">
					    <label for="inputEmail3" class="col-md-3 col-form-label">About</label>
					    <div class="col-md-9">
					       <textarea class="form-control" name="about" id="exampleFormControlTextarea1" rows="3">{{$ProfileInfo->about}}</textarea>
					    </div>
					  </div>
					  <hr/>

					  <div class="form-group row">
					    <label for="inputEmail3" class="col-md-3 col-form-label">Favarite meterial</label>
					    <div class="col-md-9">
					       <textarea class="form-control" name="favorite_metrials" id="exampleFormControlTextarea1" rows="3">{{$ProfileInfo->favorite}}</textarea>
					    </div>
					  </div>
					  <hr/>

					  <div class="form-group row">
					    <div class="col-md-3"><b>Includein on your profile</b></div>
					    <div class="col-md-9">
					      <div class="form-check">
					        <input class="form-check-input" value="shops" type="checkbox" id="gridCheck1" name="include_profile[]"
					        @if(in_array('shops',$include_profile)) checked @endif

					        >
					        <label class="form-check-label" for="gridCheck1">
					          <p>Shops</p>
					        </label>
					      </div>
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="gridCheck1" name="include_profile[]" value="favorite item"
					        @if(in_array('favorite item',$include_profile)) checked @endif
					        >
					        <label class="form-check-label" for="gridCheck1">
					          <p>Favarite Item</p>
					        </label>
					      </div>
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="gridCheck1" name="include_profile[]" value="favorite shops"  @if(in_array('favorite shops',$include_profile)) checked @endif>
					        <label class="form-check-label" for="gridCheck1">
					          <p>Favarite shops</p>
					        </label>
					      </div>
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="gridCheck1" name="include_profile[]" value="treasury lists"  @if(in_array('treasury lists',$include_profile)) checked @endif>
					        <label class="form-check-label" for="gridCheck1">
					          <p>Treasury lists</p>  
					        </label>
					         
					      </div>
					       <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="gridCheck1" name="include_profile[]" value="teams"@if(in_array('teams',$include_profile)) checked @endif>
					        <label class="form-check-label" for="gridCheck1">
					          <p>Teams </p> 
					        </label>
					         
					      </div>
					    </div>
					  </div>
					  <div class="form-group row">
					    <div class="col-sm-10">
					      <button type="submit" class="btn btn-primary">Save Change</button>
					    </div>
					  </div>
					</form>
		    </div>
  
		</div>
	</div>
</div>
</section>






@endsection