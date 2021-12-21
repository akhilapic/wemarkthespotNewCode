@extends('layouts.admin')
@section('content')

<style>
    .btn_submit:disabled {
    background: #d66821;
    border-color: #d66821;
    opacity: 1;
}
</style>
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">User</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">User</li>
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
					    <h4 class="card-title mb-0">User List</h4> 
						<a style="display:none" href="{{ route('add_user') }}" class="btn btn-info btn-sm">
							Add User
						</a>               
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<div class="">
                                <!-- Alert Append Box -->
                                <div class="result"></div>
                            </div>
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th style="width:150px;">Id.</th>
										<th style="width:500px;">Name</th>
										<th style="width:500px;">Email</th>
										<th style="width:200px;">DOB</th>
										<Th style="width:800px;">Created Date <br>(EST)</Th>
										<th style="width:200px;">Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($users as $user) 
								
									<tr>
										<td>{{ $user->id }}</td>
										<td style="display: table-cell;">
											<a href="javascript:void(0)" class="link">
												<img src="assets/admin/images/theme/user.png" alt="user" width="30" height="30" class="rounded-circle"> 
												<span class="ml-2">{{ $user->name }}</span>
											</a>
										</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->dob }}</td>
												<td>{{ $user->created_at }}</td>
										<td>
											<div class="table_action">
												<a href="{{url('/user-view')}}/{{$user->id}}" class="btn btn-success btn-sm list_view infoU"  data-id='"{{ $user->id }}"' data-bs-whatever="@mdo">
													<i class="mdi mdi-eye"></i>
												</a>  
												<a href="{{ route('user_delete',$user->id) }}" class="btn btn-danger btn-sm  " onclick="return confirm('Are you sure delete this user？')">
													<i class="mdi mdi-delete"></i>
												</a> 
												
												<a style="display: none" href="{{ url('user_edit',$user->id) }}" class="btn btn-info btn-sm list_edit">
													<i class="mdi mdi-lead-pencil"></i>
												</a> 
												<span class="status">
													<label class="switch">
														@if($user->status==1)
														<input data-id="{{$user->id}}" class="  switch-input" onchange="useractivedeactive({{$user->id}},'0');" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
														<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
														<span class="switch-handle"></span> 
														@else
														<input data-id="{{$user->id}}" class="  switch-input" onchange="useractivedeactive({{$user->id}},'1');" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Deactive" data-off="InActive">
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

    <div class="modal fade done_message" id="u_reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel1">Message</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class=""  method="post" action="javascript:void(0)" id="user_deactive">
                            @csrf
                            <div class="mb-3 col-md-12">
                                <input type="hidden" id="user_id" name ="id"/>
                                <input type="hidden"  name ="status" id="status" value="0"/>
                                <label for="Name" class="control-label">Reason:</label>
                                <input type="text" required="true" id="reason" name="reason" class="form-control" id="recipient-name1">
                         
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-danger text-danger font-weight-medium" data-bs-dismiss="modal">Close</button>
                                     <button class="btn btn-success btn_submit loadingbtnap" type="button"  style="display: none" disabled>
                                          <span class="spinner-grow spinner-grow-sm n-success" role="status" aria-hidden="true"></span>
                                          Loading...
                                        </button>
                                    <button type="submit"  id="submit"  class="btn btn-success btn_submit btnokform">Ok</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade done_message" id="u_activemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel1">Message</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
					<div class="modal-body ">
							<form class=""  method="post" action="javascript:void(0)" id="user_deactiveactive">
								@csrf
								<div class="mb-3 col-md-12">
									<input type="hidden" id="user_ids" name ="id"/>
									<input type="hidden"  name ="status" id="status" value="1"/>
									<label for="Name" class="control-label">Message:</label>
									<p id="activenessage">Are you sure you want to Active the User</p>
									<div class="modal-footer">
										<button type="button" class="btn btn-light-danger text-danger font-weight-medium" data-bs-dismiss="modal">Close</button>
										 <button class="btn btn-success btn_submit loadingbtnap" type="button"  style="display: none" disabled>
											  <span class="spinner-grow spinner-grow-sm n-success" role="status" aria-hidden="true"></span>
											  Loading...
											</button>
										<button type="submit"  id="submit"  class="btn btn-success btn_submit btnokform">Ok</button>
									</div>
							</form>
						</div>
					</div>
                </div>
            </div>
        </div>
          <script type="text/javascript">
        	function useractivedeactive($id,$status){

		host_url = "/development/wemarkthespot/";
		var status =$status; //$(this).prop('checked') == true ? 1 : 0; 

		var token = $("meta[name='csrf-token']").attr("content");
		var user_id =$id; //$(this).data('id'); 
	//	alert(user_id+status);
		if(status==0)
		{
			$("#u_reject").modal('show');
			$("#user_id").val(user_id);
			$("#status").val(status);

		}
		else if(status==1)
		{
			$("#u_activemodal").modal('show');
			$("#user_ids").val(user_id);
			$("#status").val(status);

		}
		else
		{
			$.ajax({
				type: "POST",
				dataType: "json",
				url: host_url+'userchangestatus',
				data: {'_token':  token,'status': status, 'user_id': user_id},
				success: function(data){
				  setTimeout(function(){
					  jQuery('.result').html('');
					  window.location.reload();
				  }, 1000);
				}
			});
		}
		
	}


$("#user_deactiveactive").validate({
	// rules: {
		
	// 	reason: {required: true,},
	// 	},
	// 	messages: {
	// 	reason: {required: "Please enter reason",},
	// },
		submitHandler: function(form) {
		   var formData= new FormData(jQuery('#user_deactiveactive')[0]);
	//alert("user_id"+$("#user_id").val());
		 //  formData.append("user_id",$("#user_id").val());
		 
		jQuery.ajax({
				url: host_url+"userchangestatusactive",
				type: "post",
				cache: false,
				data: formData,
				processData: false,
				contentType: false,
				beforeSend: function(msg){
        		$(".loadingbtnap").css("display","block");
        		$(".btnokform").hide();

      		},
      		success:function(data) { 
				var obj = JSON.parse(data);
				if(obj.status==true)
				{
					$("#u_activemodal").modal('hide');
					jQuery('#name_error').html('');
					jQuery('#email_error').html('');
					jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
		
					setTimeout(function(){
						
						window.location = host_url+"user_list";
					}, 3000);
				}
				
				}
			});
		}
	});

$("#user_deactive").validate({
	rules: {
		
		reason: {required: true,},
		},
		messages: {
		reason: {required: "Please enter reason",},
	},
		submitHandler: function(form) {
		   var formData= new FormData(jQuery('#user_deactive')[0]);
	//alert("user_id"+$("#user_id").val());
		   formData.append("user_id",$("#user_id").val());
		 
		jQuery.ajax({
				url: host_url+"userchangestatus",
				type: "post",
				cache: false,
				data: formData,
				processData: false,
				contentType: false,
				beforeSend: function(msg){
        $(".loadingbtnap").css("display","block");
        $(".btnokform").hide();

      },
				success:function(data) { 
				var obj = JSON.parse(data);
				if(obj.status==true){
					$("#u_reject").modal('hide');
					jQuery('#name_error').html('');
					jQuery('#email_error').html('');
					jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
				//	jQuery('.result').html('');
					setTimeout(function(){
						
						window.location = host_url+"user_list";
					}, 3000);
				}
				else{
					if(obj.status==false){
						jQuery('#name_error').html(obj.message);
						jQuery('#name_error').css("display", "block");
					}
				}
				}
			});
		}
	});
        </script>

@stop