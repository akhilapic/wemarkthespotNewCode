<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
<main class="my-notification">
         <div class="container-fluid">
            <h1 class="title">Account Settings</h1>
            <div class="row gy-5">
               <div class="col-md-4 pe-lg-5">
                  <aside>
                     <div class="BoxShade UserBox mb-4">
                        <figure><img src="{{asset('assets/images/img-6.png')}}"></figure>
                        <p><strong>Royal Bar</strong></p>
                        <p class="rating">4.7 <span class="icon-star"></span></p>
                        <p class="verify">Verified</p>
                     </div>
                     <div class="BoxShade">
                        <ul>
                           <li><a href="{{url('my_account')}}">My Profile</a></li>
                           <li><a href="{{url('my-subscription')}}">My Subscription</a></li>
                           <li class="active"><a href="{{url('notifications')}}">Notifications</a></li>
                           <li ><a href="{{url('ac-change-password')}}">Change Password</a></li>
                           <li ><a href="{{url('faqs')}}">FAQs</a></li>
                           <li ><a href="{{url('contact-us')}}">Contact Us</a></li>
                           <li><a href="{{url('/websignout')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               <div class="col-md-8">
                  <h4 class="acTitle">Notifications</h4>
                  <div class="BoxShade mb-4">
                     <ul class="list-group">
                        <li class="list-group-item">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-3">Payment successful</h5>
                            <small>1 hr ago</small>
                          </div>
                          <p class="mb-1">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore 
                           magna aliquyam erat, sed diam voluptua.</p>
                        </li>
                        <li class="list-group-item">
                           <div class="d-flex w-100 justify-content-between">
                             <h5 class="mb-3">1 New Check-in</h5>
                             <small>1 hr ago</small>
                           </div>
                           <p class="mb-1">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore 
                            magna aliquyam erat, sed diam voluptua.</p>
                         </li>
                         <li class="list-group-item">
                           <div class="d-flex w-100 justify-content-between">
                             <h5 class="mb-3">Received Hotspot Update</h5>
                             <small>1 hr ago</small>
                           </div>
                           <p class="mb-1">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore 
                            magna aliquyam erat, sed diam voluptua.</p>
                         </li>
                         <li class="list-group-item">
                           <div class="d-flex w-100 justify-content-between">
                             <h5 class="mb-3">Payment successful</h5>
                             <small>1 hr ago</small>
                           </div>
                           <p class="mb-1">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore 
                            magna aliquyam erat, sed diam voluptua.</p>
                         </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </main>
@include("inc/footer");
