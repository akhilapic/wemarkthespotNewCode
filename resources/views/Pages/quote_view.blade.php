@extends('layouts.admin')
@section('content')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Quotes View Details</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Quotes View Details</li>
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
					<h4 class="card-title mb-0">Quotes View Details</h4>
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
								<label for="Name" class="control-label" >Quotes Title:</label>
								<input type="text" id="name" name="name" readonly value="{{$quoates->name}}" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="Email" class="control-label">Sub Heading:</label>
								<input type="text" id="short_information" readonly value="{{$quoates->short_information}}" name="short_information" class="form-control">
								{{-- allready exit error --}}
								<label id="short_information_error" class="error"></label>
							</div>
						
                        	<div class="mb-3 col-md-6">
								<label for="username" class="control-label">Image:</label><br>
                                
							    @if($quoates->image)
                                    @if($quoates ->imagevideocheck==1)

											<img src="{{$quoates->image}}" width="150" height="150"/>
											@else
											<video controls width="320" height="100"  autoplay muted loop>
												<source src="{{$quoates->image}}" type="video/mp4" >
												</video>

											@endif
                                @endif

                                {{-- allready exit error --}}
							<label id="image_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-6">
								<label for="username" class="control-label">Description (textual information):</label>
								<textarea readonly class="form-control" id="detail_Information" name="detail_information">{{$quoates->detail_information}}</textarea>
							{{-- allready exit error --}}
							<label id="detail_information_error" class="error"></label>
							</div>
						</div>
						<a type="button" href="{{ url('/quoates_managements') }}"class="btn btn-dark fa-pull-left mt-3">Back</a>
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


