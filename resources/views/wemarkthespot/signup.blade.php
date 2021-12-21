<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{url('/assets/old/images/favicon.ico')}}" type="image/x-icon">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title> Spot </title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Custom -->
   <!-- <script src="{{url('/assets/js/jquery.min.js')}}"></script> -->
   <script src="{{asset('assets/js/customvalidation.js')}}"></script>
   <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="{{asset('assets/build/css/intlTelInput.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('assets/build/css/demo.css')}}"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
   .form-check.form-check-inline .form-check-input {
      padding: 0px;
      width: 18px;
      height: 18px;
   }
   .form-check.form-check-inline .form-check-input:checked::before {
      top: 4px;
   }
   .iti.iti--allow-dropdown {
      width: 100%;
   }
	.upload_doc_ct input {
		position: absolute;
		right: 0px;
		top: 0px;
		opacity: 0;
		width: 30px;
	}
	.upload_doc_ct {
		position: relative;
	}
	.file_message {
		line-height: 32px;
		margin-right: 10px;
		text-align: right;
		border: none;
	}
	.file_message:disabled {
		background: #fff;
	}
     </style>
</head>

   <body>
      <!-- header -->
   <header>
         <div class="container-fluid d-flex py-3">
            <a class="logo" href="{{url('/')}}"><img src="{{'assets/images/logo.svg'}}"></a>
            <button class="backBTN ms-auto" onclick="redirect()"><span class="icon-close-2"></span></button>

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
   


                           <form  action="{{route('signupuser')}}" id="user_signup"   method="post" enctype="multipart/form-data">
                            @csrf
                           <div class="thumb-up mb-5">
                              <div class="profile-box d-flex flex-wrap align-content-center">
                                 <img class="profile-pic" src="{{asset('assets/images/user-thumb.png')}}">
                              </div>
                              <div class="p-image">
                                 <button type="button" value="login" class="btn upload-button"><span class="icon-camera"></span></button>
                                 <input class="file-upload" type="file" name="image" accept="image/*">
                                 <input type="hidden" id="b_user_image" value="0"/>
                                 
                              </div>
                              
                           </div>
                           <label id="user_imageerror" style="color:red" class="errors"></label>   
                           <div class="mb-3">
                              <label for="name" class="form-label">Business Owner Name</label>
                              <input type="text" class="form-control" id="name1" onkeypress="return /^[a-zA-Z \s]+$/i.test(event.key)" name="name"  value="{{old('name')}}" placeholder="Enter Business Owner Name">
                           </div>
                           @if($errors->has('name'))
                              <span class="error alert alert-dange">{{ $errors->first('name') }}</span>
                           @endif
                           <span id="error_name"></span>
                           <div class="">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" autocomplete="off" maxlength="50" name="email" email="email" id="email" value="{{old('email')}}" placeholder="Enter Email">
                           </div>
                              <label id="user_emailerror" style="color:red" class="errors"></label>   
                            <span class="alert alert-dange" id="email_er"></span>
                            @if($errors->has('email'))
                              <span class="error alert alert-dange">{{ $errors->first('email') }}</span>
                           @endif
                           <div class="mb-3">
                              <label for="phone-number" class="form-label d-block">Phone Number <span>(Optional)</span></label>
                              @if($country_codedata)
						         <div class="input-group">
                              <select id="country_code" name="country_code" class="form-select" style=" padding: 0px 15px;max-width: 200px;background-color: #f5f5f5;">
                                    @foreach($country_codedata as $c)
                                       <option value="{{$c->code}}">{{$c->name}}</option>      
                                    
                                    @endforeach
                              </select>
                           @endif
                              <input type="text" class="form-control" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  name="phone" id="phone"  value="{{old('phone')}}" placeholder="Enter Phone Number"/>
                           </div>
                           </div>
                             @if($errors->has('phone'))
                              <span class="error alert alert-dange">{{ $errors->first('phone') }}</span>
                           @endif
                           <div class="mb-3 iconinput">
                              <label for="location" class="form-label">Location</label>
                              <input type="text" class="form-control" style="height: auto;padding-right: 60px;overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;"  name="location"  value="{{old('location')}}" id="location" placeholder="Enter Location">
                              <span class="icon-gps"></span>

                           </div>
                            <input type="hidden" id="latitude" name="lat" class="form-control">
                                <input type="hidden" name="long" id="longitude" class="form-control">
                            @if($errors->has('location'))
                              <span class="error alert alert-dange">{{ $errors->first('location') }}</span>
                           @endif
                           <div class="mb-3 iconinput" style="position:relative;">
                              <label for="location" class="form-label">Password</label>
                              <input type="password" id="password"  class="form-control special_characters_type" value="{{old('password')}}" name="password" id="password1" placeholder="Enter Password">
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
                            @if($errors->has('password'))
                              <span class="error alert alert-dange">{{ $errors->first('password') }}</span>
                           @endif
                           <div class="iconinput" style="position:relative;">
                              <label for="location" class="form-label">Confirm Password</label>
                              <input type="password" class="form-control " required name="cpassword" id="cpassword" value="{{old('cpassword')}}" placeholder="Enter Confirm Password">
                              <span class="fa fa-eye-slash input_icon" id="eye2" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                           </div>
                            @if($errors->has('cpassword'))
                              <span class="error alert alert-dange" >{{ $errors->first('cpassword') }}</span>
                           @endif
                              <span class="error alert alert-dange" id="errorcpassword"></span>
                           <div class="mb-3">
                              <div><label for="businesType" class="form-label">Select Business Type</label></div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" checked name="business_type" id="inlineRadio31" value="1">
                                 <label class="form-check-label" for="inlineRadio3">Online Only</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="business_type" id="inlineRadio41" value="2">
                                 <label class="form-check-label" for="inlineRadio4">Physical Location</label>
                              </div>
                           </div>

                           @if($errors->has('business_type'))
                              <span class="error alert alert-dange">{{ $errors->first('business_type') }}</span>
                           @endif

                           <div class="mb-3 d-flex">
                              <label for="businesType" class="form-label">Upload Commercial License (Docs, Pdf)<span style="color:red">*</span></label>
							  <input class="file_message ms-auto" id="filename" disabled />
                              <button type="button" style="border: 1px solid #c7c2c2; padding: 0px 18px;" class="btn plusBTN upload_doc_ct" data-val="0"><span class="icon-plus"></span><input   type="file" accept=".pdf,.doc" name="upload_doc" class="uploaddocs" id="upload_docs" />
                                 <input type="hidden" id="b_updoc" value="0"/>
                              </button>
                              <span id="uploaddocerror"></span>
                           </div>
                        
                           <label id="b_updocerror" style="color:red" class="errors">Please upload commercial license (Docs, Pdf)</label>
                           <script>
						         document.getElementById('upload_docs').onchange = uploadOnChange;

								function uploadOnChange() {
								  var filename = this.value;
								  var lastIndex = filename.lastIndexOf("\\");
								  if (lastIndex >= 0) {
									filename = filename.substring(lastIndex + 1);
                      
                              var ext = filename.split('.').pop();
                              if(ext=="pdf" || ext=="docx" || ext=="doc"){
                                  $('.btn_submit_tranning').prop('disabled', false);
                               $("#b_updoc").val(1);
                               $("#b_updocerror").hide();
                                document.getElementById('filename').value = filename;

                              } else{
                                                                $("#b_updocerror").show();
                                   $("#b_updocerror").removeAttr("style");
                                    $("#b_updocerror").css("color","red");
                                    $("#b_updoc").val(0); 
                                document.getElementById('filename').value = filename;
                                return false;
                              }
								  }
								
								}
                           </script>

                           <div class="mb-2 form-check ps-0">
                              @if($errors->has('termsconditions'))
                              <span class="error alert alert-dange">{{ $errors->first('termsconditions') }}</span>
                           @endif
                               <input type="checkbox" class="form-control" id="termsconditions"  name="termsconditions"/>
                             
                              <label class="form-check-label" for="termsconditions">I accept <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a></label>
                           </div>
                           @if($errors->has('termsconditions'))
                              <span class="error alert alert-dange" id="termsconditions">{{ $errors->first('termsconditions') }}</span>
                           @endif
                           <label class="errors" id="termsconditionserror" style="color:red"></label>
                          <!--   @if($errors->has('upload_doc'))
                              <span class="error alert alert-dange">{{ $errors->first('upload_doc') }}</span>
                           @endif -->
                           <div class="w-75 mx-auto mt-5">
   <input type="submit" class="btn btn-primary w-100 btn_submit_tranning"  value="Sign Up" data-bs-toggle="modal" data-bs-target="#approval">
                            
                           </div>
                        </form>
                        <p class="allredy-account my-4 text-center">Already have an account? <a href="{{url('signin')}}">Sign In</a></p>
                        
                     
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>

     <!-- Modal -->
      <div class="modal" id="approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center" style="padding: 30px">
                  <h5>Please verify your Email Address ! </h5>
                  <p>After that admin will approve your account than you will be able to Sign In.</p>
                  <button type="button" id="okbtn" class="btn btn-primary mt-4" >Ok</button>
               </div>
            </div>
         </div>
      </div>

<!--   <div class="modal fade done_message" id="b_trainer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content pt-5 pb-5">
        <div class="modal-body text-center" style="padding: 30px">
                  <h5>Please verify your Email Address ! </h5>
                  <p>After that admin will approve your account than you will be able to Sign In.</p>
                  <button type="button" class="btn btn-primary mt-4" data-bs-dismiss="modal" aria-label="Close" >Ok</button>
               </div>
        <div class="modal-footer justify-content-center border-0">
          <button type="button" data-dismiss="modal" class="btn btn-xs btn-primary  fr" >Done</button>
        </div>
      </div>
    </div>
  </div> -->


    <!-- Scripts -->
   <script src="{{url('/assets/old/js/jquery.min.js')}}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    
   <!-- Bootstrap -->
   <script src="{{url('/assets/old/js/popper.min.js')}}"></script>
   <script src="{{url('/assets/old/js/bootstrap.min.js')}}"></script>

   <!-- Owl Carousel -->
   <script src="{{url('/assets/old/js/owl.carousel.min.js')}}"></script>

   <!-- Select 2 Js -->
   <script src="{{url('/assets/old/js/select2.min.js')}}"></script>

   <!-- Slick slider -->
   <script src="{{url('/assets/old/js/slick.js')}}"></script>

   <!-- Custom Js -->
   <script src="{{url('/assets/old/js/custom.js')}}"></script>
       <script src="{{asset('assets/build/js/intlTelInput.js')}}"></script>

</body>
<script type="text/javascript">
   function redirect()
   {
      window.location.href = "{{url('/')}}";
   }
</script>
 <!--start Location-->
 
        <script>

        function activatePlacesSearch() {
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());

                
            });
        }
    </script>
     <script 
        src="https://maps.google.com/maps/api/js?key=AIzaSyDXendzNuPChFkDejwv7jbFtqunqRawrk0&libraries=geometry,places&callback=activatePlacesSearch"></script>

  <!-- end Location-->
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
<script type="text/javascript">
//    function ValidateEmail(inputText)
// {
//       var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

//    // var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
//    if(inputText.value.match(emailPattern))
//    {
//    //alert("Valid email address!");
//       $("#email_er").text("Valid email address!");
//    return true;
//    }
//    else
//    {
//        $("#email_er").text("You have entered an invalid email address!");
//        $("#email").focus();
//    //document.form1.text1.focus();
//    return false;
//    }
// }

$(document).ready(function() {

    
  var readURL = function(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('.profile-pic').attr('src', e.target.result);
               $("#b_user_image").val(1);
               $("#user_imageerror").hide();
            }
          
          reader.readAsDataURL(input.files[0]);
      }
  }
    var readURL1 = function(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
          
        //    $(".file_message").text(e.target.result);
              //$('#upload_docs').attr('src', e.target.result);
           //  $("#b_updoc").val(1);
            }
          
          reader.readAsDataURL(input.files[0]);
      }
  }
  

  $(".file-upload").on('change', function(){
      readURL(this);
  });
  
  $(".upload-button").on('click', function() {
     $(".file-upload").click();
  });

  //$(".uploaddocs").on('change', function(){
      //readURL1(this);
  //});
});


   function plusbtn()
   {
      $("#upload_docs").show();
      
   }
    $(function(){
      $("#b_updocerror").css("display","none");
      // $("#cpassword").on('keyup',function(){
      //    cpassword = parseInt($(this).val());
      //    password = parseInt($("#password").val());
      //    if(password!=cpassword)
      //    {
      //       $("#errorcpassword").text("Password Not Match");
      //       return false;
      //    }
      //    else
      //    {
      //        $("#errorcpassword").hide();
      //      // return false;
      //    }

      // });
      //  country_code =$(".iti__selected-flag").attr("title");
        // const myArr = country_code.split(": ");
        // c_code =myArr[1];
         //$("#country_code").val(c_code);
         // console.log($("#country_code").val());
    
    $(".btn_submit_tranning").on("click",function(){
   //   $("#b_user_image")
      var myFile = $('#b_user_image').val();
      if(myFile=="0")
      {  
         $("#user_imageerror").text("Please select profile image");
         
      }
      else{
         $("#user_imageerror").text("");
      }
      b_updoc = $("#b_updoc").val();

      filename = $("#filename").val();

         var ext = filename.split('.').pop();
            if(ext=="pdf" || ext=="docx" || ext=="doc"){
            //   $('.btn_submit_tranning').prop('disabled', false);
                       
               } else{
               $("#b_updocerror").removeAttr("style");
               $("#b_updocerror").css("color","red");
              // $('.btn_submit_tranning').prop('disabled', true);
            }

       if(b_updoc=="0")
      {  
         $("#b_updocerror").text("Please upload commercial license  (Docs, Pdf)").css("display", "block");
         
      }
      else{

          $("#b_updocerror").text("").css("display", "none");
      }
      name1 =$("#name1").val();
      $("#name1").val(name1.trim());
      //  country_code =$(".iti__selected-flag").attr("title");
        // const myArr = country_code.split(": ");
        // c_code =myArr[1];
         //$("#country_code").val(c_code);
          //console.log($("#country_code").val());
    
      });
    });

</script>
<style type="text/css">
    label.error {
    display: inline-block;
    width: 100%;
    clear: both;
    margin-top: 8px;
    color: #db0707;
}
</style>
<script>



   jQuery.validator.addMethod("emailExt", function(value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter valid email');
   

//       jQuery.validator.addMethod("passwordcheck", function(value, element, param) {
//     return value.match(/^[?,=,.,*,!,#,$,%,&,?,@, ,"]+[a-zA-Z]+[0-9]$/);
// },'check password');

patten ="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$";


      jQuery.validator.addMethod("passwordcheck", function(value, element, param) {
    return value.match(patten);
},'Please enter valid password');

   $("#user_signup").validate({

      
   rules: {
      name: {required: true,},
      email: {required: true,email: true,maxlength:50,emailExt: true,},  
   
      password:{required:true,
         minlength:6,
         passwordcheck:true,
      },
    // termsconditions:{required: true}, 
      cpassword:{
         required:true,
          minlength: 6,
          equalTo: "#password"
      },
       location:{required:true},
      phone:{ 
      
      minlength:10,
      maxlength:10
      }, 
      business_type:{
         required:true,
      },
   country_code:{required:true,},
       image:{required:true},
   
      },
   
   messages: {
      name: {required: "Please enter business owner  name",},
      email: {required: "Please enter valid email",email: "Please enter valid email",},   
      phone: {required: "Please enter Mobile Number",},
      password: {required: "Please enter password",},
   //   cpassword: {required: "Please enter confirm password",},
      business_type:{required:"Please Select Business Type"},
       country_code:{required:"Please select country code"},
       location:{required:"Please enter location"},
       image:{required:"Please select profile image"},
       cpassword:{required:"Please enter confirm password", equalTo:"Password and confirm password must be same"},

   },
      submitHandler: function(form) {
         var formData= new FormData(jQuery('#user_signup')[0]);
         formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
        // u ="development/";
        
      jQuery.ajax({
            url: "signupuser",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            
            success:function(data) { 
               
               let obj  = JSON.parse(data); 
            
               console.log(obj.status+ obj.message);

            if(obj.status==true){
               //redirecturl = location.href='otp-verifiction/'+obj.last_id;
               redirecturl = location.href='otp-verifiction';
             $("#okbtn").attr("onclick",redirecturl);
            //   alert(obj.status);
               setTimeout(function(){
               $("#approval").modal('show');
           //  window.location.href = "emailverification";
          }, 1000);
            }
            else{
               
               if(obj.status==false)
               {
                  if(obj.termsconditions==false)
                  {
                     $("#termsconditionserror").text(obj.message);
                       setTimeout(function(){
              $("#termsconditionserror").empty();  
           //  window.location.href = "emailverification";
          }, 15000);
                  }
                   if(obj.image==false)
                  {
                     $("#user_imageerror").text(obj.message);
                  }
                  if(obj.email==false)
                  {
                      $("#user_emailerror").text(obj.message);  
                       
                  
                  }
               }
            }
            }
         });
      }
   });

</script>
<!--   <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "{{asset('assets/build/js/utils.js')}}",
    });
  </script> -->

<script src="{{asset('assets/build/js/intlTelInput.js')}}"></script>
 <!--  <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {

      utilsScript: "{{asset('assets/build/js/utils.js')}}",
    });
  </script> -->
</html>