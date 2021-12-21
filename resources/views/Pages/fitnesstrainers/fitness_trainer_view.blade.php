@extends('layouts.admin')
@section('content')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Business Details</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Business Details</li>
			</ol>
		</div>
	</div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
		
		<div class="col-12">
			<div class="card">
				<div class="border-bottom title-part-padding">
					<h4 class="card-title mb-0">Business Details</h4>
				</div>
				<div class="card-body min_height">
					<form name="user_add" id="user_add" method="post" action="javascript:void(0)" enctype="multipart/form-data">
						@csrf
					    <div class="row">
							<div class="">
								<!-- Alert Append Box -->
							<div class="result"></div>
							</div>
							<div class="mb-3 col-md-4">
								<label for="Name" class="control-label" >Name:</label>
								<input type="text" id="name" value="{{$fitnesstrainer->name}}" readonly="true" name="name" class="form-control">
							</div>
							<div class="mb-3 col-md-4">
								<label for="Email" class="control-label">Email:</label>
								<input type="email" id="email" name="email" value="{{$fitnesstrainer->email}}" readonly="true" class="form-control">
								{{-- allready exit error --}}
								<label id="email_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-4" style="display: none;">
								<label for="Email" class="control-label">Password:</label>
								<input type="password" id="password" name="password" value="{{$fitnesstrainer->password}}" readonly="true" class="form-control">
								{{-- allready exit error --}}
								<label id="email_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-4"style="display: none;">
								<label for="username" class="control-label">Mobile Number:</label>
								<input type="text" id="mobile_number" name="phone" value="{{$fitnesstrainer->country_code}} {{$fitnesstrainer->phone}}" readonly="true"  class="form-control">
								{{-- allready exit error --}}
								<label id="name_error" class="error"></label>
							</div>
                           
							<div class="mb-3 col-md-4">
								<label for="password" class="control-label">Business Type:</label>
								@if($fitnesstrainer->business_type=='1')
								<input type="text" id="gender" name="gender"  readonly="true" value="Online Only"    class="form-control">
								@else
								<input type="text" id="gender" name="gender"  readonly="true" value="Physical Location"    class="form-control">
								@endif
								
							</div>

							<div class="mb-3 col-md-4">
								<label for="password" class="control-label">Location:</label>
								<input type="text" id="gender" name="gender"  readonly="true" value="{{$fitnesstrainer->location}}"    class="form-control">
							</div>
							<div class="mb-3 col-md-4"style="display: ;">
								<label for="password" class="control-label">Opening Hours:</label>
								<input type="text" id="gender" name="gender"  readonly="true" value="{{$fitnesstrainer->opeing_hour}}"    class="form-control">
							</div>
							<div class="mb-3 col-md-4"style="display: ;">
								<label for="password" class="control-label">Category Name:</label>
								<input type="text" id="gender" name="gender"  readonly="true" value="{{$fitnesstrainer->category_name}}"    class="form-control">
							</div>
							<div class="mb-3 col-md-4"style="display: ;">
								<label for="password" class="control-label">Sub Category Name:</label>
								<input type="text" id="gender" name="gender"  readonly="true" value="{{$fitnesstrainer->subcategory_name}}"    class="form-control">
							</div>
							<div class="mb-3 col-md-4"style="display: ;">
								<label for="password" class="control-label">Closing Hours:</label>
								<input type="text" id="gender" name="gender"  readonly="true" value="{{$fitnesstrainer->closing_hour}}"    class="form-control">
							</div>
							<div class="mb-3 col-md-4"style="display: ;">
								<label for="password" class="control-label">Business Images:</label>
								@if(!empty($fitnesstrainer->business_images))
								<img src="{{($fitnesstrainer->business_images)}}" height="150" width="100" class="form-control" />
								@else
								<input type="text" id="gender" name="gender"  readonly="true" value="Image not found"    class="form-control">
								@endif
							</div>
							
							<div class="mb-3 col-md-4">
								<label for="username" class="control-label">Upload Document:</label><br>
								@if(!empty($fitnesstrainer->upload_doc))
								<A href="{{$fitnesstrainer->upload_doc}}" class="btn btn-primary" target="_blank">View</a>
								<!-- <img src="{{($fitnesstrainer->upload_doc)}}" height="150" width="100" class="form-control" /> -->
								@else
								<input type="text" id="gender" name="gender"  readonly="true" value="document not found"    class="form-control">
								@endif
								<br>
								<!-- 	<label class="control-label">{{$fitnesstrainer->upload_doc}}</label> -->
							</div>
							<div class="mb-3 col-md-4"style="display:;">
								<label for="password" class="control-label">Short Description:</label>
								<textarea rows="3" cols="5" class="form-control" readonly="true">{{$fitnesstrainer->description}}</textarea>
							</div>
						</div>
						<a type="button" href="{{ url('manager_business') }}" class="btn btn-dark fa-pull-left mt-3">Back</a>
						<!-- <input type="submit" id="submit" value="Add" class="btn btn-success btn_submit fa-pull-right mt-3"> -->
					</form>
				</div>
			</div>
		</div>
		
	</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@stop


