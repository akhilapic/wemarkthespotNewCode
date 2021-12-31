@extends('layouts.admin')
@section('content')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">User Details</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">User Details</li>
			</ol>
		</div>
	</div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
	<div class="container-fluid">
		<!-- basic table -->
		<div class="row">
			<div class="col-12">
				<div class="card">
				    <div class="card-body">
					    <div class="profile_box">
						@if(!empty($user->image))
						<img src="{{$user->image}}" class="profile_img"> 
							
						@else
						    <img src="{{asset('public/images/userimage.png')}}" class="profile_img"> 
							@endif
							<div class="profile_box_body">
							    <h4>{{$user->name}}</h4>
								<a href="javascript:void(0);"><i class="mdi mdi-email-outline"></i> {{$user->email}}</a>
								<a href="javascript:void(0);"><i class="mdi mdi-phone"></i> {{$user->phone}}</a>
						
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div>
							<!-- Nav tabs -->
							<ul class="nav nav-pills" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-bs-toggle="tab" href="#userdetails" role="tab">
										<span>User Details</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#reviewdetails" role="tab">
										<span>Reviews Details</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#checkin" role="tab">
										<span>Check In</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#Favbusinesses" role="tab">
										<span>Favorite Business</span>
									</a>
								</li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content pt-3">
								<div class="tab-pane active" id="userdetails" role="tabpanel">
									<table class="table table-bordered table_fix_width">
                                        <tbody>
											<tr>
												<th>User Name</th>
												<td>{{$user->name}}</td>
											</tr>
											<tr>
												<th>Email</th>
												<td>{{$user->email}}</td>
											</tr>
											<tr>
												<th>Phone Number</th>
												<td>{{$user->phone}}</td>
											</tr>
												<tr>
												<th>DOB</th>
												<td>{{$user->dob}}</td>
											</tr>
											<tr>
												<th>Reason</th>
												<td>{{$user->reason}}</td>
											</tr>

										</tbody></table>
										<div class="col-md-12">
										<a type="button" href="{{route('user_list')}}" class="btn btn-dark fa-pull-left mt-3">Back</a>
										</div>
								</div>
								<div class="tab-pane" id="reviewdetails" role="tabpanel">
								
									<div class="col-md-5">
										<div class="input-group mb-3" style="display: none;">
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
													<th>Business Name</th>
													<th>Business Image</th>
													<th>Rating</th>
													<th>Review</th>
												</tr>
											</thead>
											<tbody>
												@foreach($business_review as $i=> $review)
												<tr>
													<td class="sorting_1">{{$i+1}}</td>
													<td>
														{{$review->business_name}}
													</td>
													<td>
														@if(!empty($review->business_images))
														<img src="{{$review->business_images}}" class="profile_img" style="width:100px;height:62px;"> 
													@else
						    							<img class="fit_img profile_img" style="width:100px;height:62px;" src="{{asset('public/images/userimage.png')}}" > 
													@endif
													</td>
													@if($review->ratting)
													<td>{{$review->ratting}}</td>
													@else
													<td>0</td>
													@endif
													<td><textarea rows="5" cols="10" readonly>{{$review->review}}</textarea></td>
												</tr>
												@endforeach
											</tfoot>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="checkin" role="tabpanel">
								
									<div class="col-md-5">
										<div class="input-group mb-3" style="display: none;">
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
													<th>Business Name</th>
													<th>Business Image</th>
													<th>Rating</th>
													<th>Review</th>
												</tr>
											</thead>
											<tbody>
												@foreach($checkIn as $i=> $review)
												<tr>
													<td class="sorting_1">{{$i+1}}</td>
													<td>
														{{$review->business_name}}
													</td>
													<td>
														@if(!empty($review->business_images))
														<img src="{{$review->business_images}}" class="profile_img" style="width:100px;height:62px;"> 
													@else
						    							<img class="fit_img profile_img" style="width:100px;height:62px;" src="{{asset('public/images/userimage.png')}}" > 
													@endif
													</td>
													@if($review->ratting)
													<td>{{$review->ratting}}</td>
													@else
													<td>0</td>
													@endif
													<td><textarea rows="5" cols="10" readonly>{{$review->review}}</textarea></td>
												</tr>
												@endforeach
											</tfoot>
										</table>
									</div>
								</div>
							
								<div class="tab-pane" id="Favbusinesses" role="tabpanel">
								
									<div class="col-md-5">
										<div class="input-group mb-3" style="display: none;">
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
													<th>Business Name</th>
													<th>Business Image</th>
													<th>Favorite/Unfavorite</th>
												</tr>
											</thead>
											<tbody>
												@foreach($BusinessFav as $i=> $review)
												<tr>
													<td class="sorting_1">{{$i+1}}</td>
													<td>
														{{$review->business_name}}
													</td>
													<td>
														@if(!empty($review->business_images))
														<img src="{{$review->business_images}}" class="profile_img" style="width:100px;height:62px;"> 
													@else
						    							<img class="fit_img profile_img" style="width:100px;height:62px;" src="{{asset('public/images/userimage.png')}}" > 
													@endif
													</td>
													@if($review->fav=="1")
													<td>Favorite</td>
													@else
													<td>Unfavorite</td>
													@endif
												</tr>
												@endforeach
											</tfoot>
										</table>
									</div>
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


