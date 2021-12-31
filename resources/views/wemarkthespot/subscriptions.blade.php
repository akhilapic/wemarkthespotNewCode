<?php
 $base_url =  URL::to('/');
?>

@include("inc/header");
<!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->

<!-- <script type="text/javascript">
 
</script> -->

   <main class="subscription">
         <div class="container-fluid">
         <h1 class="title">Subscription Plans</h1>
         <div class="row gy-4">
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
               <div class="BoxShade package text-center w-100">
                  <h6>Business of the Week</h6>
                  <p class="price" id="WeekBussAmt">{{$subscriptions->weekBusiness}} <span>Per Week</span></p>
                  <ul>
                     <li><span class="icon-checkmark"></span>Lorem ipsum dolor sit amet.</li>
                     <li><span class="icon-checkmark"></span>Lorem ipsum.</li>
                     <li><span class="icon-checkmark"></span>Sed diam voluptua.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                     <li><span class="icon-close"></span>Lorem ipsum dolor.</li>
                     <li><span class="icon-close"></span>Diam voluptua sed.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                  </ul>
                  <button type="button" class="btn btn-primary mt-5 px-4" id="selectOneWeekOnly" data-bs-toggle="modal" data-bs-target="#calendarView">Buy Now</button>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
               <div class="BoxShade package text-center w-100">
                  <h6>Featured Business</h6>
                  <p class="price" id="threeWeekBussAmt">{{$subscriptions->featuredBusiness}} <span>Per Week</span></p>
                  <ul>
                     <li><span class="icon-checkmark"></span>Lorem ipsum dolor sit amet.</li>
                     <li><span class="icon-checkmark"></span>Lorem ipsum.</li>
                     <li><span class="icon-checkmark"></span>Sed diam voluptua.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                     <li><span class="icon-close"></span>Lorem ipsum dolor.</li>
                     <li><span class="icon-close"></span>Diam voluptua sed.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                  </ul>
                  <button type="button" class="btn btn-primary mt-5 px-4" id="selectThreeWeekOnly" data-bs-toggle="modal" data-bs-target="#calendarView">Buy Now</button>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
               <div class="BoxShade package text-center activePack w-100">
                  <!-- <span class="active icon-checkmark"></span> -->
                  <h6>Business of the Week & Featured Business</h6>
                  <p class="price" id="allWeekBussAmt">{{$subscriptions->weekAndFeatured}} <span>Per Week</span></p>
                  <ul>
                     <li><span class="icon-checkmark"></span>Lorem ipsum dolor sit amet.</li>
                     <li><span class="icon-checkmark"></span>Lorem ipsum.</li>
                     <li><span class="icon-checkmark"></span>Sed diam voluptua.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                     <li><span class="icon-close"></span>Lorem ipsum dolor.</li>
                     <li><span class="icon-close"></span>Diam voluptua sed.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                  </ul>
                  <button type="button" class="btn btn-primary mt-5 px-4" id="selectAllWeekOnly" data-bs-toggle="modal" data-bs-target="#calendarView">Buy Now</button>
               </div>
            </div>
         </div>
         <section class="currentPlan">
            <div class="row">
               <div class="col-md-6">
                  <h1 class="title">My Current Plan</h1>
                  <div class="BoxShade MycurrentPlan">
                     <table class="table table-borderless">
                        <tbody>
                           <tr>
                              <th scope="row">Name Of plan</th>
                              <td>Business of the week</td>
                           </tr>
                           <tr>
                              <th scope="row">Date of Activation</th>
                              <td>2 Jun 2021</td>
                           </tr>
                           <tr>
                              <th scope="row">Date of Expiration</th>
                              <td>3 Jun 2022</td>
                           </tr>
                           <tr>
                              <th scope="row">Mode of Payment</th>
                              <td>
                                 <div class="d-lg-flex cardDetal">
                                    <div>
                                       <p class="mb-0">Card</p>
                                       <p class="mb-0"><img src="images/visa.png">xxxx-xxxx-xxxx-3024</p>
                                    </div>
                                    <button class="btn btn-secondary py-1 btn-sm ms-auto"> Changes</button>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-md-6">
                  <h1 class="title">Payment History</h1>
                  <div class="table-responsive BoxShade PaymentHistory">
                     <table class="table table-borderless">
                        <thead>
                           <tr>
                              <th>Order Id</th>
                              <th>Date</th>
                              <th>Amount</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>#125443523</td>
                              <td>2 Jun 2021</td>
                              <td>$9.99</td>
                              <td>Paid</td>
                           </tr>
                           <tr>
                              <td>#125443523</td>
                              <td>2 Jun 2021</td>
                              <td>$9.99</td>
                              <td class="fail">failed</td>
                           </tr>
                           <tr>
                              <td>#125443523</td>
                              <td>2 Jun 2021</td>
                              <td>$9.99</td>
                              <td>Paid</td>
                           </tr>
                           <tr>
                              <td>#125443523</td>
                              <td>2 Jun 2021</td>
                              <td>$9.99</td>
                              <td>Paid</td>
                           </tr>
                           <tr>
                              <td>#125443523</td>
                              <td>2 Jun 2021</td>
                              <td>$9.99</td>
                              <td>Paid</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
         </section>
         </div>
      </main>
      <!-- Modal -->
      <div class="modal modelStyle fade" id="calendarView">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center">

                  <h4>Select Week</h4>
                  <p id="selectShowError" style="color:red;font-weight:600;"></p>
                  <div class="week-picker cts_calendar"></div>
                  <!-- <label>Week :</label> <span id="startDate"></span> - <span id="endDate"></span> -->
                  <div id="showSubmitButtonSelect"></div>  <!--to show submit button-->

               </div>
            </div>
         </div>
      </div>

@include("inc/footer");

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>    
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css">

<style>
   .cts_calendar .ui-datepicker {
    width: 100%;
    border: none;
   }
   .cts_calendar .ui-datepicker a.ui-state-default {
      background: #fff;
      text-align: center;
      height: 45px;
      border: none;
      line-height: 38px;
   }
   .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
      background: #1dc2c2 !important;
      color: #fff;
      border-radius: 7px;
   }
   .ui-datepicker-header.ui-widget-header.ui-helper-clearfix.ui-corner-all {
      background: transparent;
      border: none;
   }
   .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus {
      background: transparent;
      border: none;
   }
   .ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
      cursor: pointer;
   }
   .ui-datepicker td {
      border: 0;
      padding: 0px;
   }

</style>


<script type="text/javascript">

   //to check comes from which plan
   $("#selectOneWeekOnly").click(function(){
      $("#showSubmitButtonSelect").html('<button class="btn btn-primary my-4" id="subBuyButtonOneWeek"> Buy Now</button>');
   }); 
   
   $("#selectThreeWeekOnly").click(function(){
      $("#showSubmitButtonSelect").html('<button class="btn btn-primary my-4" id="subBuyButtonThreeWeek"> Buy Now</button>');
   });

   $("#selectAllWeekOnly").click(function(){
      $("#showSubmitButtonSelect").html('<button class="btn btn-primary my-4" id="subBuyButtonAllWeek"> Buy Now</button>');
   });


$(document).ready(function(e){ 

   //----Calender start ------------------------------//
   $(function() {   //for calender//
      var startDate;
      var endDate;
      
      var selectCurrentWeek = function() {
         window.setTimeout(function () {
               $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
         }, 1);
      }
      
      $('.week-picker').datepicker( {
         showOtherMonths: true,
         selectOtherMonths: true,
         onSelect: function(dateText, inst) { 
            var date = $(this).datepicker('getDate');
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
            $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
            // selectCurrentWeek();

            var start = $.datepicker.formatDate(dateFormat, startDate, inst.settings); //12/18/2021
            var end   = $.datepicker.formatDate(dateFormat, endDate, inst.settings);  //mm/dd/yyy
            selectCurrentWeek();

            var d = new Date();  //Current Date
            // var currDate = (d.getMonth()+1) + "/" + d.getDate() + "/" + d.getFullYear();  //current date
            // alert(currDate); //test

            $("#subBuyButtonOneWeek").click(function(){  //For One Week

               if(start == "" || end == ""){
                  $("#selectShowError").text("Please select a week.");
                  return false;
               }else if(d > startDate){  //Compare with current date
                  $("#selectShowError").text("You can not select previous weeks.");
                  return false;
               }else{
                  $("#selectShowError").text(" ");
                  var stDate = start;
                  var edDate = end;
                  var amtWeek1 = $("#WeekBussAmt").html();
                  var amountWeek1 = amtWeek1.slice(0,-22);

                  $.ajax({
                     url: "oneweek",
                     type: "POST",
                     cache: false,
                     // data: {startDate:stDate, endDate:edDate, amount:amountWeek1},
                     data: {startDate:stDate, endDate:edDate, amount:amountWeek1, _token:'{{csrf_token()}}'},
                     
                     success:function(data) {
                        let obj  = JSON.parse(data); 
                        console.log(obj.status+ obj.message);

                        if(obj.status==true){
                           if(obj.message == "Success"){
                              location.href='webpayment';
                           }
                        }else if(obj.status==false){
                           $("#selectShowError").text(obj.message);
                           setTimeout(function(){
                              window.location.reload(1);
                           }, 4000);
                        }
                     }
                  });
               }
            });   
            
            $("#subBuyButtonThreeWeek").click(function(){  //For Three Week

               if(start == "" || end == ""){
                  $("#selectShowError").text("Please select a week.");
                  return false;
               }else if(d > startDate){  //Compare with current date
                  $("#selectShowError").text("You can not select previous weeks.");
                  return false;
               }else{
                  $("#selectShowError").text(" ");
                  var stDatea = start;
                  var edDatea = end;
                  var amtWeek2 = $("#threeWeekBussAmt").html();
                  var amountWeek2 = amtWeek2.slice(0,-22);

                  $.ajax({
                     // url: "{{route('threeweek')}}",
                     url: "threeweek",
                     type: "POST",
                     cache: false,
                     data: {startDate:stDatea, endDate:edDatea, amount:amountWeek2, _token:'{{csrf_token()}}'},
                     // processData: false,
                     // contentType: false,
                     
                     success:function(data) {

                        let obj  = JSON.parse(data); 
                        console.log(obj.status+ obj.message);
                        
                        if(obj.status==true){
                           if(obj.message == "Success"){
                              location.href='webpayment';
                           }
                        }else if(obj.status==false){
                           $("#selectShowError").text(obj.message);
                           setTimeout(function(){
                              window.location.reload(1);
                           }, 4000);
                        }
                     }
                  });
               }
            });  

            $("#subBuyButtonAllWeek").click(function(){  //For All Week

               if(start == "" || end == ""){ 
                  $("#selectShowError").text("Please select a week.");
                  return false;
               }else if(d > startDate){  //Compare with current date
                  $("#selectShowError").text("You can not select previous weeks.");
                  return false;
               }else{
                  $("#selectShowError").text(" ");
                  var stDateb = start;
                  var edDateb = end;
                  var amtWeek3 = $("#threeWeekBussAmt").html();
                  var amountWeek3 = amtWeek3.slice(0,-22);
 
                  $.ajax({
                     url: "allweek",
                     // url: "{{route('allweek')}}",
                     type: "POST",
                     cache: false,
                     data: {startDate:stDateb, endDate:edDateb, amount:amountWeek3, _token:'{{csrf_token()}}'},
                     // processData: false,
                     // contentType: false,
                     
                     success:function(data) {

                        let obj  = JSON.parse(data); 
                        console.log(obj.status+ obj.message);
                        
                        if(obj.status==true){
                           if(obj.message == "Success"){
                              location.href='webpayment';
                           }
                        }else if(obj.status==false){
                           $("#selectShowError").text(obj.message);
                           setTimeout(function(){
                              window.location.reload(1);
                           }, 4000);
                        }
                     }
                  });
               }
            });  
  
         },
         beforeShowDay: function(date) {
            var cssClass = '';
            if(date >= startDate && date <= endDate)
               cssClass = 'ui-datepicker-current-day';
            return [true, cssClass];
         },
         onChangeMonthYear: function(year, month, inst) {
            selectCurrentWeek();
         }
      });
      
      $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
      $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
   });
   //----Calender end ------------------------------//


   $(".nav-item a").removeClass("active");
   $("#subscriptions").addClass('active');

});

</script>
<script src="{{asset('assets/js/calendar.min.js')}} "></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>

