@extends('layouts.admin')
@section('content')


<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Business Report</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Business Report</li>
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
					<div class="border-bottom title-part-padding d-flex justify-content-between">
					    <h4 class="card-title mb-0">Business Report List</h4> 
						             
					</div>
					<div class="card-body">
						<div class="table-responsive">
							  <div class="result"></div>
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Id.</th>
										<th>Reported By </th>
										<th>Commented Made By </th>
										
										<th>Comment's Image/Video</th>
										<th>Comment</th>
										<th>Post Date</th>

										<th>Report Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($buinessReports as $user) 
								
									<tr>
										<td>{{ $user->id }}</td>
								
										<td style="display: table-cell;">
											<a href="javascript:void(0)" class="link">
												<img src="{{$user->user_image}}" alt="user" width="30" height="30" class="rounded-circle"> 
												<span class="ml-2">{{ $user->user_name }}</span>
											</a>
										</td>

										<td style="display: table-cell;">
											<a href="javascript:void(0)" class="link">
												<span class="ml-2">{{ $user->business_username }}</span>
											</a>
										</td>


										<td><img src="{{$user->business_reviews_image}}" height="150" width="160"></td>

										<td><textarea readonly rows="5" cols="20">{{ $user->comment }}</textarea></td>
										<td>{{$user->post_date}}</td>
										<td>{{ $user->business_reports_created_date }}</td>
										<td>
											@if($user->report_status==0)
											No action taken
											@elseif($user->report_status==1)
											Mail Send
											@elseif($user->report_status==2)
											Comment Removed
											@endif
										</td>
										<td>
											<div class="table_action">
												
												<a href="javascript:void(0)" class="btn  btn-danger btn-sm list_delete " onclick="report_status_new(1,{{$user->id}},{{$user->business_id}},{{$user->user_id}},{{$user->review_id}})">
													<i class="mdi mdi-delete"></i>
												</a> <a href="javascript:void(0)" onclick="report_status_new(2,{{$user->id}},{{$user->business_id}},{{$user->user_id}},{{$user->review_id}})" class="btn  btn-primary btn-sm ">
													<i class="mdi mdi-message"></i>
												</a> 
												
												
											

													<span class="status" style="display: none;">
													<label class="switch">
														@if($user->status==1)
														<input data-id="{{$user->id}}" class="  switch-input" onchange="useractivedeactive({{$user->id}},'0');" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive"  >
														<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
														<span class="switch-handle"></span> 
														@else
														<input data-id="{{$user->id}}" class="  switch-input" onchange="useractivedeactive({{$user->id}},'1');" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Deactive" data-off="InActive" checked>
														<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
														<span class="switch-handle"></span> 
														@endif
													</label>
												</span>
											</div>
											  
										</td>
									</tr>
									
									@endforeach
									<meta name="csrf-token" content="{{ csrf_token() }}">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->


<!-- This page plugin CSS -->

<!-- Blog Details -->
<div class="modal fade" id="customer_details_modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
				<h4 class="modal-title" id="exampleModalLabel1">User Details</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<div id="user-data">
					{{-- modal data here --}}
				</div>
			</div>

			<div class="modal-footer">
                <button type="button" class="btn btn-light-danger text-danger font-weight-medium" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function report_status_new(report_status_value,business_report_id,business_id,user_id,review_id)
	{
		host_url = "/development/wemarkthespot/";
		if(report_status_value==1)
		{
				if(confirm('Are you sure delete this report?'))
				{
					var token = $("meta[name='csrf-token']").attr("content");
					$.ajax({
						type: "POST",
						dataType: "json",
						url: host_url+'report_status',
						data: {'_token':  token,'business_report_id': business_report_id, 'business_id': business_id,'user_id':user_id,'review_id':review_id,'report_status_value':report_status_value},
						success: function(data){
						//	var obj = JSON.parse(data);
					
							if(data.status==true)
							{
								jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+data.message+"</div>");

								 setTimeout(function(){
							  jQuery('.result').html('');
							//  window.location.reload();
						  }, 3000);
							}
						 
						}
					});
				}

		}
		else if(report_status_value==2)
		{
			var token = $("meta[name='csrf-token']").attr("content");
					$.ajax({
						type: "POST",
						dataType: "json",
						url: host_url+'report_status',
						data: {'_token':  token,'business_report_id': business_report_id, 'business_id': business_id,'user_id':user_id,'review_id':review_id,'report_status_value':report_status_value},
						success: function(data){
						//	var obj = JSON.parse(data);
					
							if(data.status==true)
							{
								jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+data.message+"</div>");

								 setTimeout(function(){
							  jQuery('.result').html('');
							  window.location.reload();
						  }, 3000);
							}
						 
						}
					})
		}

			
	}
	
</script>
<script type="text/javascript">
		function useractivedeactive($id,$status){

		host_url = "/development/wemarkthespot/";
		var status =$status; //$(this).prop('checked') == true ? 1 : 0; 

		var token = $("meta[name='csrf-token']").attr("content");
		var user_id =$id; //$(this).data('id'); 
		
		
		
			$.ajax({
				type: "POST",
				dataType: "json",
				url: host_url+'category_status',
				data: {'_token':  token,'status': status, 'id': user_id},
				success: function(data){
				//	var obj = JSON.parse(data);
			
					if(data.status==true)
					{
						jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+data.message+"</div>");

						 setTimeout(function(){
					  jQuery('.result').html('');
					  window.location.reload();
				  }, 3000);
					}
				 
				}
			});
		
		
	}


</script>
@stop