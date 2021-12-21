<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
 <main class="faqs">
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
                           <li><a href="{{url('notifications')}}">Notifications</a></li>
                           <li><a href="{{url('ac-change-password')}}">Change Password</a></li>
                           <li><a href="{{url('faqs')}}">FAQs</a></li>
                           <li class="active"><a href="{{url('contact-us')}}">Contact Us</a></li>
                           <li><a href="{{url('/websignout')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               <div class="col-md-8">
                  <h4 class="acTitle">Contact Us</h4>
                 <div class="row gy-4">
                    <div class="col-md-12 col-lg-6 d-flex align-items-stretch">
                       <div class="BoxShade contactICon w-100">
                        <span class="icon-mail"></span>
                        <h6>Mail</h6>
                        <p>wemarkthespot@gmail.com</p>
                       </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-items-stretch">
                       <div class="BoxShade contactICon w-100">
                           <span class="icon-location"></span>
                           <h6>Address</h6>
                           <p>321 Route 440, St 164 Jersey City, NJ 07305</p>
                       </div>
                    </div>
                 </div>
                 <div class="BoxShade mt-4">
                    <h4 class="mb-4">Get in Touch</h4>
                    <form>
                    <div class="row gy-4">
                       <div class="col-md-6 col-lg-4">
                           <label class="form-label">Name</label>
                           <input type="text" class="form-control" placeholder="Enter Name">
                       </div>
                       <div class="col-md-6 col-lg-4">
                           <label class="form-label">Email</label>
                           <input type="text" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-12 col-lg-4">
                           <label class="form-label">Phone Number</label>
                           <input type="text" class="form-control" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-12">
                           <label class="form-label">Comment</label>
                           <textarea class="form-control" placeholder="Type Comment"></textarea>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-primary mt-4">Send</button></div>
                  </form>
                 </div>
               </div>
            </div>
         </div>
      </main>
@include("inc/footer");
<script type="text/javascript">
    $(document).ready(function(e) {
      $(".nav-sidebar a").removeClass("active");
      $("#contact-us").addClass('active');
    });
  </script>