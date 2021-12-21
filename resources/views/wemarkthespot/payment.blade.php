<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
      <script>
         document.addEventListener('DOMContentLoaded', function() {
       var calendarEl = document.getElementById('calendar');
       var calendar = new FullCalendar.Calendar(calendarEl, {
         height: 'auto',
         width: '100%',
         nowIndicator: true,
         headerToolbar: {
           left: 'prev',
           center: 'title',
           right: 'next',
           allDaySlot: 'false',
         },
         selectable: true,
         selectHelper: true,
         longPressDelay: 1,
       });
     
       calendar.render();
     });
       </script>
<main class="subscription">
         <div class="container-fluid">
         <h1 class="title">Subscription Plans</h1>
         <div class="row gy-4">
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
               <div class="BoxShade package text-center w-100">
                  <h6>Business of the Week</h6>
                  <p class="price">$9.99 <span>Per Week</span></p>
                  <ul>
                     <li><span class="icon-checkmark"></span>Lorem ipsum dolor sit amet.</li>
                     <li><span class="icon-checkmark"></span>Lorem ipsum.</li>
                     <li><span class="icon-checkmark"></span>Sed diam voluptua.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                     <li><span class="icon-close"></span>Lorem ipsum dolor.</li>
                     <li><span class="icon-close"></span>Diam voluptua sed.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                  </ul>
                  <button type="button" class="btn btn-primary mt-5 px-4" data-bs-toggle="modal" data-bs-target="#calendarView">Buy Now</button>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
               <div class="BoxShade package text-center w-100">
                  <h6>Featured Business</h6>
                  <p class="price">$9.99 <span>Per Week</span></p>
                  <ul>
                     <li><span class="icon-checkmark"></span>Lorem ipsum dolor sit amet.</li>
                     <li><span class="icon-checkmark"></span>Lorem ipsum.</li>
                     <li><span class="icon-checkmark"></span>Sed diam voluptua.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                     <li><span class="icon-close"></span>Lorem ipsum dolor.</li>
                     <li><span class="icon-close"></span>Diam voluptua sed.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                  </ul>
                  <button type="button" class="btn btn-primary mt-5 px-4" data-bs-toggle="modal" data-bs-target="#calendarView">Buy Now</button>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
               <div class="BoxShade package text-center activePack w-100">
                  <!-- <span class="active icon-checkmark"></span> -->
                  <h6>Business of the Week & Featured Business</h6>
                  <p class="price">$9.99 <span>Per Week</span></p>
                  <ul>
                     <li><span class="icon-checkmark"></span>Lorem ipsum dolor sit amet.</li>
                     <li><span class="icon-checkmark"></span>Lorem ipsum.</li>
                     <li><span class="icon-checkmark"></span>Sed diam voluptua.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                     <li><span class="icon-close"></span>Lorem ipsum dolor.</li>
                     <li><span class="icon-close"></span>Diam voluptua sed.</li>
                     <li><span class="icon-close"></span>Consetetur sadipscing elitr.</li>
                  </ul>
                  <button type="button" class="btn btn-primary mt-5 px-4" data-bs-toggle="modal" data-bs-target="#calendarView">Buy Now</button>
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
                  <div id='calendar'></div>
                  <a href="{{url('payment')}}" class="btn btn-primary my-4"> Buy Now</a>
               </div>
            </div>
         </div>
      </div>

@include("inc/footer");
<script src="{{asset('assets/js/calendar.min.js')}} "></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>
