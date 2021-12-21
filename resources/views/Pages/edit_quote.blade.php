@extends('layouts.admin')
@section('content')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Edit Quotes</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"> Edit Quotes </li>
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
					<h4 class="card-title mb-0">Edit Quotes </h4>
				</div>
				<div class="card-body min_height">
					<form name="Quotes_edit1" id="Quotes_edit1" method="post" action="javascript:void(0)" enctype="multipart/form-data">
						@csrf
					    <div class="row">
							<div class="">
								<!-- Alert Append Box -->
							<div class="result"></div>
							</div>
							<div class="mb-3 col-md-6">
                            <input type="hidden" id="id" name="id" value="{{$quoates->id}}" class="form-control">
								<label for="Name" class="control-label" >Quotes title:</label>
								<input type="text" id="name" name="name" value="{{$quoates->name}}" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="Email" class="control-label">Sub Heading:</label>
								<input type="text" id="short_information" value="{{$quoates->short_information}}" name="short_information" class="form-control">
								{{-- allready exit error --}}
								<label id="short_information_error" class="error"></label>
							</div>
						
                        	<div class="mb-3 col-md-6">
								<label for="username" class="control-label">Image/Video:</label>
                                
								<input type="file" id="iamge" name="image" accept="image/*,video/*"  class="form-control">
                                <input type="hidden" name="old_image" value="{{$quoates->image}}"/>
                                @if($quoates->image)
                                    @if($quoates ->imagevideocheck==1)

											<img src="{{$quoates->image}}" width="150" height="150"/>
											@else
											<video controls width="320" height="100"  autoplay muted loop>
												<source src="{{$quoates->image}}" type="video/mp4" >
												</video>

											@endif
                                @endif
                                <input type="hidden" name="old_image" value="{{$quoates->image}}" />
                                {{-- allready exit error --}}
							<label id="image_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-6">
								<label for="username" class="control-label">Description (textual information):</label>
								<textarea class="form-control" id="detail_Information" name="detail_information">{{$quoates->detail_information}}</textarea>
							{{-- allready exit error --}}
							<label id="detail_information_error" class="error"></label>
							</div>
						</div>
						<a type="button" href="{{ url('/quoates_managements') }}"class="btn btn-dark fa-pull-left mt-3">Back</a>
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
	$("#Quotes_edit1").validate({
	rules: {
		name: {required: true,},
		short_information: {required: true,},  
		
		detail_information: {required: true,},
		},
	messages: {
		name: {required: "Please enter quotes name",},
		short_information: {required: "Please enter short information",},   
	
		detail_information: {required: "Please enter detail information",},
	},
		submitHandler: function(form) {
		   var formData= new FormData(jQuery('#Quotes_edit1')[0]);
		jQuery.ajax({
				url: host_url+"Quotes-edit",
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
						window.location = host_url+"quoates_managements";
					}, 2000);
				}
				else{
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


