<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
  <main class="mt-lg-0">
      <section class="otp-verification">
         <div class="container-fluid">
            <div class="row gy-5">
               <div class="col-lg-6 p-5 p-lg-0">
                  <img src="{{asset('assets/images/Forgot-password.png')}}">
               </div>
               <div class="col-lg-6 col-xl-5 offset-xl-1 d-flex align-items-center">
                  <div class="login text-center w-100">
                     <div class=" text-center">
                        <h1 class="title">OTP Verification</h1>
                        <p>We have sent a verification code to your registered email address</p>
                          <span id="timer">Time left: 2:00</span>
                        <span id="errormsg" style="color:red"></span>
                     </div>
                       @if (\Session::has('message'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                     <form action="{{url('change-password')}}" id="verify_otp" method="post">
                        @csrf
                     <input type="hidden" name="email" value="{{$user_data->email}}">
                        <div class="my-5 d-flex justify-content-center digit-group"  data-group-name="digits" data-autosubmit="false" autocomplete="off">
                           <input type="text" name="digit1" maxlength="1" id="digit-1" data-next="digit-2" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" >
                           <input type="text" name="digit2" maxlength="1" id="digit-2" data-next="digit-3" data-previous="digit-1" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  class="form-control" >
                           <input type="text" name="digit3" maxlength="1" id="digit-3" data-next="digit-4" data-previous="digit-2" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" >
                           <input type="text" name="digit4" maxlength="1" id="digit-4" data-next="digit-5" data-previous="digit-3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" >
                           <input type="text" name="digit5" maxlength="1" id="digit-5" data-next="digit-6" data-previous="digit-4" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" >
                           <input type="text" name="digit6" maxlength="1" id="digit-6" data-next="digit-7" data-previous="digit-5" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" >
                        </div>
                         <span id="errormsgotp" style="color:Red"></span>
                      
                       
                        <div class="w-50 mx-auto my-5">
                           <button type="submit" class="btn btn-primary w-100">Verify</button>
                        </div>
                         <a href="{{$resend_otp}}" disabled class="f-16 fm secondary-100 " disabled = "true" id="resendotp">Resend OTP</a>
                          <span id="lblrecendotp" >Resend OTP</span>
                     </form>
       <!--               <form method="get" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                     <input type="text" id="digit-1" name="digit-1" data-next="digit-2" />
                     <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                     <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                     <input type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
</form> -->
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
                  <p>Your business will not be verified unless you include a 
                     commercial license
                  </p>
                  <button type="button" class="btn btn-primary mt-4" data-bs-dismiss="modal" aria-label="Close">Ok</button>
               </div>
            </div>
         </div>
      </div>
@include("inc/footer");
<script>
   let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = "Your OTP Expire In "+ m + ':' + s;
  remaining -= 1;
  

  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }
  else
  {
   $("#lblrecendotp").hide();
     $('#resendotp').show();
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  // alert('Timeout for otp');
}
//timer(120);
timer(60);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
   $(function(){
         $("#lblrecendotp").css({"color":'#d66821','cursor':"no-drop"});
      $("#resendotp").hide();
   
   $("#verify_otp").validate({
      rules: {
         // digit1: {
         //    required: true,
         // },
         // digit2: {
         //    required: true,
         // },
         // digit3: {
         //    required: true,
         // },
         // digit4: {
         //    required: true,
         // },
         // digit5: {
         //    required: true,
         // },

         // digit6: {
         //    required: true,
         // },
      },
      
      messages: {
         // digit1: {required: "Please enter otp",},
         // digit2: {required: "Please enter otp",},
         // digit3: {required: "Please enter otp",},
         // digit4: {required: "Please enter otp",},
         // digit5: {required: "Please enter otp",},
         // digit6: {required: "Please enter otp",},

      },
      submitHandler: function(form) {
         var formData= new FormData(jQuery('#verify_otp')[0]);
      formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
         // u ="development/wemarkthespot/";
        
      jQuery.ajax({
            url: "{{route('webverify_otp')}}",
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
                   window.location.href ="{{route('signin')}}" ;
               }, 1000);
            }
            else{
               $(".alert-success").hide();
               if(obj.status==false){
                  if(obj.otp==false)
                  {
                     $("#errormsgotp").text(obj.message);
                   $(".result").text(obj.message);
                  }
                  else
                  {
                      $("#errormsg").text(obj.message);   
                  // $(".result").text(obj.message);  
                  }
              
               }
               else{
                   $("#errormsg").text('');   
               //   jQuery('#email_error').html('');
               }
            }
            }
         });
      }
   }); 
});
</script>

<script>
$('.digit-group').find('input').each(function() {
   $(this).attr('maxlength', 1);
   $(this).on('keyup', function(e) {
      var parent = $($(this).parent());
      
      if(e.keyCode === 8 || e.keyCode === 37) {
         var prev = parent.find('input#' + $(this).data('previous'));
         
         if(prev.length) {
            $(prev).select();
         }
      } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
         var next = parent.find('input#' + $(this).data('next'));
         
         if(next.length) {
            $(next).select();
         } else {
            if(parent.data('autosubmit')) {
               parent.submit();
            }
         }
      }
   });
});   
</script>

<style>
.digit-group label.error {
    display: none !important;
}	
</style>