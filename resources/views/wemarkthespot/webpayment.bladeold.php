<?php
 $base_url =  URL::to('/');
?>
@include("inc/header");
<main class="payment">
         <div class="container-fluid">
            <h1 class="title">Payment</h1>
            <h2>Billing Information</h2>
            <div class="BoxShade p-md-5 mb-5 mt-4 mt-lg-5">
               <form>
                  <div class="row gx-md-5 gy-4">
                     <div class="col-md-6">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control" placeholder="Enter Customer Name">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Billing Email</label>
                        <input type="text" class="form-control" placeholder="Enter Billing Email">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Billing Address</label>
                        <input type="text" class="form-control" placeholder="Enter Billing Address">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" placeholder="Enter Country">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" placeholder="Enter City">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">ZIP Code</label>
                        <input type="text" class="form-control" placeholder="Enter ZIP Code">
                     </div>
                  </div>
               </form>
            </div>
            <h2>Payment Information</h2>
            <div class="row gx-lg-5 gy-4 my-3">
               <div class="col-md-6">
                  <div class="BoxShade p-md-5">
                     <form>
                        <div class="mb-3">
                           <label class="form-label">Card Number</label>
                           <input type="text" class="form-control" placeholder="Enter Card Number">
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Validity</label>
                           <input type="text" class="form-control" placeholder="MM/YY">
                        </div>
                        <div class="mb-3">
                           <label class="form-label">CVV</label>
                           <input type="text" class="form-control" placeholder="Enter CVV">
                        </div>
                        <div class="mb-3 form-check ps-0">
                           <input type="checkbox" class="form-check-input" id="exampleCheck1">
                           <label class="form-check-label" for="exampleCheck1">Save card for future use</label>
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-primary mt-5 px-4">Pay Now</button></div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </main>

@include("inc/footer");
<script type="text/javascript">
    $(document).ready(function(e) {
   //   alert("s");
      $(".nav-item a").removeClass("active");
      $("#subscriptions").addClass('active');
    });
 </script>
<script src="{{asset('assets/js/calendar.min.js')}} "></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>

