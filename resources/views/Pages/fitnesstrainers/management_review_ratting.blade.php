@extends('layouts.admin')
@section('content')

<style>
.img_box_fix {
    position: relative;
    padding-left: 35px;
    padding-top: 0px;
}
.img_box_fix .rounded-circle {
    position: absolute;
    left: 0;
    top: 0px;
}
.img_video {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 5px;
}
</style>
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Review And Rating Management</h4>
      </div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Review And Rating Management</li>
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
                   <h4 class="card-title mb-0">Review And Rating List</h4> 
                               
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                       <div class="result"></div>
                     <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th ><div style="width:60px;">Id.</div></th>
                              <th><div style="width:250px;">Business Owner Name</div></th>
                              <th><div style="width:200px;">Business Name</div></th>
                              <th><div style="width:100px;">Rating </div></th>
                              <th><div style="width:200px;">Review Image/Video</div></th>
                              <th style="text-align: center;" ><div style="width:200px;">Feedback </div></th>
                              <th><div style="width:200px;">User Name And Profile Picture</div> </th>
                              <th><div style="width:200px;">Date Of Posted Review</div></th>
                              <th><div style="width:200px;">Overall Rating Of Business </div></th>
                              <th><div style="width:100px;">Action</div></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sr=0; ?>
                        @foreach ($buinessReports as $user) 
                        
                           <tr>
                              <td>{{ $sr= $sr+1 }}</td>
                          
                              <td style="display: table-cell;">
                                <div class="img_box_fix">
                                    <!--public/images/userimage.png-->
                                    @if(!empty($user->business_owner_image))
                                    <img src="{{$user->business_owner_image}}" alt="user" width="30" height="30" class="rounded-circle">
                                   <span class="ml-2"> @if($user->business_owner_name)  {{ $user->business_owner_name }} @else No Busniess Owner Name @endif </span>
                                    @else
                                    <img src="{{asset('public/images/userimage.png')}}" alt="user" width="30" height="30" class="rounded-circle">
                                     <span class="ml-2">@if($user->business_owner_name)  {{ $user->business_owner_name }} @else No Busniess Owner Name @endif</span>
                                    @endif
</div>    
                                   
                                                              </td>   

                              <td style="display: table-cell;">
                                 <div class="link img_box_fix">
                                    <!--public/images/userimage.png-->
                                    @if(!empty($user->business_image))
                                    <img src="{{$user->business_image}}" alt="user" width="30" height="30" class="rounded-circle">
                                   <span class="ml-2"> @if($user->business_name)  {{ $user->business_name }} @else No Busniess Name @endif </span>
                                    @else
                                    <img src="{{asset('public/images/userimage.png')}}" alt="user" width="30" height="30" class="rounded-circle">
                                     <span class="ml-2">@if($user->business_name)  {{ $user->business_name }} @else No Busniess Name @endif</span>
                                    @endif
                                     
                                   
</div>
                              </td>

                              <td style="display: table-cell;">
                                 <a href="javascript:void(0)" class="link">
                                    <span class="ml-2">{{ $user->ratting }}</span>
                                 </a>
                              </td>
                              <td> 
                                 @if(!empty($user->business_review_image))
                                 @if($user ->imagevideocheck==1)
                                    <img src="{{$user->business_review_image}}" alt="user" class="img_video"> 
                                    @else
                                    <video controls  class="img_video"  autoplay muted loop>
												<source src="{{$user->business_review_image}}" type="video/mp4" >
												</video>
                                    @endif
                                    @else
                                    <!-- <img src="{{asset('public/images/userimage.png')}}" alt="user" width="30" height="30" class="rounded-circle"> -->
                                 @endif
                              </td>
                              <td><textarea class="form-control" readonly cols="30">{{ $user->review }}</textarea></td>
                                 <td style="display: table-cell;">
                                 <div class="link img_box_fix">
                                    <img src="{{$user->user_image}}" alt="user" width="30" height="30" class="rounded-circle"> 
                                    <span>{{ $user->user_name }}</span>
</div>
                              </td>

                              <td>{{$user->post_date}}</td>
                              <td>{{$user->overall_rating_of_business}}</td>
                           
                              <td style="">
                                 <div class="table_action">
                                    <a href="javascript:void(0)" class="btn  btn-danger btn-sm list_delete " onclick="report_status_new(1,{{$user->business_id}},{{$user->user_id}},{{$user->business_reviews_id}})">
                                       <i class="mdi mdi-delete"></i>
                                    </a> 
                                    
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
   function report_status_new(report_status_value,business_id,user_id,review_id)
   {

      host_url = "/development/wemarkthespot/";
      if(report_status_value==1)
      {
            if(confirm('Are you sure remove this review and ratting?'))
            {
               var token = $("meta[name='csrf-token']").attr("content");
               $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: host_url+'business_review__remove',
                  data: {'_token':  token, 'business_id': business_id,'user_id':user_id,'review_id':review_id,'report_status_value':report_status_value},
                  success: function(data){
                  // var obj = JSON.parse(data);
               
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
                  // var obj = JSON.parse(data);
               
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
            // var obj = JSON.parse(data);
         
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