<?php
   $startDate = Session::get('startDate');
   $endDate = Session::get('endDate');
   $amount = Session::get('amount');
   $planId = Session::get('planId');

   if(empty($startDate) || empty($endDate) || empty($amount) || empty($planId)){
      echo "Unauthorize Access";
      die; 
   }

   $base_url =  URL::to('/');
?>

@include("inc/header");

<style type="text/css">
    label.error {
    display: inline-block;
    width: 100%;
    clear: both;
    margin-top: 8px;
    color: #db0707;
}
</style>

<main class="payment">
         <div class="container-fluid">
         <div class="alert alert-warning result"  style="display: none;"></div>
         <form id="payment_submit_from" method="POST">

            <h1 class="title">Payment</h1>
            <h2>Billing Information</h2>
            <div class="BoxShade p-md-5 mb-5 mt-4 mt-lg-5">

               <!-- <form id="payment_submit_from" method="POST"> -->
                  @csrf
                  <div class="row gx-md-5 gy-4">

                     <input type="hidden" class="form-control" value="{{$startDate}}" name="startDate">
                     <input type="hidden" class="form-control" value="{{$endDate}}" name="endDate">
                     <input type="hidden" class="form-control" value="{{$amount}}" name="amount">
                     <input type="hidden" class="form-control" value="{{$planId}}" name="planId">

                     <div class="col-md-6">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="{{$userData->name}}">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Billing Email</label>
                        <input type="text" class="form-control" id="billing_email" name="billing_email" placeholder="Enter Billing Email" value="{{$userData->email}}">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Billing Address</label>
                        <input type="text" class="form-control" id="billing_add" name="billing_add" placeholder="Enter Billing Address" value="{{$userData->location}}">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" value="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">ZIP Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter ZIP Code" value="">
                     </div>
                  </div>
               <!-- </form> -->
            </div>

            <h2>Payment Information</h2>
            <div class="row gx-lg-5 gy-4 my-3">
               <div class="col-md-6">
                  <div class="BoxShade p-md-5">
                     <!-- <form> -->
                        <div class="mb-3">
                           <label class="form-label">Card Number</label>
                           <input type="number" class="form-control" id="card_number" name="card_number" placeholder="Enter Card Number" value="">
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Validity</label>
                           <input type="date" class="form-control" id="validity" name="validity" placeholder="MM/YY" value="">
                        </div>
                        <div class="mb-3">
                           <label class="form-label">CVV</label>
                           <input type="number" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV" value="">
                        </div>
                        <div class="mb-3 form-check ps-0">
                           <input type="checkbox" class="form-check-input" id="save_checkbox" name="save_checkbox" value="saveTheCardValue" checked>
                           <label class="form-check-label" for="save_checkbox">Save card for future use</label>
                        </div>
                        <div class="text-center"><button type="submit" id="paynow_button" class="btn btn-primary mt-5 px-4">Pay Now</button></div>

                     <!-- </form> -->
                  </div>
               </div>
            </div>

            <form>

         </div>
      </main>


<script src="{{url('/assets/old/js/jquery.min.js')}}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript">

   //========Form Submit - Start====================================================
   // $("#paynow_button").click(function()
   // {

      jQuery.validator.addMethod("emailExt", function(value, element, param) {
         return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
      },'Please enter valid email');
      jQuery.validator.addMethod("cityalpha", function(value, element, param) {
         return value.match(/^[A-Za-z]+$/);
      },'Please enter only alphabate');
      jQuery.validator.addMethod("countryalpha", function(value, element, param) {
         return value.match(/^[A-Za-z]+$/);
      },'Please enter only alphabate');

      $("#payment_submit_from").validate({

         rules: {
            customer_name: {
               required: true,
               minlength:3,
            },

            billing_email: {
               required: true,
               email: true,
               maxlength:100,
               emailExt: true,
            },  

            billing_add:{
               required:true,
               minlength:6,
            },

            country:{
               required:true,
               minlength: 3,
               countryalpha:true,
            },

            city:{
               required:true,
               cityalpha:true,
               minlength: 3,
            },

            zip_code:{ 
               required:true,
               minlength:4,
            }, 

            card_number:{
               required:true,
               minlength:16,
               maxlength:16,
            },

            validity:{
               required:true,
            },

            cvv:{
               required:true,
               minlength:3,
               maxlength:4,
            },
         },

         messages: {
            customer_name: {required: "Please enter customer name"},
            billing_email: {required: "Please enter valid email", emailExt: "Please enter valid email",},   
            billing_add: {required: "Please enter valid address", minlength:"Please enter valid address"},
            country: {required: "Please enter country", minlength:"Please enter valid country"},
            city: {required: "Please enter city", minlength:"Please enter valid city"},
            zip_code:{required:"Please enter zip code", minlength:"Please enter valid zip code"},
            card_number:{required:"Please enter card number", minlength: "Please enter valid card number", maxlength:"Please enter valid card number"},
            validity:{required:"Please select card validity"},
            cvv:{required:"Please enter CVV", minlength:"Please enter valid CVV"},
         },

         submitHandler: function(form) {
            var formData= new FormData(jQuery('#payment_submit_from')[0]);
            formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
         
         jQuery.ajax({
            url: "submitSubcriptionPayment",
            type: "POST",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            
            success:function(data) { 
               
            let obj  = JSON.parse(data); 
            // console.log(obj.status+ obj.message);
               if(obj.status==true){
                  $(".result").show();
              $(".result").text(obj.message);
                  // alert(obj.message);  //test
                  // alert(obj.last_id); //test

                  setTimeout(function(){
                     //alert("here here"); //test
                     $(".result").hide();
                     // $("#approval").modal('show');
                     window.location.href = "subscriptions";
                  }, 2000);
               }else if(obj.status==false){
                 // alert(obj.message);  //test
                 $(".result").show();
               }
            }
         });
       }

      });

   // });
   //========Form Submit - End======================================================

   $(document).ready(function(e) {
      $(".nav-item a").removeClass("active");
      $("#subscriptions").addClass('active'); 
   });
</script>

<script src="{{asset('assets/js/calendar.min.js')}} "></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>

@include("inc/footer");