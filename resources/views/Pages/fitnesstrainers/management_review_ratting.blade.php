@extends('layouts.admin')
@section('content')


<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Review And Ratting Management</h4>
      </div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Review And Ratting Management</li>
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
                   <h4 class="card-title mb-0">Review And Ratting List</h4> 
                               
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                       <div class="result"></div>
                     <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>Id.</th>
                              <th>Name Of Business Owner </th>
                              <th>Name Of Business </th>
                              <th>Ratting </th>
                              <th>Review Image</th>
                              <th>Feedback Description </th>
                              <th>User Name And Profile Picture </th>
                              <th>Date Of Posted Review</th>
                              <th>Overall Rating Of Business </th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sr=0; ?>
                        @foreach ($buinessReports as $user) 
                        
                           <tr>
                              <td>{{ $sr= $sr+1 }}</td>
                          
                              <td style="display: table-cell;">
                                 <a href="javascript:void(0)" class="link">
                                    <!--public/images/userimage.png-->
                                    @if(!empty($user->business_owner_image))
                                    <img src="{{$user->business_owner_image}}" alt="user" width="30" height="30" class="rounded-circle">
                                   <span class="ml-2"> @if($user->business_owner_name)  {{ $user->business_owner_name }} @else No Busniess Owner Name @endif </span>
                                    @else
                                    <img src="{{asset('public/images/userimage.png')}}" alt="user" width="30" height="30" class="rounded-circle">
                                     <span class="ml-2">@if($user->business_owner_name)  {{ $user->business_owner_name }} @else No Busniess Owner Name @endif</span>
                                    @endif
                                     
                                   
                                 </a>
                              </td>   

                              <td style="display: table-cell;">
                                 <a href="javascript:void(0)" class="link">
                                    <!--public/images/userimage.png-->
                                    @if(!empty($user->business_image))
                                    <img src="{{$user->business_image}}" alt="user" width="30" height="30" class="rounded-circle">
                                   <span class="ml-2"> @if($user->business_name)  {{ $user->business_name }} @else No Busniess Name @endif </span>
                                    @else
                                    <img src="{{asset('public/images/userimage.png')}}" alt="user" width="30" height="30" class="rounded-circle">
                                     <span class="ml-2">@if($user->business_name)  {{ $user->business_name }} @else No Busniess Name @endif</span>
                                    @endif
                                     
                                   
                                 </a>
                              </td>

                              <td style="display: table-cell;">
                                 <a href="javascript:void(0)" class="link">
                                    <span class="ml-2">{{ $user->ratting }}</span>
                                 </a>
                              </td>
                              <td> 
                                 @if(!empty($user->business_review_image))
                                    <img src="{{$user->business_review_image}}" alt="user" width="30" height="30" class="rounded-circle"> 
                                 @else
                                    <img src="{{asset('public/images/userimage.png')}}" alt="user" width="30" height="30" class="rounded-circle">
                                 @endif
                              </td>
                              <td><textarea readonly rows="5" cols="20">{{ $user->review }}</textarea></td>
                                 <td style="display: table-cell;">
                                 <a href="javascript:void(0)" class="link">
                                    <img src="{{$user->user_image}}" alt="user" width="30" height="30" class="rounded-circle"> 
                                    <span class="ml-2">{{ $user->user_name }}</span>
                                 </a>
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