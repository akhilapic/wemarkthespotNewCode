<?php
 $base_url =  URL::to('/');
?>

@include("inc/header");
<link rel="stylesheet" href="{{asset('assets/build/css/intlTelInput.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('assets/build/css/demo.css')}}"> -->
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

     </style>
   <main class="my-accont">
         <div class="container-fluid">
            <h1 class="title">Account Settings</h1>
            <div class="row gy-5">
               <div class="col-md-4 pe-lg-5">
                  <aside>
                     <div class="BoxShade UserBox mb-4">
                        
                        <figure>
                        @if($account->business_images)   
                        <img src="{{$account->business_images}}">
                        @else
                        <img src="{{asset('assets/images/img-6.png')}}">
                        @endif

                     </figure>
                     @if($account->business_name)  
                     <p><strong>{{$account->business_name}}</strong></p>
                     @else
                     <p><strong>Royal Bar</strong></p>
                     @endif
                        
                        <p class="rating">4.7 <span class="icon-star"></span></p>
                        <p class="verify">Verified</p>
                     </div>
                     <div class="BoxShade">
                        <ul>
                           <li class="active"><a href="{{url('my_account')}}">My Profile</a></li>
                           <li><a href="{{url('my-subscription')}}">My Subscription</a></li>
                           <li><a href="{{url('notifications')}}">Notifications</a></li>
                           <li><a href="{{url('ac-change-password')}}">Change Password</a></li>
                           <li><a href="{{url('faqs')}}">FAQs</a></li>
                           <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                           <li><a href="{{url('/websignout')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               {{session('message')}}

               <div class="col-md-8">
                  <h4 class="acTitle">My Profile</h4>
                  <span class="result" style="color:red"></span>
                 <form  action="" id="my_profile_edit" method="post" enctype="multipart/form-data">
                     <div class="thumb-up mb-5">
                        <div class="profile-box d-flex flex-wrap align-content-center">
                           @if($account->image)
                           <img class="profile-pic" src="{{$account->image}}">   
                           @else
                        <img class="profile-pic" src="{{asset('assets/images/user-thumb.png')}}">
                        @endif
                     </div>
                        <div class="p-image">
                           <button type="button" value="login" class="btn upload-button"><span class="icon-camera"></span></button>
                           <input class="file-upload" type="file" name="image" accept="image/*">
                        </div>
                     </div>
                     <div class="row gy-4">
                        <div class="col-md-6">
                           <label class="form-label">Business Owner Name</label>
                           <input type="text" class="form-control" name="name" value="{{$account->name}}" placeholder="Enter Business Owner Name">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Business Name</label>
                           <input type="text" class="form-control" onkeypress="return /^[a-zA-Z \s]+$/i.test(event.key)" name="business_name"  value="{{$account->business_name}}" placeholder="Enter Business Name">
                        </div>
                        <div class="col-md-6">
                        <label for="phone-number" class="form-label ">Phone Number</label><br/>
                        <input type="hidden" id="country_code"  name="country_code" />
                           <input type="text" class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="phone" id="phone" value="{{$account->phone}}" maxlength="10" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Email</label>
                           <input type="text" readonly class="form-control" name="email" value="{{$account->email}}" placeholder="Enter Email">
                        </div>
                        
                        <div class="col-md-6">
                           <label class="form-label">Opening Hours</label>
                           <input type="time" name="opeing_hour"  value="{{$account->opeing_hour}}" class="form-control without_ampm" value="">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Closing Hours</label>
                           <input type="time" name="closing_hour" value="{{$account->closing_hour}}"  class="form-control without_ampm" value="">
                        </div>
                        <div class="col-md-12 iconinput">
                           <label for="location" class="form-label">Location</label>
                           <input type="text" class="form-control" name="location" value="{{$account->location}}" placeholder="Enter Location">
                           <span class="icon-gps"></span>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Select Business Type</label></div>
                           <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="business_type" id="inlineRadio1" value="1" @if($account->business_type == '1') checked @endif>
                              <label class="form-check-label" for="inlineRadioOptions">Online Only</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="business_type" id="inlineRadio2" value="2"@if($account->business_type == '2') checked @endif>
                              <label class="form-check-label" for="inlineRadioOptions">Physical Location</label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Select Business Category <span style="color:Red">*</span></label></div>
                              @foreach($categorylist as $list)
                              @if($list->id == $account->business_category)
                              <div class="form-check form-check-inline">
                                 <input checked class="form-check-input select_buiness_category" date-id= "{{$list->id}}" type="radio" name="business_category"  value="{{$list->id}}">
                                 <label class="form-check-label" for="inlineRadio4">{{$list->name}}</label>
                              </div>
                              @else
                                 <div class="form-check form-check-inline">
                                 <input class="form-check-input select_buiness_category" date-id= "{{$list->id}}" type="radio" name="business_category"  value="{{$list->id}}">
                                 <label class="form-check-label" for="inlineRadio4">{{$list->name}}</label>
                              </div>
                              @endif
                              @endforeach
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Upload Commercial License</label></div>
                          @if('public/images/{{$account->upload_doc}}')
                        <img src="{{$account->upload_doc}}" style="width: 100px;height: 50px;">
                        @endif
                        </div>
                        <input type="hidden" id="hiddenbusiness_sub_category" value="{{$account->business_sub_category}}"/>
                        <div class="col-md-6">
                           <div><label class="form-label">Select Sub Category <span style="color:Red">*</span></label></div>
                           <select id="sub_category" class="form-select" name="business_sub_category">
                           
                                 <option value="">Select Sub Category</option>
                                 

                           
                           </select>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Business Images</label></div>
                          <input class="form-control" type="file"  name="business_images" name="image" id="img" value="">
                  <input type="hidden" name="old_business_images" value='{{$account->business_images}}'/>
                        </div>
                       <!--  <div class="col-md-12">
                           <label for="location" class="form-label">Reason for not uploading commercial license</label>
                           <input type="text" class="form-control" placeholder="Type Reason">
                        </div> -->
                        <div class="col-md-12">
                           <label for="location" class="form-label">Short Description</label>
                           <textarea class="form-control" name="description" placeholder="Type Short Description">{{$account->description}}</textarea>
                        </div>
                     </div>

                     <button type="submit" class="btn btn-primary mt-5 mb-2 px-4 pb-2 btn_submit_tranning">Update Profile</button>
                  </form>
                 
               </div>
            </div>
         </div>
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
@include("inc/footer")
<script src="{{asset('assets/build/js/intlTelInput.js')}}"></script>
<script type="text/javascript">
   $(document).ready(function() {

      country_code =$(".iti__selected-flag").attr("title");
         const myArr = country_code.split(": ");
         c_code ='+1';//myArr[1];
         $("#country_code").val(c_code);
         // console.log($("#country_code").val());
    
    $(".btn_submit_tranning").on("click",function(){
        country_code =$(".iti__selected-flag").attr("title");
         const myArr = country_code.split(": ");
         c_code ='+91';//myArr[1];
         $("#country_code").val(c_code);
          console.log($("#country_code").val());
    
      });
   });
    $(function(){
   var    category_id = $("input[type='radio'].select_buiness_category:checked").val();
   var  hiddenbusiness_sub_category = $("#hiddenbusiness_sub_category").val();
   
      if(category_id!='')
      {
         host_url = "/development/wemarkthespot/";
		   var token = $("meta[name='csrf-token']").attr("content");
      
      $.ajax({
         type: 'POST',
			dataType: "json",
			url: host_url+'sub_category_by_category_id',
			data: {'_token':  token,'category_id': category_id},
			success: function(response){
            
            if(response.status==true)
            {

               $("#sub_category").empty();
               $.each(response.data,function(index,value){
                  op = "<option value=''>Select Sub Category</option>";
                  if(hiddenbusiness_sub_category==value.id)
                  {
                  
                     op+="<option Selected value="+value.id+">"+value.name+"</option>";
                  }
                   else{
                     op+="<option value="+value.id+">"+value.name+"</option>";
                   }
                  
                  $("#sub_category").append(op);
               });
            }
			  setTimeout(function(){
				  jQuery('.result').html('');
				 // window.location = "/user_list";
			  }, 1000);
			}
		});
      }

        country_code =$(".iti__selected-flag").attr("title");
         const myArr = country_code.split(": ");
         c_code =myArr[1];
         $("#country_code").val(c_code);
         // console.log($("#country_code").val());
    
    $(".btn_submit_tranning").on("click",function(){
        country_code =$(".iti__selected-flag").attr("title");
         const myArr = country_code.split(": ");
         c_code =myArr[1];
         $("#country_code").val(c_code);
          console.log($("#country_code").val());
    
      });
    });

</script>
  <script>
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
  </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
   $(".select_buiness_category").on("change",function(){
      var category_id = $("input[type='radio'].select_buiness_category:checked").val();
      host_url = "/development/wemarkthespot/";
		var token = $("meta[name='csrf-token']").attr("content");
      
      $.ajax({
         type: 'POST',
			dataType: "json",
			url: host_url+'sub_category_by_category_id',
			data: {'_token':  token,'category_id': category_id},
			success: function(response){
//console.log(response.data);
         //   var obj=JSON.parse(data);
            
            if(response.status==true)
            {
               $("#sub_category").empty();
               $.each(response.data,function(index,value){
                  op = "<option value=''>Select Sub Category</option>";
                  op+="<option value="+value.id+">"+value.name+"</option>";
                  $("#sub_category").append(op);
               });
            }
			  setTimeout(function(){
				  jQuery('.result').html('');
				 // window.location = "/user_list";
			  }, 1000);
			}
		});



   
   });
     jQuery.validator.addMethod("emailExt", function(value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter valid email');

   $("#my_profile_edit").validate({
      
   rules: {
      name: {required: true,},
     email: {required: true,email: true,maxlength:50,emailExt: true,},  
   
    
      business_category:{required:true},
      phone:{ 
      
      minlength:10,
      maxlength:10
      }, 
      business_type:{
         required:true,
      },
      business_sub_category:{required:true},
      
      },
   
   messages: {
      name: {required: "Please enter name",},
      email: {required: "Please enter valid email",email: "Please enter valid email",},   
      phone: {required: "Please enter Mobile Number",},
      business_type:{required:"Please Select Business Type",},
      business_category:{require:"Please Business Category",},
      business_sub_category:{require:"Please Select Business Sub Category",},
   },
      submitHandler: function(form) {
         var formData= new FormData(jQuery('#my_profile_edit')[0]);
         formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
        // u ="development/";
        
      jQuery.ajax({
            url: "my_profile_edit",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            
            success:function(data) { 
               let obj  = JSON.parse(data); 
            
             // redirecturl = location.href='otp-verifiction/'+obj.last_id;
             // $("#okbtn").attr("onclick",redirecturl);

            if(obj.status==true){
            
               setTimeout(function(){
              $(".result").html(obj.message);
             window.location.href = "{{route('my_account')}}";
          }, 5000);
            }
            else{
               
            }
            },
         });
      }
   });

</script>