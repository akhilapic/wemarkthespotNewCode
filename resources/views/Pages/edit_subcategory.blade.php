@extends('layouts.admin')
@section('content')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Edit  Sub Category</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Edit Sub Category </li>
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
					<h4 class="card-title mb-0">Edit Sub Category </h4>
				</div>
				<div class="card-body min_height">
					<form name="subcategory_edit" id="subcategory_edit1" method="post" action="javascript:void(0)" enctype="multipart/form-data">
						@csrf
					    <div class="row">
							<div class="">
								<!-- Alert Append Box -->
							<div class="result"></div>
							</div>
                            <div class="mb-3 col-md-4">
								<label for="Email" class="control-label">Name:</label>
                                <input type="hidden" id="id" name="id" class="form-control" value="{{$subcategorys->id}}">
								<input type="text" id="name" name="name" class="form-control" value="{{$subcategorys->name}}">
								{{-- allready exit error --}}
								<label id="name_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-4">
								<label for="Name" class="control-label" >Select Category:</label>
							    <select id="category_id" name ="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categorylist as $list)
                                        @if($list->id==$subcategorys->category_id)
                                        <option selected value={{$list->id}}>{{$list->name}}</option>
                                        @else
                                        <option value={{$list->id}}>{{$list->name}}</option>
                                        @endif    
                                    
                                    @endforeach    
                                    
                            </select>
							</div>
                            
							<div class="mb-3 col-md-4">
								<label for="Email" class="control-label">Short Information:</label>
								<input type="text" id="short_information" name="short_information" value="{{$subcategorys->short_information}}" class="form-control">
								{{-- allready exit error --}}
								<label id="short_information_error" class="error"></label>
							</div>
						
                        	<div class="mb-3 col-md-6">
								<label for="username" class="control-label">Image:</label>

								<input type="file" id="iamge" name="image"  class="form-control" accept="image/*" onchange="loadFile(event)">
                                <input type="hidden" name="old_image" value="{{$subcategorys->image}}"/>
                                  <img id="output" width="150" height="120" style="display:none" />
                                @if($subcategorys->image)
                                <img src="{{$subcategorys->image}}" id="categoryimgs" width="150" height="150"/>
                                @endif
                                {{-- allready exit error --}}
							<label id="image_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-6">
								<label for="username" class="control-label">Detail Information:</label>
								<textarea class="form-control" id="detail_information" name="detail_information">{{$subcategorys->detail_information}}</textarea>
							{{-- allready exit error --}}
							<label id="detail_Information_error" class="error"></label>
							</div>
						</div>
						<a type="button" href="{{ url('/manager_category') }}"class="btn btn-dark fa-pull-left mt-3">Back</a>
						<input type="submit" id="submit" value="Save" class="btn btn-success btn_submit fa-pull-right mt-3">
					</form>
				</div>
			</div>
		</div>
		
	</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
 <script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
    	$("#output").show();
    	$("#categoryimgs").hide();
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
<script type="text/javascript">
	$("#category_id").on("change",function(){
		category_id = $("#category_id").val();
		if(category_id!='')
		{
			$("#category_id-error").hide();
		}
	});
			$("#subcategory_edit1").validate({
			rules: {
				category_id: {required: true,},
				name: {required: true,},
			//	short_information: {required: true,},  
			
			//	detail_information: {required: true,},
				},
			messages: {
				category_id:{required:"Please select sub category",},
				name: {required: "Please enter sub category name",},
			//	short_information: {required: "Please enter short information",},   
			
				//detail_information: {required: "Please enter detail information",},
			},
				submitHandler: function(form) {
				   var formData= new FormData(jQuery('#subcategory_edit1')[0]);
				jQuery.ajax({
						url: host_url+"subcategory-update",
						type: "post",
						cache: false,
						data: formData,
						processData: false,
						contentType: false,
						
						success:function(data) { 
							var obj = JSON.parse(data);
							if(obj.status==true){
								jQuery('#name_error').html('');
								jQuery('#email_error').html('');
								jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
								setTimeout(function(){
									jQuery('.result').html('');
									window.location = host_url+"manage_sub_category";
								}, 2000);
							}
							else
							{
								if(obj.status==false){
									jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
								}
							
							}
						}
					});
				}
			});
</script>
@stop


