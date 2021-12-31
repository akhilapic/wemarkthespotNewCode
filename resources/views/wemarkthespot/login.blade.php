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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <style>
#eye1 {
    position: absolute;
    right: 15px;
    top: 48px;
}
label.error {
    display: inline-block;
    width: 100%;
    clear: both;
    margin-top: 8px;
    color: #db0707;
}

   </style>
<!-- <script type="text/javascript">
   jQuery(document).ready(function($) {

  if (window.history && window.history.pushState) {

    window.history.pushState('forward', null, './#forward');

    $(window).on('popstate', function() {
      alert('Back button was pressed.');
    });

  }
});
</script> -->
   </head>
   <body>
      <!-- header -->
      <header>
         <div class="container-fluid d-flex py-3">
            <a class="logo" href="{{url('/')}}"><img src="{{asset('assets/images/logo.svg')}}"></a>
            <button class="backBTN ms-auto" onclick="redirect()"><span class="icon-close-2"></span></button>
         </div>
      </header>
      <main class="mt-0">
      <section class="loginSection">
         <div class="container-fluid">
            <div class="row gy-5">
               <div class="col-lg-6 d-none d-lg-block">
                  <img src="{{asset('assets//images/Address-amico.png')}}">
               </div>
               <div class="col-lg-5 offset-lg-1">
                  <div class="login mt-2 mt-lg-0">
                     <div class=" text-center mb-4">
                        <h1 class="title">Sign in</h1>
                        <p>Sign in to your account</p>
                        <span id="msg_error"></span>
                     </div>

                    
                     
                     <form action="javascript:void(0);" id="manage_business_signin" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                       <!--  <div class="thumb-up mb-5">
                           <div class="profile-box d-flex flex-wrap align-content-center">
                              <img class="profile-pic" src="{{asset('assets/images/user-thumb.png')}}">
                           </div>
                           <div class="p-image">
                              <button type="button" value="login" class="btn upload-button"><span class="icon-camera"></span></button>
                              <input class="file-upload" type="file" accept="image/*">
                           </div>
                        </div> -->
                        <div class="mb-3">
                           <label for="emailnumber" class="form-label">Email Address</label>
                           <input type="text" class="form-control" name="email" id="Email1" aria-describedby="emailHelp" placeholder="Enter Email">
                        </div>
                        <div class="mb-3" style="position:relative;">
                           <label for="password" class="form-label">Password</label>
                           <input type="password" class="form-control" name="password" id="Password1" placeholder="Enter Password">
                           <span class="fa fa-eye-slash input_icon" id="eye1" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                        </div>
                        <div class="mb-2 form-check ps-0">
                           <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                           <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                           <a class="forgot float-end" href="{{url('forgetpsd')}}">Forgot Password?</a>
                        </div>
                        <div class="w-50 mx-auto mt-5">
                           <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </div>
                     </form>
                     <p class="allredy-account my-4 text-center">Don't have an account? <a href="{{url('signup')}}">Sign Up</a></p>
                    
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
     <!-- Modal -->
      <div class="modal fade modelStyle show" id="staticBackdrop">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center">
                  <p id="msg">
                  </p>
                  <button type="button" class="btn btn-primary mt-4" data-bs-dismiss="modal" aria-label="Close">Ok</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Scripts -->
      <script src="{{asset('assets/js/jquery.min.js')}} "></script>
      <script src="{{asset('assets/js/popper.min.js')}} "></script>
      <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript">
   function redirect()
   {
      window.location.href = "{{url('/')}}";
   }
</script>
<script>
	$(function(){
  $("#eye1").on("click",function(){
		 	
			type=$("input[name='"+$(this).data("name")+"']").attr("type");
				  if(type=='password')
					{
						$("#eye1").removeClass("fa-eye-slash");
						$("#eye1").addClass("fa-eye");
						$("input[name='"+$(this).data("name")+"']").attr("type",'text');
					}
					else
					{
						$("#eye1").addClass("fa-eye-slash");
						$("#eye1").removeClass("fa-eye");
						$("input[name='"+$(this).data("name")+"']").attr("type",'password');
					}
        		
		  
		});

 // $(".input_icon").on("click",function(){
        	
	// 		type=$("input[name='"+$(this).data("name")+"']").attr("type");
 //            if(type=='password')
	// 		{
	// 			$("input[name='"+$(this).data("name")+"']").attr("type",'text');
	// 		}
	// 		else
	// 		{
	// 			$("input[name='"+$(this).data("name")+"']").attr("type",'password');
	// 		}
	// 	});
	});

    </script>
      <script>
          jQuery.validator.addMethod("emailExt", function(value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter valid email');

         $("#manage_business_signin").validate({
rules: {
   password: {required: true,},
   email: {required: true,email: true,maxlength:50,emailExt: true,}, 

   },

messages: {
   password: {required: "Please enter password",},
   email: {required: "Please enter valid email",email: "Please enter valid email",},   

},
   submitHandler: function(form) {
      var formData= new FormData(jQuery('#manage_business_signin')[0]);
     
      // u = host_url+"manage_business_signin";
     
   jQuery.ajax({
         url: "{{route('manage_business_signin')}}",
         type: "post",
         cache: false,
         data: formData,
         processData: false,
         contentType: false,
         
         success:function(data) { 
      //   var obj = JSON.parse(data);
         if(data.status==true){
              $('#staticBackdrop').modal('show');

                $("#msg").text(data.message);
            window.location.href= "{{route('my_account')}}";

         }
         else{
               //alert(obj.status);
             if(data.status==false){
               if(data.status==false)
               {
                   $('#staticBackdrop').modal('show');

                $("#msg").text(data.message);
               //   alert(obj.message);
            //    $('#staticBackdrop').modal('show');

//                $(".msg_error").text(obj.message);
             //     jQuery('#msg_error').html('<span>'+obj.message+'</span>');
                  //jQuery('#msg_error').html(obj.message);
            //jQuery('#msg_error').css("display", "block");
            //    jQuery('#msg_error').css({'display','block','color':'red'});
             // $("#msg_error").css({"display": "block", "color": "red"}); 
               }
               
               else
               {
                  jQuery('#msg_error').css("display", "none");
               }
               
            }
            else{
               jQuery('#mobile_number_error').html('');
               jQuery('#email_error').html('');
            }
         }
         }
      });
   }
});


      </script>
   </body>
</html>