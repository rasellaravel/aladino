@extends('layouts.admin-app')
 

@section('content')

		

			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h3>Tri Sub Menu <small>Admin can create, edit , update delete menu from here.</small></h3>
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
					<li class="active">Tri Sub Category</li>
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
			<form action="{{url('admin/menu-tri-sub-category-update')}}" method="post" role="form">
				@csrf
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-bug"></i> Update Tri Sub Category</h6></div>
	                <div class="panel-body">
	                <input type="hidden" name="id" value="{{$tri}}">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>Tri Sub Category:</label>
	                                <input type="text" name="tri_sub_category" class="form-control" placeholder="Wedding & Party" value="{{$tri_category->tri_sub_category_name}}" required="required">
								</div>
								
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label>Category</label>
                                    <select data-placeholder="Choose issue type..." class="select-full" name="category" id="category" tabindex="2" required="required">
                                        <option  selected value> -- select an option -- </option>
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
				$("option:selected").prop("selected", false);
				$('#sub_category').html(response);
				
				
			}
		});

       });
	});
</script>

@endsection