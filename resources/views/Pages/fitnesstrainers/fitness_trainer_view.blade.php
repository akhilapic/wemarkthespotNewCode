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
	<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div>
							<!-- Nav tabs -->
							<ul class="nav nav-pills" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
										<span>Business Details</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#Offers" role="tab">
										<span>Offers</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#Hotspotupdates" role="tab">
										<span>Hotspot Updates</span>
									</a>
								</li>
								
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#Overallratingsreview" role="tab">
										<span>Overall Ratings And Reviews</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#Subscriptions" role="tab">
										<span>Subscriptions</span>
									</a>
								</li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content pt-3">
								<div class="tab-pane active" id="home" role="tabpanel">
								<div class="card-body min_height">
									<form name="user_add" id="user_add" method="post" action="javascript:void(0)" enctype="multipart/form-data">
										<div class="row">
											<div class="">
												<!-- Alert Append Box -->
											<div class="result"></div>
											</div>
											<div class="mb-3 col-md-4">
												<label for="Name" class="control-label" >Business Owner Name:</label>
												<input type="text" id="name" value="{{$fitnesstrainer->name}}" readonly="true" name="name" class="form-control">
											</div>
											<div class="mb-3 col-md-4">
												<label for="Name" class="control-label" >Business Name:</label>
												<input type="text" id="name" value="{{$fitnesstrainer->business_name}}" readonly="true" name="name" class="form-control">
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
											<div class="mb-3 col-md-4"style="display: ;">
												<label for="username" class="control-label">Mobile Number:</label>
												<input type="text" id="mobile_number" name="" value="{{$fitnesstrainer->country_code}} {{$fitnesstrainer->phone}}" readonly="true"  class="form-control">
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
												<label for="password" class="control-label">Business Logo:</label>
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
								<div class="tab-pane" id="Hotspotupdates" role="tabpanel">
								
									<div class="table-responsive">
										<table id="zero_config" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>User Name</th>
													<th>User Image</th>
													<th>Message</th>
												</tr>
											</thead>
											<tbody>
											@foreach($hotspots as $k=> $h)
											<td>{{$k+1}}</td>
											<td>{{$h->name}}</td>
											<td>	
												@if($h->image)
											<img src="{{$h->image}}" width="150" height="140" />
											@else
											<img src="{{asset('public/images/userimage.png')}}" width="150" height="140" />
											@endif
										</td>
											<td>{{$h->message}}</td>
</tr>
											@endforeach														
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="Offers" role="tabpanel">
								
									<div class="col-md-5">
										<div class="input-group mb-3">
											<select class="form-control">
												<option>All</option>
												<option>New</option>
												<option>Completed</option>
												<option>Canceled</option>
											</select>
											<input type="button" class="btn btn-info ml-2" value="Filter">
										</div>
									</div>
									
									<div class="table-responsive">
										<table id="zero_config" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Status</th>
													<th>Image</th>
													<th>Product Name</th>
													<th>Order Id</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="sorting_1">01</td>
													<td>
														<span class="status_btn mb-1" style="background:rgb(55 141 223);">New</span>
														<br> 
														<span class="order_stauts">Pick-up</span>
													</td>
													<td><img class="fit_img" style="width:100px;height:62px;" src="assets/admin/images/theme/no_images.png"></td>
													<td>
														<p class="m-0 limit_1"><b>King Spa and Sauna</b></p>
														<p class="m-0 limit_1">Category : Beauty &amp; Spa</p>
														<p class="m-0 limit_1">Price : $ 34.09</p>
													</td>
													<td>W3-534DFG23</td>
													<td>
														<div class="table_action">
															<a href="customer-details-order.php" class="btn btn-success btn-sm list_view">
																<i class="mdi mdi-eye"></i>
															</a>  
															<a href="javascript:void(0);" class="btn btn-danger btn-sm list_delete">
																<i class="mdi mdi-delete"></i>
															</a>  
															<!--<span class="status">
																<label class="switch">
																	<input class="switch-input" type="checkbox" checked />
																	<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
																	<span class="switch-handle"></span> 
																</label>
															</span>-->
														</div>
													</td>
												</tr>
												<tr>
													<td class="sorting_1">02</td>
													<td>
														<span class="status_btn mb-1" style="background:rgb(87 170 32);">Completed</span>
													</td>
													<td><img class="fit_img" style="width:100px;height:62px;" src="assets/admin/images/theme/no_images.png"></td>
													<td>
														<p class="m-0 limit_1"><b>King Spa and Sauna</b></p>
														<p class="m-0 limit_1">Category : Beauty &amp; Spa</p>
														<p class="m-0 limit_1">Price : $ 34.09</p>
													</td>
													<td>W3-534DFG23</td>
													<td>
														<div class="table_action">
															<a href="customer-details-order.php" class="btn btn-success btn-sm list_view">
																<i class="mdi mdi-eye"></i>
															</a>  
															<a href="javascript:void(0);" class="btn btn-danger btn-sm list_delete">
																<i class="mdi mdi-delete"></i>
															</a>  
															<!--<span class="status">
																<label class="switch">
																	<input class="switch-input" type="checkbox" checked />
																	<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
																	<span class="switch-handle"></span> 
																</label>
															</span>-->
														</div>
													</td>
												</tr>
												<tr>
													<td class="sorting_1">03</td>
													<td>
														<span class="status_btn mb-1" style="background:rgb(214 2 2);">Cancelled</span>
													</td>
													<td><img class="fit_img" style="width:100px;height:62px;" src="assets/admin/images/theme/no_images.png"></td>
													<td>
														<p class="m-0 limit_1"><b>King Spa and Sauna</b></p>
														<p class="m-0 limit_1">Category : Beauty &amp; Spa</p>
														<p class="m-0 limit_1">Price : $ 34.09</p>
													</td>
													<td>W3-534DFG23</td>
													<td>
														<div class="table_action">
															<a href="customer-details-order.php" class="btn btn-success btn-sm list_view">
																<i class="mdi mdi-eye"></i>
															</a>  
															<a href="javascript:void(0);" class="btn btn-danger btn-sm list_delete">
																<i class="mdi mdi-delete"></i>
															</a>  
															<!--<span class="status">
																<label class="switch">
																	<input class="switch-input" type="checkbox" checked />
																	<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
																	<span class="switch-handle"></span> 
																</label>
															</span>-->
														</div>
													</td>
												</tr>
												
											</tfoot>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="Overallratingsreview" role="tabpanel">
								
									
									<div class="table-responsive">
									<table id="zero_config" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>User Name</th>
													<th>User Image</th>
													<th>Review</th>
													<th>Rating</th>
													<th>Overall Ratings</th>
												</tr>
											</thead>
											<tbody>
											@foreach($reviewratting as $k=> $h)
											<tr>
											<td>{{$k+1}}</td>
											<td>{{$h->name}}</td>
											<td>
											@if($h->image)
											<img src="{{$h->image}}" width="150" height="140" />
											@else
											<img src="{{asset('public/images/userimage.png')}}" width="150" height="140" />
											@endif
										</td>
											<td>{{$h->review}}</td>
											<td>{{$h->ratting}}</td>
											<td>{{$h->overallratings}}</td>
										</tr>
											@endforeach														
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="Subscriptions" role="tabpanel">
								
									
									<div class="table-responsive">
									<table id="zero_config" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Plan Name</th>
													<th>Plan Price</th>
													<th>startDate</th>
													<th>Ending Date</th>
													<th>Customer Name</th>
													<th>Billing Email</th>
													<th>Billing Address</th>
													<th>Country</th>
													<th>City</th>
													<th>Zip Code</th>
												
													<th>Validity</th>
													<th>Transaction Id</th>
													<th>Created Date</th>

												</tr>
											</thead>
											<tbody>
											@foreach($subscriptions as $k=> $h)
											<tr>
											<td>{{$k+1}}</td>
											<td>{{$h->plan_name}}</td>
											<td>{{$h->plan_price}}</td>
											<td>{{$h->startDate}}</td>
											<td>{{$h->endDate}}</td>
											<td>{{$h->customer_name}}</td>
											<td>{{$h->billing_email}}</td>
											<td><div style="width:200px;"><textarea rows="4" cols="10" class="form-control" readonly>{{$h->billing_address}}</textarea></div></td>
											<td>{{$h->country}}</td>
											<td>{{$h->city}}</td>
											<td>{{$h->zip_code}}</td>
											<td>{{$h->validity}}</td>
											<td>{{$h->transaction_id}}</td>
											<td>{{$h->created_at}}</td>
										</tr>
											@endforeach														
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
	
		
	</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@stop


