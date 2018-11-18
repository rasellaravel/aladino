@extends('layouts.admin-app')


@section('content')

		

			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h3>Sub Menu <small>Admin can create, edit , update delete menu from here.</small></h3>
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
					<li class="active">Sub Category</li>
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
			<form action="{{url('admin/menu-sub-category-store')}}" method="post" role="form">
				@csrf
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-bug"></i> Add Sub Category</h6></div>
	                <div class="panel-body">

						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label>Sub Category:</label>
	                                <input type="text" name="sub_category" class="form-control" placeholder="Wedding & Party" required="required">
								</div>
								<div class="col-md-6">
									<label>Category</label>
                                    <select data-placeholder="Choose issue type..." class="select-full" name="category" tabindex="2" required="required">
                                     <option  selected value> -- select an option -- </option>
                                    @if($categories)
                                    	@foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option> 
										@endforeach
									@endif	
                                    </select>
								</div>

							</div>
						</div>
                        <div class="form-actions text-right">
                        	<input type="reset" value="Cancel" class="btn btn-danger">
                        	<input type="submit" value="Save" class="btn btn-primary">
                        </div>

					</div>
				</div>
			</form>
			<!-- /bug report form -->
		  <div class="panel panel-default">
			                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i> Sub Category List</h6></div>
			                <div class="datatable">
				                <table class="table">
				                    <thead>
				                        <tr>
				                            <th>SL</th>
				                            <th>Category</th>
				                            <th>Sub Category</th>
				                            <th>Action</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                    @php
				                    $i=0;
				                    @endphp
				                    @if(!$subcategory->isEmpty())
				                    @foreach($subcategory as $category)
				                    <?php $i++;?>
				                        <tr>
				                            <td>{{$i}}</td>
				                            <td>
				                            	<?php
				                            	 $top_cat = DB::table('menu_categories')->where('id', $category->category_id)->first();
				                            	if($top_cat) echo $top_cat->category_name;
				                            	?>
				                            </td>
				                            <td>{{$category->sub_category_name}}</td>
				                            <td>
				                            <a href="{{url('admin/menu-sub-category-edit/'.$category->id.'/'.$top_cat->id)}}" class="btn btn-icon btn-info"><i class="icon-pencil3"></i></a>
				                            <a onclick="return confirm('Are you sure to delete this item?')" href="{{url('admin/menu-sub-category-delete',$category->id)}}" class="btn btn-icon btn-danger"><i class="icon-remove2"></i></a>
				                            </td> 
				                        </tr>
				                     @endforeach
				                     @endif  
				                    </tbody>
				                </table>
			                </div>
		      </div>



@endsection