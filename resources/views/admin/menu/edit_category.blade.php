@extends('layouts.admin-app')


@section('content')

		

			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h3>Top Menu <small>Admin can create, edit , update delete menu from here.</small></h3>
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
					<li class="active">Category</li>
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

			<!-- Bug report form -->
			<form action="{{url('admin/menu-category-update')}}" method="post" role="form">
				@csrf
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-bug"></i> Edit Category</h6></div>
	                <div class="panel-body">
	                <input type="hidden" name="id" value="{{$category->id}}">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>Category:</label>
	                                <input type="text" name="category" class="form-control" placeholder="Wedding & Party" value="{{$category->category_name}}" required="required">
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

			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
@endsection