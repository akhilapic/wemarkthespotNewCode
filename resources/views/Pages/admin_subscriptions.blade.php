@extends('layouts.admin')
@section('content')


<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Subscriptions</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Subscriptions</li>
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
					    <h4 class="card-title mb-0">Subscriptions List</h4> 
						<!-- <a href="{{ url('/add_category') }}" class="btn btn-info btn-sm">
							Add Category
						</a> -->
					</div>
					<div class="card-body">
						<div class="table-responsive">
							  <div class="result"></div>
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
									<tr>
                                        <th>Plans</th>
										<th>Business of the Week</th>
										<th>Featured Business</th>
										<th>Week & Featured Business</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($subscriptions as $user) 
								
									<tr>
										<td><b>Amount</b></td>
										<td style="display: table-cell;">
											<a href="javascript:void(0)" class="link">
												<span class="ml-2">{{ $user->weekBusiness }}</span>
											</a>
										</td>

                                        <td style="display: table-cell;">
											<a href="javascript:void(0)" class="link">
												<span class="ml-2">{{ $user->featuredBusiness }}</span>
											</a>
										</td>

                                        <td style="display: table-cell;">
											<a href="javascript:void(0)" class="link">
												<span class="ml-2">{{ $user->weekAndFeatured }}</span>
											</a>
										</td>

										<!-- <td><textarea readonly rows="5" cols="20">{{ $user->featuredBusiness }}</textarea></td>
										<td><img src="{{$user->image}}" width="150" height="150"/></td>
										<td><textarea readonly rows="5" cols="20">{{$user->weekAndFeatured}}</textarea></td> -->
										
										<td>
											<div class="table_action" style="width: 103px">
												<!-- <a href="{{url('/category-view')}}/{{$user->id}}" class="btn btn-success btn-sm list_view infoU"  data-id='"{{ $user->id }}"' data-bs-whatever="@mdo">
													<i class="mdi mdi-eye"></i>
												</a>  
												<a href="{{ route('category_delete',$user->id) }}" class="btn  btn-danger btn-sm list_delete " onclick="return confirm('Are you sure delete this category？')">
													<i class="mdi mdi-delete"></i>
												</a>  -->
												
												<!-- <a style="display:" href="{{ url('category_edit',$user->id) }}" class="btn btn-info btn-sm list_edit">
													<i class="mdi mdi-lead-pencil"></i>
												</a>  -->

                                                <a style="display:" href="{{ url('subscriptions_edit',$user->id) }}" class="btn btn-info btn-sm list_edit">
													<i class="mdi mdi-lead-pencil"></i>
												</a> 

												<!-- <span class="status" style="display:none">
													<label class="switch">
														<input data-id="{{$user->id}}" class=" category_statuss switch-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
														<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
														<span class="switch-handle"></span> 
													</label>
												</span> -->

												<!-- <span class="status">
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
												</span> -->

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
<!-- <div class="modal fade" id="customer_details_modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
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
</div> -->

<script type="text/javascript">

	// function useractivedeactive($id,$status)
    // {
	// 	host_url = "/development/wemarkthespot/";
	// 	var status =$status; //$(this).prop('checked') == true ? 1 : 0; 

	// 	var token = $("meta[name='csrf-token']").attr("content");
	// 	var user_id =$id; //$(this).data('id'); 
	
    //     $.ajax({
    //         type: "POST",
    //         dataType: "json",
    //         url: host_url+'category_status',
    //         data: {'_token':  token,'status': status, 'id': user_id},
    //         success: function(data){
    //         //	var obj = JSON.parse(data);
        
    //             if(data.status==true)
    //             {
    //                 jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+data.message+"</div>");

    //                 setTimeout(function(){
    //                 jQuery('.result').html('');
    //                 window.location.reload();
    //             }, 3000);
    //             }
                
    //         }
    //     });
	// }

</script>
@stop