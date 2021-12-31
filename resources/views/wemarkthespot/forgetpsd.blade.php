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
      <meta name="csrf-token" content="{{ csrf_token() }}" />
   </head>
   <style type="text/css">
      label.error {
    display: inline-block;
    width: 100%;
    clear: both;
    margin-top: 8px;
    color: #db0707;
}
   </style>
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
            <div class="row gy-5 align-items-center">
               <div class="col-lg-6 d-none d-lg-block">
                  <img src="{{asset('assets//images/Address-amico.png')}}">
               </div>
               <div class="col-lg-5 offset-lg-1">
                  <div class="login mt-2 mt-lg-0">
                     <div class=" text-center mb-4">
                        <h1 class="title">Forgot Password</h1>
                    
                        <span id="msg_error"></span>
                     </div>

                    
                     
                     <form action="javascript:void(0);" id="manage_business_forgetpsd" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                
                        <div class="mb-3">
                           <label for="emailnumber" class="form-label">Email Address</label>
                           <input type="text" class="form-control" name="email" id="Email1" aria-describedby="emailHelp" placeholder="Enter Email">
                        </div>
                
                        <div class="w-50 mx-auto mt-5">
                           <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                     </form>
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
                  <a id="otpbtn" class="btn btn-primary mt-4"> OK</a>
                  <!-- <button type="button" class="btn btn-primary mt-4" data-bs-dismiss="modal" aria-label="Close">Ok</button> -->
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

<script>

    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });

</script>


      <script>
 jQuery.validator.addMethod("emailExt", function(value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter valid email');

         $("#manage_business_forgetpsd").validate({
        rules: {
            email: {required: true,email: true,maxlength:50,emailExt: true,},  
        },

        messages: {
        email: {required: "Please enter valid email",email: "Please enter valid email",},   

        },
   submitHandler: function(form) {
      var formData= new FormData(jQuery('#manage_business_forgetpsd')[0]);
     
      // u = host_url+"manage_business_signin";
      formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
   jQuery.ajax({
         url: "{{route('forgotPasswordemailcheck')}}",
         type: "POST",
         cache: false,
         data: formData,
         processData: false,
         contentType: false,
         
         success:function(data) { 
         var obj = JSON.parse(data);
         console.log(obj.redriecturl);
         if(obj.status==true){
              $('#staticBackdrop').modal('show');
                $("#msg").text(obj.message);
                $("#otpbtn").attr("href",obj.url);
             $("#otpbtn").show();
//                setTimeout(function(){ window.location.href= obj.url; }, 2000);
                

         }
         else{
               //alert(obj.status);
             if(obj.status==false){
               if(obj.status==false)
               {
                  if(obj.email== false)
                  {
                       $('#staticBackdrop').modal('show');
                       $("#otpbtn").hide();
                         $("#msg").text(obj.message);
                       $("#msg_error").css({"display": "block", "color": "red"}); 
                       setTimeout(function(){  
                        $('#staticBackdrop').modal('hide');
                    }, 3000);
                           //jQuery('#msg_error').html('');
                           //$("#otpbtn").attr("data-dismiss","modal");
                       
                    
                  }
               else
               {

               
               //   alert(obj.message);
                $('#staticBackdrop').modal('show');

                $("#msg").text(obj.message);
                  jQuery('#msg_error').html('');
                
              $("#msg_error").css({"display": "block", "color": "red"}); 
               }
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