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
                           <li class="active"><a href="{{url('my-subscription')}}">My Subscription</a></li>
                           <li ><a href="{{url('notifications')}}">Notifications</a></li>
                           <li ><a href="{{url('ac-change-password')}}">Change Password</a></li>
                           <li ><a href="{{url('faqs')}}">FAQs</a></li>
                           <li ><a href="{{url('contact-us')}}">Contact Us</a></li>
                           <li><a href="{{url('/websignout')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               <div class="col-md-8">
                  <h4 class="acTitle">My Subscription</h4>
                  <div class="BoxShade offerBox my-4">
                     <div class="offerType d-sm-flex justify-content-between">
                        <div class="w-100 mb-5 mb-md-0">
                           <p><strong>Name of Plan</strong></p>
                           <p>Business of the week</p>
                           <p class="gap">&nbsp;</p>
                           <p><strong>Date of Activation</strong></p>
                           <p>2 Jun 2021</p>
                        </div>
                        <div class="w-100 mb-4 mb-md-0 ps-md-5">
                           <p><strong>Mode of Payment</strong></p>
                           <p>Card</p>
                           <p class="gap">&nbsp;</p>
                           <p><strong>Date of Expiration</strong></p>
                           <p>3 Jul 2021</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
@include("inc/footer");
