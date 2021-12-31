@extends('layouts.admin')
@section('content')


<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Quotes</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Quotes</li>
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
					    <h4 class="card-title mb-0">Quotes List</h4> 
						<a style="display:none" href="{{ url('/add_quotes') }}" class="btn btn-info btn-sm">
							Add Quotes
						</a>               
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Id.</th>
										<th>Title</th>
											<th>Sub Heading</th>
										<th>Attachment</th>
										<Th>Detail Information</Th>
										<Th>Created Date</Th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(!empty($quoates))

								@foreach ($quoates as $user) 
								
									<tr>
										<td>{{ $user->id }}</td>
										<td style="display: table-cell;">
											<a href="javascript:void(0)" class="link">
												<span class="ml-2">{{ $user->name }}</span>
											</a>
										</td>
										<td>{{ $user->short_information }}</td>
										<td>
											@if($user ->imagevideocheck==1)

											<img src="{{$user->image}}" width="150" height="150"/>
											@else
											<video controls width="320" height="100"  autoplay muted loop>
												<source src="{{$user->image}}" type="video/mp4" >
												</video>

											@endif
										</td>
										<td>{{$user->detail_information}}</td>
												<td>{{ $user->created_at }}</td>
										<td>
											<div class="table_action">
												<a href="{{url('/quote-view')}}/{{$user->id}}" class="btn btn-success btn-sm list_view infoU"  data-id='"{{ $user->id }}"' data-bs-whatever="@mdo">
													<i class="mdi mdi-eye"></i>
												</a>  
												<a style="display:none" href="{{ route('category_delete',$user->id) }}" class="btn deleteConf btn-danger btn-sm list_delete ">
													<i class="mdi mdi-delete"></i>
												</a> 
												
												<a style="display: " href="{{ url('quote_edit',$user->id) }}" class="btn btn-info btn-sm list_edit">
													<i class="mdi mdi-lead-pencil"></i>
												</a> 
										<!-- 		<span class="status">
													<label class="switch">
														<input data-id="{{$user->id}}" class=" category_status switch-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
														<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
														<span class="switch-handle"></span> 
													</label>
													
												</span> -->
											</div>
											  
										</td>
									</tr>
									
									@endforeach
                                    @endif
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

@stop