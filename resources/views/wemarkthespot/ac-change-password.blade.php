<?php

 $base_url =  URL::to('/');
?>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
<style>
   label.error {
    display: inline-block;
    width: 100%;
    clear: both;
    margin-top: 8px;
    color: #db0707;
}
#eye1 {
    position: absolute;
    right: 15px;
    top: 48px;
}
#eye2 {
    position: absolute;
    right: 15px;
    top: 48px;
}
#eye3 {
    position: absolute;
    right: 15px;
    top: 48px;
}
</style>
@include("inc/header");
 <main class="my-notification">
         <div class="container-fluid">
            <h1 class="title">Account Settings</h1>
            <div class="row gy-5">
               <div class="col-md-4 pe-lg-5">
                  <aside>
                     <div class="BoxShade UserBox mb-4">
                        <figure>  @if($account->business_images)   
                        <img src="{{$account->business_images}}">
                        @else
                        <img src="{{asset('assets/images/img-6.png')}}">
                        @endif
                     </figure>
                     @if($account->business_name)  
                     <p>{{$account->business_name}}</p>
                     @else
                     <p>Business Name</p>
                     @endif
                        <p class="rating">@if($account->ratting) {{$account->ratting}} @else 0 @endif  <span class="icon-star"></span></p>
                        <p class="verify">Verified</p>
                     </div>
                     <div class="BoxShade">
                        <ul>
                           <li><a href="{{url('my_account')}}">My Profile</a></li>
                           <li><a href="{{url('my-subscription')}}">My Subscription</a></li>
                           <li><a href="{{url('notifications')}}">Notifications</a></li>
                           <li class="active"><a href="{{url('ac-change-password')}}">Change Password</a></li>
                           <li ><a href="{{url('faqs')}}">FAQs</a></li>
                           <li ><a href="{{url('contact-us')}}">Contact Us</a></li>
                           <li><a href="{{url('/websignout')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               <div class="col-md-8">
                  <label class="result error" style="font-size: 1rem;
    font-weight: 600;"></label>
                  <h4 class="acTitle">Change Password</h4>
                  <form  action="javascript:void(0)" id="business_user_change_psd" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                   <input type="hidden" name="id" value="{{$account->id}}"/>
                     <div class="mb-4" style="
    position: relative;
">
                        <label class="form-label">Current Password</label>
                        <input type="text" class="form-control" name ="old_password" id ="old_password"  placeholder="Enter Current Password">
                        <span class="fa fa-eye-slash input_icon" id="eye1" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                     </div>
                     <div class="mb-4" style="
    position: relative;
">
                        <label class="form-label">New Password</label>
                        <input type="text" class="form-control" id="new_password" name ="new_password" placeholder="Enter New Password">
                        <span class="fa fa-eye-slash input_icon" id="eye2" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                     </div>
                     <div class="mb-4" style="
    position: relative;
">
                        <label class="form-label">Confirm Password</label>
                        <input type="text" class="form-control" name ="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
                        <span class="fa fa-eye-slash input_icon" id="eye3" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                     </div>
                     <div class="text-center"><input type="submit" id="admin_change_psd" class="btn btn-primary mt-4" value="Update" /></div>
                  </form>
                  
               </div>
            </div>
         </div>
      </main>
  
      <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.min.js')}} "></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
      <script>

$("#eye1").on("click",function(){
		 	
          type=$("#old_password").attr("type");
               if(type=='password')
                {
                   $("#eye1").removeClass("fa-eye-slash");
                   $("#eye1").addClass("fa-eye");
                   $("#old_password").attr("type",'text');
                }
                else
                {
                   $("#eye1").addClass("fa-eye-slash");
                   $("#eye1").removeClass("fa-eye");
                   $("#old_password").attr("type",'password');
                }
       });
       $("#eye2").on("click",function(){
		 	
          type=$("#new_password").attr("type");
               if(type=='password')
                {
                   $("#eye2").removeClass("fa-eye-slash");
                   $("#eye2").addClass("fa-eye");
                   $("#new_password").attr("type",'text');
                }
                else
                {
                   $("#eye2").addClass("fa-eye-slash");
                   $("#eye2").removeClass("fa-eye");
                   $("#new_password").attr("type",'password');
                }
       });
       $("#eye3").on("click",function(){
		 	
          type=$("#confirm_password").attr("type");
               if(type=='password')
                {
                   $("#eye3").removeClass("fa-eye-slash");
                   $("#eye3").addClass("fa-eye");
                   $("#confirm_password").attr("type",'text');
                }
                else
                {
                   $("#eye3").addClass("fa-eye-slash");
                   $("#eye3").removeClass("fa-eye");
                   $("#confirm_password").attr("type",'password');
                }
       });
         patten ="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$";


jQuery.validator.addMethod("passwordcheck", function(value, element, param) {
return value.match(patten);
},'Please enter valid password');

         	$("#business_user_change_psd").validate({
		rules: {
			old_password: {required: true,passwordcheck:true,},
			
			new_password: {required: true,passwordcheck:true,},
			
			confirm_password : {
				required: true,
				equalTo : "#new_password"
			}
		},
			
		messages: {
	
			old_password: {required: "Please enter old password",},
			new_password:{required:"Please enter new password",},
	
		
		confirm_password:{required:"Please enter confirm password", equalTo:"Password and confirm password must be same"},
		},
			submitHandler: function(form) {
			   var formData= new FormData(jQuery('#business_user_change_psd')[0]);
            host_url = "/development/wemarkthespot/";
			jQuery.ajax({
					url: host_url+"business_user_change_psd",
					type: "POST",
					cache: false,
					data: formData,
					processData: false,
					contentType: false,
					
					success:function(data) { 
					
					var obj = JSON.parse(data);
					
					if(obj.status==true){
						jQuery('#name_error').html('');
						jQuery('#email_error').html('');
						jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Change Password Successfully.</strong> </div>");
						setTimeout(function(){
							jQuery('.result').html('');
							window.location = host_url+"websignout";
						}, 2000);
					}
					else{
						if(obj.status==false){
							jQuery('.result').html(obj.message);
							jQuery('#name_error').css("display", "block");
						}
						
					}
					}
				});
			}
		});
      </script>
@include("inc/footer");
