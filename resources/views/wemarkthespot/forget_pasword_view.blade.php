<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>

#eye1,#eye2 {
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
    <main class="mt-lg-0">
      <section class="change-password">
         <div class="container-fluid">
            <div class="row gy-5">
               <div class="col-lg-6 p-5 p-lg-0">
                  <img src="{{asset('assets/images/Forgot-password.png')}}">
               </div>
               <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                  <div class="login w-100">
                     <div class=" text-center mb-4">
                        <h1 class="title">Forgot Password</h1>
                     </div>
                     <span id="error_message" style="color:green"></span>
                     <form class="mt-100" action="" method="POST" id="forget_pasdform">
                     <input type="hidden" name="email" value="{{$user_data->email}}"/>   
                     <div class="mb-4" style="position:relative;">
                           <label for="password" class="form-label">New Password</label>
                           <input type="password" class="form-control special_characters_type" id="password" name="password" placeholder="Enter New Password">
                           <span class="fa fa-eye-slash input_icon" id="eye1" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                              <div class="password_hints" id="password_hints">
                           <h4>Password must meet the following requirements:</h4>
                           <ul>
                              <li id="letter" class="invalid letter">At least <strong>one special character</strong></li>
                              <li id="capital" class="invalid capital">At least <strong>one capital letter</strong></li>
                              <li id="small" class="invalid small">At least <strong>one small letter</strong></li>
                              <li id="number" class="invalid number">At least <strong>one number</strong></li>
                              <li id="length" class="invalid length">Be at least <strong>6 characters</strong></li>
                           </ul>
                        </div>   
                        </div>
                        <div class="mb-4" style="position:relative;">
                           <label for="password" class="form-label">Confirm New Password</label>
                           <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter Confirm Password">
                           <span class="fa fa-eye-slash input_icon" id="eye2" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                        </div>
                        <div class="w-50 mx-auto my-5">
                           <button type="submit" class="btn btn-primary w-100 mt-xl-5">submit</button>
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
                  <p id="msgotp">
                  </p>
                  <a class="btn btn-primary mt-4" id="btnok" href="" >Ok</a>
                
               </div>
            </div>
         </div>
      </div>
@include("inc/footer");

<style>

   .password_hints {
      position: absolute;
      top: 60px;
      bottom: -115px\9;
      right: 55px;
      width: 220px;
      padding: 15px;
      background: #fefefe;
      font-size: .875em;
      border-radius: 5px;
      box-shadow: 0 1px 3px #ccc;
      border: 1px solid #ddd;
      z-index: 9;
   }
   .position-relative {
       position:relative; 
   }
   .password_hints ul {
      list-style:none;
      margin:0;
      padding:0;
   }
   .password_hints ul li {
      margin: 0;
      padding: 0;
      list-style: none;
      font-size: 13px;
      line-height: 25px;
   }
   .password_hints::before {
      content: "\25B2";
      position:absolute;
      top:-12px;
      left:45%;
      font-size:14px;
      line-height:14px;
      color:#ddd;
      text-shadow:none;
      display:block;
   }
   .invalid {
      background-image:url(../images/invalid.png) no-repeat 0 50%;
      color:#ec3f41;
   }
   .valid {
      background-image:url(../images/valid.png) no-repeat 0 50%;
      color:#3a7d34;
   }


   .password_hints h4 {
      font-size: 13px;
   }
   .password_hints {
      display:none;
   }

   </style>
   <script>
   jQuery(document).ready(function() {
       c1 = 0;
       c2 = 0;
       c3 = 0;
       c4 = 0;
       c5 = 0;
      jQuery('.special_characters_type').keyup(function() {
         
      

         var pswd = jQuery(this).val();
         if ( pswd.length < 8 ) {
      
         console.log("1->"+$("#checksubmit").attr("data-val"));
             c1= 0;
          if( c2=='1' && c3=='1' && c4=='1' && c5=='1')
               {
               console.log("2->"+$("#checksubmit").attr("data-val"));
               $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
            }
               else
               {
                  console.log("3->" +"pswd.length===>"+ pswd.length +$("#checksubmit").attr("data-val"));
                  $("#checksubmit").attr("data-val",0);
                  $("#UserPassword").attr("data-val",0);
               
               }
            jQuery('.length').removeClass('valid').addClass('invalid');
         } else {
                c1 = 1;

                if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
                  {
                  console.log("4 if->" +"pswd.length===>"+ pswd.length +$("#checksubmit").attr("data-val"));
                  $("#checksubmit").attr("data-val",1);
                  console.log("3->"+$("#checksubmit").attr("data-val"));
                                 //$("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
                  }
               else
               {
                     console.log("5->" +"pswd.length===>"+ pswd.length +$("#checksubmit").attr("data-val"));
                  
               console.log("5->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",0);
                  $("#UserPassword").attr("data-val",0);
               
               }
                console.log("c1=dd=>"+c1);
            jQuery('.length').removeClass('invalid').addClass('valid');
         }
         //validate letter
         if ( pswd.match(/[?,=,.,*,!,#,$,%,&,?,@, ,"]/) ) {
             c2 = 1;
              if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
                  {
                  console.log("6->"+$("#checksubmit").attr("data-val"));
                                 $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
                  }
               else
               {
               console.log("7->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",0);

                  $("#UserPassword").attr("data-val",0);
               
               }

                            console.log("c2==>"+c2);
            jQuery('.letter').removeClass('invalid').addClass('valid');
         } else {
            c2= 0;
          if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
               {
               console.log("8->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
            }
               else
               {
               console.log("9->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",0);
                  $("#UserPassword").attr("data-val",0);
               
               }
            jQuery('.letter').removeClass('valid').addClass('invalid');
         }

         //validate capital letter
         if ( pswd.match(/[A-Z]/) ) {
            c3 =1;
             if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
                  {
                  console.log("10->"+$("#checksubmit").attr("data-val"));
                                 $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
                  }
               else
               {
               console.log("11->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",0);
                  $("#UserPassword").attr("data-val",0);
               
               }

                            console.log("c3==>"+c3);
            jQuery('.capital').removeClass('invalid').addClass('valid');
         } else {
             c3= 0;
          if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
               {
               console.log("12->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
            }
               else
               {
               console.log("13->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",0);
                  $("#UserPassword").attr("data-val",0);
               
               }
            jQuery('.capital').removeClass('valid').addClass('invalid');
         }

         //validate capital letter
         if ( pswd.match(/[a-z]/) ) {
          c4 = 1;
          if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
                  {
                  console.log("14->"+$("#checksubmit").attr("data-val"));
                                 $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
                  }
                 else
                   {
                   console.log("15->"+$("#checksubmit").attr("data-val"));
                                 $("#checksubmit").attr("data-val",0);
                   $("#UserPassword").attr("data-val",0);
               
                  }

                     console.log("c4==>"+c4);
            jQuery('.small').removeClass('invalid').addClass('valid');
         } else {
            c4= 0;
          if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
               {
               console.log("17->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
            }
               else
               {
               console.log("18->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",0);
                  $("#UserPassword").attr("data-val",0);
               
               }
            jQuery('.small').removeClass('valid').addClass('invalid');

         }

         //validate number
         if ( pswd.match(/\d/) ) {
         c5= 1;
          if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
               {
               console.log("20->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
            }
               else
               {
               console.log("21->"+$("#checksubmit").attr("data-val"));
                              $("#checksubmit").attr("data-val",0);
                  $("#UserPassword").attr("data-val",0);
               
               }

                         console.log("c5==>"+c5);
            jQuery('.number').removeClass('invalid').addClass('valid');
         } else {
         c5= 0;
          if(c1=='1' && c2=='1' && c3=='1' && c4=='1' && c5=='1')
               {
               console.log("22->"+$("#checksubmit").attr("data-val"));
                  $("#checksubmit").attr("data-val",1);
                     $("#UserPassword").attr("data-val",1);
            }
               else
               {
               console.log("23->"+$("#checksubmit").attr("data-val"));
                  $("#checksubmit").attr("data-val",0);
                  $("#UserPassword").attr("data-val",0);
               
               }
            jQuery('.number').removeClass('valid').addClass('invalid');
         }
         
      }).focus(function() {
         jQuery('#password_hints').show();
      }).blur(function() {
         jQuery('#password_hints').hide();
      });
   



   });
   

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
      $("#eye2").on("click",function(){
		 	

      //    type=$("input[id='"+$("#cpassword").data("name")+"']").attr("type");
            type= $("#cpassword").attr("type");
      //      alert(type);
          if(type=='password')
                {
                   $("#eye2").removeClass("fa-eye-slash");
                   $("#eye2").addClass("fa-eye");
                  // $("input[id='"+$("#cpassword").data("name")+"']").attr("type",'text');
                  $("#cpassword").attr("type",'text');
                }
                else
                {
                   $("#eye2").addClass("fa-eye-slash");
                   $("#eye2").removeClass("fa-eye");
                   $("#cpassword").attr("type",'password');
                }
               
         
       });

	});

    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
   $(function(){
   patten ="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$";


      jQuery.validator.addMethod("passwordcheck", function(value, element, param) {
    return value.match(patten);
},'Please enter valid password');

   $("#forget_pasdform").validate({
      rules: {
        password: {
            required: true,
            minlength:6,
            maxlength:50,
             passwordcheck:true
         },
         cpassword: {
            required: true,
            minlength:6,
            maxlength:50,
            equalTo: "#password"

         },
        
      },
      
      messages: {
        password: {required: "Please enter password",},
         cpassword:{required:"Please enter confirm password.", equalTo:"Password and confirm password must be same."},

      },
      submitHandler: function(form) {
         var formData= new FormData(jQuery('#forget_pasdform')[0]);
      formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
        
      jQuery.ajax({
            url: "{{route('verify_forgetpassword')}}",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            
            success:function(data) { 
            var obj = JSON.parse(data);
            
            if(obj.status==true){
               //  $("#staticBackdrop").modal('show');
               // $("#msgotp").text(obj.message);
                  $("#error_message").text(obj.message);
                  setTimeout(function(){ 
                     window.location.href=obj.url;

                   }, 2000);
             //   $("#btnok").attr("href",obj.url);
            }
            else{
               if(obj.status==false){
                  $("#error_message").text(obj.message);
               //      $("#staticBackdrop").modal('show');
               //  $("#msgotp").text(obj.message);
               //  $("#btnok").attr("href","#");
               }
             
            }
            }
         });
      }
   }); 
});
</script>