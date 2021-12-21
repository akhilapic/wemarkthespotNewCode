<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title> Spot </title>
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
      <!-- <script src="{{asset('assets/js/customvalidation.js')}}"></script> -->
   </head>
   <body>
      <!-- header -->
      <header>
         <div class="container-fluid d-flex py-3">
            <a class="logo" href="index.html"><img src="{{asset('assets/images/logo.svg')}}"></a>
            <button class="backBTN ms-auto" onclick="history.go(-1); return false;"><span class="icon-close-2"></span></button>
         </div>
      </header>
      <main class="mt-0">
         <section class="loginSection">
            <div class="container-fluid">
               <div class="row gy-5">
                  <div class="col-lg-6 d-none d-lg-block">
                     <img src="{{asset('assets/images/Address-amico.png')}}">
                  </div>
                  <div class="col-lg-5 offset-lg-1">
                     <div class="login mt-2 mt-lg-0">
                        <div class=" text-center mb-3">
                           <h1 class="title">Sign Up</h1>
                           <p>Create your own account</p>
                        </div>
                        <form method="POST" action="{{route('signupuser')}}" enctype="multipart/form-data"> 
                           <input type="file" type="file" name="image" accept="image/*"/>
                           <input type="text" name="name" value="" id="name" placeholder="Full Name" />
                           <input type="email" name="email" placeholder="Email" id="email" />
                           <input type="number" name="phone" placeholder="Enter Mobile Number" id="phone" />
                           <input type="text" name="location" placeholder="Enter Location" id="location" />
                           <input type="password" name="password" placeholder="Enter Password" id="password" />
                           <input type="password" name="cpassword" placeholder="Enter Confirm Password"  id="cpassword"/>

                           <div class="mb-3">
                              <div><label for="businesType" class="form-label">Select Business Type</label></div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="busines_type" id="inlineRadio3" value="1">
                                 <label class="form-check-label" for="inlineRadio3">Online Only</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="busines_type" id="inlineRadio4" value="2">
                                 <label class="form-check-label" for="inlineRadio4">Physical Location</label>
                              </div>
                           </div>
                             <div class="mb-3 d-flex">
                              <label for="businesType" class="form-label">Upload Commercial License</label>
                              <button type="button" data-val="0" onclick="plusbtn()" class="ms-auto btn plusBTN" data-val="0"><span class="icon-plus"></span></button>
                              <span id="uploaddocerror"></span>
                           </div>
                             <input type="file" name="upload_doc" class="form-control" id="upload_doc"/>
                                 <div class="mb-2 form-check ps-0">
                              <input type="checkbox" class="form-check-input" required id="exampleCheck3">
                              <label class="form-check-label" for="exampleCheck3">I accept <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a></label>
                           </div>
                           <input type="submit" name="" class="form-control" value="Sign Up" id="submitbtn">
                        </form>


                           <form  style="display: none"  action="{{route('signupuser')}}"  method="post" enctype="multipart/form-data">
                            @csrf
                           <div class="thumb-up mb-5">
                              <div class="profile-box d-flex flex-wrap align-content-center">
                                 <img class="profile-pic" src="{{asset('assets/images/user-thumb.png')}}">
                              </div>
                              <div class="p-image">
                                 <button type="button" value="login" class="btn upload-button"><span class="icon-camera"></span></button>
                                 <input class="file-upload" type="file" name="image" accept="image/*">
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="name" class="form-label">Business Owner Name</label>
                              <input type="text" class="form-control" id="name1" name="name"  placeholder="Enter Business Owner Name">
                           </div>
                           <span id="error_name"></span>
                           <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control"  name="email1" email="email" placeholder="Enter Email">
                           </div>
                           <div class="mb-3">
                              <label for="phone-number" class="form-label">Phone Number <span>(Optional)</span></label>
                             
                              <input type="number" class="form-control" name="phone1" id="phone" placeholder="Enter Phone Number"/>
                           </div>
                           <div class="mb-3 iconinput">
                              <label for="location" class="form-label">Location</label>
                              <input type="text" class="form-control"  name="location1" id="location" placeholder="Enter Location">
                              <span class="icon-gps"></span>
                           </div>
                           <div class="mb-3 iconinput">
                              <label for="location" class="form-label">Password</label>
                              <input type="password" id="password"  class="form-control" name="password" id="password1" placeholder="Enter Password">
                           </div>
                           <div class="mb-3 iconinput">
                              <label for="location" class="form-label">Confirm Password</label>
                              <input type="password" class="form-control"  name="cpassword" id="cpassword1" placeholder="Enter Confirm Password">
                           </div>
                           <div class="mb-3">
                              <div><label for="businesType" class="form-label">Select Business Type</label></div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="busines_type" id="inlineRadio31" value="1">
                                 <label class="form-check-label" for="inlineRadio3">Online Only</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="busines_type" id="inlineRadio41" value="2">
                                 <label class="form-check-label" for="inlineRadio4">Physical Location</label>
                              </div>
                           </div>
                           <div class="mb-3 d-flex">
                              <label for="businesType" class="form-label">Upload Commercial License</label>
                              <button type="button" data-val="0" onclick="plusbtn()" class="ms-auto btn plusBTN" data-val="0"><span class="icon-plus"></span></button>
                              <span id="uploaddocerror"></span>
                           </div>
                           <input type="file" name="upload_doc" class="form-control" id="upload_docs"/>
                           <div class="mb-2 form-check ps-0">
                              <input type="checkbox" class="form-check-input" required id="exampleCheck3">
                              <label class="form-check-label" for="exampleCheck3">I accept <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a></label>
                           </div>
                           <div class="w-75 mx-auto mt-5">

                              <input type="submit" class="btn btn-primary w-100"  value="Sign Up" >
                           </div>
                        </form>
                        <p class="allredy-account my-4 text-center">Already have an account? <a href="{{url('login')}}">Sign In</a></p>
                        
                     
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>

     <!-- Modal -->
      <div class="modal fade" id="approval" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center" style="padding: 30px">
                  <h5>Please verify your Email Address ! </h5>
                  <p>After that admin will approve your account than you will be able to Sign In.</p>
                  <button type="button" class="btn btn-primary mt-4" data-bs-dismiss="modal" aria-label="Close">Ok</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Scripts -->
      <script src="{{asset('assets/js/jquery.min.js')}}"></script>
      <script src="{{asset('assets/js/popper.min.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap.min.js')}} "></script>
      <script src="{{asset('assets/js/custom.js')}}"></script>
<!--      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

   </body>
</html>
<script>
function plusbtn()
{

   if($(".plusBTN").data("val")=="0")
   {
      $("#upload_doc").show();
      $(".plusBTN").attr("data-val",1);

   }
}
$(function(){
 $("#upload_doc").hide();
  
 // $("#submitbtn").on("click",function(){
 //       name = $("#name").val();
 //   email = $("#email").val();
 //   phone = $("#phone").val();
 //   location = $("#location").val();
 //   password = $("#password").val();
 //   cpassword = $("#cpassword").val();
 //   $upload_doc = $("#upload_doc").val();
 //   if(name=='')
 //   {
 //      alert("Enter Name")
 //   }
 // });

   $("#btnsubmit2").on("click",function(e){
      
       e.preventDefault();
          name = $("#name").val();
   email = $("#email").val();
   phone = $("#phone").val();
   location = $("#location").val();
   password = $("#password").val();
   cpassword = $("#cpassword").val();
   $upload_doc = $("#upload_doc").val();
   alert(name);
   // if(name=='')
   // {
   //    $("#error_name").text("Please Enter Name");
   //    return false;
   // }
   // else if(email=='')
   // {
   //    $("#error_email").text("Please Enter Email");
   //    return false;
   // }

   // if(location=='')
   // {
   //    $("#error_name").text("Please Enter location");
   //    return false;
   // }
   });
});
/*
$(document).on('submit', 'form', function(e){
    e.preventDefault();
    //your code goes here
    //100% works
  
     name = $("#name").val();
   email = $("#email").val();
   phone = $("#phone").val();
   location = $("#location").val();
   password = $("#password").val();
   cpassword = $("#cpassword").val();
   $upload_doc = $("#upload_doc").val();
   if(name=='')
   {
      $("#name").text("Please Enter Name");
      alert("Please Enter Name");
      return;
   }
   else if(email=='')
   {
      $("#error_email").text("Please Enter Email");
      return false;
   }

   if(location=='')
   {
      $("#error_name").text("Please Enter location");
      return false;
   }
    return;
});*/
/*
function submitf(e)
{
 
   e.preventDefault();
  
    name = $("#name").val();
   email = $("#email").val();
   phone = $("#phone").val();
   location = $("#location").val();
   password = $("#password").val();
   cpassword = $("#cpassword").val();
   $upload_doc = $("#upload_doc").val();
   if(name=='')
   {
      $("#error_name").text("Please Enter Name");
      return false;
   }
   else if(email=='')
   {
      $("#error_email").text("Please Enter Email");
      return false;
   }

   if(location=='')
   {
      $("#error_name").text("Please Enter location");
      return false;
   }
}

$("#upload_doc").hide();


   $( "#user_signup" ).submit(function( event ) {
     
    event.preventDefault();
  

});
*/
 //$(function() {

 //  host_url = "/development/wemarkthespot/";
/*  $("#user_signup").validate({
      
   rules: {
      name: {required: true,},
      email: {required: true,email: true,},  
   
      password:{required:true,minlength: 5},
       busines_type:{required:true},
      cpassword: {
            required: true,
            minlength: 5,
            equalTo: "#password"
        },
      phone:{ 

      minlength:10,
      maxlength:10}, 
    location:{required:true},
   
      },
   
   messages: {
      name: {required: "Please enter name",},
      email: {required: "Please enter valid email",
      email: "Please enter valid email",},   
      phone: {required: "Please enter Mobile Number",},
      location:{required:"Please enter location",},
      password: {required: "Please enter password",},
      cpassword: {required: "Please enter confirm password",},
      busines_type:{required:"Please Select  busines Type",},
      upload_doc:{required:"Please Upload Commercial License"},
   },
      submitHandler: function(form) {
         var formData= new FormData(jQuery('#user_signup')[0]);
         formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
         u ="development/wemarkthespot/";
        
      jQuery.ajax({
            url: "signupuser",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            
            success:function(data) { 
            var obj = JSON.parse(data);
            
            if(obj.status==true){
               $(".result").text(obj.message);
               setTimeout(function(){
                   $("#b_trainer").modal('show');
                 //  window.location.href = "emailverification";
               }, 1000);
            }
            else{
               if(obj.statusmobile_number==false){
                  jQuery('#mobile_number_error').html(obj.message);
                  jQuery('#mobile_number_error').css("display", "block");
               }
               else if(obj.statusemail==false){
                  jQuery('#email_error').html('');
                  jQuery('#email_error').html(obj.message);
                  jQuery('#email_error').css("display", "block");
               }
               else{
                  jQuery('#mobile_number_error').html('');
                  jQuery('#email_error').html('');
               }
            }
            }
         });
      }
   }); */

//});

</script>