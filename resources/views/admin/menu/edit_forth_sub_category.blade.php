@extends('layouts.admin-app')
 

@section('content')

		

			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h3>Forth Sub Menu <small>Admin can create Tri Sub menu.</small></h3>
				</div>
				<div id="reportrange" class="range">
					<div class="visible-xs header-element-toggle">
						<a class="btn btn-primary btn-icon"><i class="icon-calendar"></i></a>
					</div>
					<div class="date-range"></div>
					<span class="label label-danger">9</span>
				</div>
			</div>
			<!-- /page header -->


			<!-- Breadcrumbs line -->
			<div class="breadcrumb-line">
				<ul class="breadcrumb">
					<li><a href="index-2.html">Home</a></li>
					<li><a href="forms.html">Menus</a></li>
					<li class="active">Forth Sub Category</li>
				</ul>

				<div class="visible-xs breadcrumb-toggle">
					<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
				</div>

				<ul class="breadcrumb-buttons collapse">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search3"></i> <span>Search</span> <b class="caret"></b></a>
						<div class="popup dropdown-menu dropdown-menu-right">
							<div class="popup-header">
								<a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a>
								<span>Quick search</span>
								<a href="#" class="pull-right"><i class="icon-new-tab"></i></a>
							</div>
							<form action="#" class="breadcrumb-search">
								<input type="text" placeholder="Type and hit enter..." name="search" class="form-control autocomplete">
								<div class="row">
									<div class="col-xs-6">
										<label class="radio">
											<input type="radio" name="search-option" class="styled" checked="checked">
											Everywhere
										</label>
										<label class="radio">
											<input type="radio" name="search-option" class="styled">
											Invoices
										</label>
									</div>

									<div class="col-xs-6">
										<label class="radio">
											<input type="radio" name="search-option" class="styled">
											Users
										</label>
										<label class="radio">
											<input type="radio" name="search-option" class="styled">
											Orders
										</label>
									</div>
								</div>

								<input type="submit" class="btn btn-block btn-success" value="Search">
							</form>
						</div>
					</li>

					<li class="language dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="images/flags/german.png" alt=""> <span>German</span> <b class="caret"></b></a>
						<ul class="dropdown-menu dropdown-menu-right icons-right">
							<li><a href="#"><img src="images/flags/ukrainian.png" alt=""> Ukrainian</a></li>
							<li class="active"><a href="#"><img src="images/flags/english.png" alt=""> English</a></li>
							<li><a href="#"><img src="images/flags/spanish.png" alt=""> Spanish</a></li>
							<li><a href="#"><img src="images/flags/german.png" alt=""> German</a></li>
							<li><a href="#"><img src="images/flags/hungarian.png" alt=""> Hungarian</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<!-- /breadcrumbs line -->
				@if(session('success'))
					<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  {{session('success')}}
						</div>
						<br>
				@endif

			<!-- Bug report form -->
			<form action="{{url('admin/menu-forth-sub-category-update')}}" method="post" role="form">
				@csrf
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-bug"></i> Add Sub Category</h6></div>
	                <div class="panel-body">
	                <input type="hidden" name="id" value="{{$forth_category->id}}">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label>Forth Sub Category:</label>
	                                <input type="text" name="forth_sub_category" class="form-control" placeholder="Wedding & Party" value="{{$forth_category->forth_sub_category_name}}" required="required">
								</div>
								<div class="col-md-6">
									<label>Category</label>
                                    <select data-placeholder="Choose issue type..." class="select-full" name="category" id="category" tabindex="2" required="required">
                                    
                                    	@foreach($categories as $category)
                                        <option value="{{$category->id}}" 
                                        	<?php
                                        	if($category->id==$cat){
                                        		echo 'selected';
                                        	}
                                        ?>
                                        >{{$category->category_name}}</option> 
										@endforeach

                                    </select>
								</div>
								
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label>Sub Category</label>
                                    <select data-placeholder="Choose issue type..." class="select-full" name="sub_category" tabindex="2" id="sub_category" required="required">
                                    <?php
		                            	 $sub_cats = DB::table('menu_sub_categories')->where('category_id', $cat)->get();
		                            	
		                            	 foreach ($sub_cats as $sub_cat) {?>
		                            	 	<option value="{{$sub_cat->id}}"
		                            	 	<?php if($sub_cat->id==$cat){echo'selected';}?>
		                            	 	>{{$sub_cat->sub_category_name}}</option>
		                                 <?php } ?>
                                    	

                                    </select>
								</div>

								<div class="col-md-6">
									<label>Tri-Sub Category</label>
                                    <select data-placeholder="Choose issue type..." class="select-full" name="tri_sub_category" tabindex="2" id="tri_sub_category" required="required">
                                    	 <?php
		                            	 $tri_sub_cats = DB::table('menu_tri_sub_categories')->where('sub_category_id', $sub)->get();
		                            	
		                            	 foreach ($tri_sub_cats as $tri_cat) {?>
		                            	 	<option value="{{$tri_cat->id}}"
		                            	 	<?php if($tri_cat->id==$sub){echo'selected';}?>
		                            	 	>{{$tri_cat->tri_sub_category_name}}</option>
		                                 <?php } ?>

                                    </select>
								</div>

							</div>
						</div>
                        <div class="form-actions text-right">
                        	<input type="reset" value="Cancel" class="btn btn-danger">
                        	<input type="submit" value="Update" class="btn btn-primary">
                        </div>

					</div>
				</div>
			</form>
			<!-- /bug report form -->
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>

			<br/>
			<br/>
			<br/>

			<br/>
			<br/>

			 
<script type="text/javascript">
	$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


	$(document).ready(function(){
       $('#category').change(function(){
       	var id  = $(this).val();
       	var baseUrl = document.location.origin;
       	var Currect_url = baseUrl +'/admin/get-sub-category';
       	$.ajax({
			type:'POST',
			url:Currect_url,
			data: {id:id},
			success:function(response){
				$('#sub_category').html(response);
				
			}
		});

       });
	});

	$(document).ready(function(){
       $('#sub_category').change(function(){
       	var id  = $(this).val();
       	var baseUrl = document.location.origin;
       	var Currect_url = baseUrl +'/admin/get-tri_sub-category';

       	$.ajax({
			type:'POST',
			url:Currect_url,
			data: {id:id},
			success:function(response){
				$('#tri_sub_category').html(response);
				console.log(response);
				
			}
		});

       });
	});
</script>

@endsection