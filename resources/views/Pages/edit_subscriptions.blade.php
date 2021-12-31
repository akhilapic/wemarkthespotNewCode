@extends('layouts.admin')
@section('content')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Edit Subscriptions</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"> Edit Subscriptions </li>
			</ol>
		</div>
	</div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
		<div class="col-6">
			<div class="card">
				<div class="border-bottom title-part-padding">
					<h4 class="card-title mb-0">Edit Subscriptions </h4>
				</div>
				<div class="card-body min_heigh">
					<form name="subscriptions_edit1" id="subscriptions_edit1" method="post" action="javascript:void(0)" enctype="multipart/form-data">
						@csrf
					    <div class="row">
							<div class="">
								<!-- Alert Append Box -->
							<div class="result"></div>
							</div>
							<div class="mb-3 col-md-12">
                            <input type="hidden" id="id" name="id" value="{{$subscriptions->id}}" class="form-control">
								<label for="Name" class="control-label" >Business of the Week:</label>
								<input type="text" id="BusinessoftheWeek" name="BusinessoftheWeek" value="{{$subscriptions->weekBusiness}}" class="form-control" placeholder="Enter price eg. $00.00">
							</div>
							<div class="mb-3 col-md-12">
								<label for="Email" class="control-label">Featured Business:</label>
								<input type="text" id="FeaturedBusiness" value="{{$subscriptions->featuredBusiness}}" name="FeaturedBusiness" class="form-control" placeholder="Enter price eg. $00.00">
								{{-- allready exit error --}}
								<label id="short_information_error" class="error"></label>
							</div>
						
							<div class="mb-3 col-md-12">
								<label for="username" class="control-label">Week & Featured Business: {{$subscriptions->detail_Information}}</label>
                                <input type="text" id="WeekAndFeaturedBusiness" value="{{$subscriptions->weekAndFeatured}}" name="WeekAndFeaturedBusiness" class="form-control" placeholder="Enter price eg. $00.00">
							{{-- allready exit error --}}
							<label id="detail_information_error" class="error"></label>
							</div>
						</div>
						<a type="button" href="{{ url('/admin_subscriptions') }}"class="btn btn-dark fa-pull-left mt-3">Back</a>
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

jQuery.validator.addMethod("pricecheck", function(value, element, param) {
return value.match("^[0-9$.]+$");
},'Please enter valid price including number and $ symbol only.');

	$("#subscriptions_edit1").validate({
	rules: {
		BusinessoftheWeek: {required: true,pricecheck:true,},
        FeaturedBusiness: {required: true, pricecheck:true},
        WeekAndFeaturedBusiness: {required: true, pricecheck:true},
	},
	messages: {
		BusinessoftheWeek: {required: "Please enter weekly business price",},
        FeaturedBusiness: {required: "Please enter featured business price",},
        WeekAndFeaturedBusiness: {required: "Please enter weekly and featured business price",},
	},
		submitHandler: function(form) {
            
		   var formData= new FormData(jQuery('#subscriptions_edit1')[0]);
		    // host_url= "builtenance.com/development/wemarkthespot/";
		   host_url = "/development/wemarkthespot/";

		    jQuery.ajax({
				url:host_url+"subscriptions-update",
				type: "post",
				cache: false,
				data: formData,
				processData: false,
				contentType: false,
				
				success:function(data) { 
                    var obj = JSON.parse(data);
                    if(obj.status==true){
                        jQuery('#name_error').html('');
                        // jQuery('#email_error').html('');
                        jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
                        setTimeout(function(){
                            jQuery('.result').html('');
                            window.location = host_url+"admin_subscriptions";
                        }, 2000);
                    }else{
                        if(obj.status==false){
                            jQuery('.result').html("<div class='alert alert-danger alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Oops - </strong> "+obj.message+"</div>");
                        }
                    }
				}
			});
		}
	});
</script>
@stop


