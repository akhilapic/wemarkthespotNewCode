<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");





 <main>
         <div class="container-fluid homeTop">
            <div class="row">
               <div class="col-md-5 d-flex align-items-center">
                  <div>
                     <h1 class="title">Lorem Ipsum Dolor sir amet</h1>
                     <p class="f-20 py-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea 
                        rebum.
                     </p>
                     <div class="d-flex">
                        <a href="#" class="me-4"><img src="{{asset('assets/images/andriod.png')}}"></a>
                        <a href="#"><img src="{{asset('assets/images/ios.png')}}"></a>
                     </div>
                     
                  </div>
               </div>
               <div class="col-md-7 col-lg-6 offset-lg-1">
                  <figure><img src="{{asset('assets/images/Location search-rafiki.png')}}"></figure>
               </div>
            </div>
            <div class="futcher text-center mt-60">
               <div class="row">
                  <div class="col-lg-8 col-xxl-6 mx-auto">
                     <h2>Features loved by our users</h2>
                     <p class="my-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                  </div>
               </div>
               <div class="row mt-4 gy-4">
                  <div class="col-md-6 col-lg-3">
                     <div class="fBox">
                        <img src="{{asset('assets/images/chat.png')}}">
                        <h5>Chats</h5>
                        <p>Lorem ipsum dolor sit amet, cotur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut lab.</p>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="fBox">
                        <img src="{{asset('assets/images/purse.png')}}">
                        <h5>Free Sign up</h5>
                        <p>Lorem ipsum dolor sit amet, cotur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut lab.</p>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="fBox">
                        <img src="{{asset('assets/images/feedback.png')}}">
                        <h5>User Friendly</h5>
                        <p>Lorem ipsum dolor sit amet, cotur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut lab.</p>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="fBox">
                        <img src="{{asset('assets/images/location.png')}}">
                        <h5>Easy Access</h5>
                        <p>Lorem ipsum dolor sit amet, cotur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut lab.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <section class="downLoad">
            <div class="container">
               <div class="row gy-4 justify-content-center">
                  <div class="col-md-4">
                     <figure><img src="{{asset('assets/images/phone.png')}}"></figure>
                  </div>
                  <div class="col-lg-7 d-flex align-items-center">
                     <div>
                        <h2 class="title">Download user app now</h2>
                        <p class="py-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea ebum.</p>
                        <div class="d-flex">
                           <a href="#" class="me-4"><img src="{{asset('assets/images/andriod.png')}}"></a>
                           <a href="#"><img src="{{asset('assets/images/ios.png')}}"></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="appWork">
            <div class="container-fluid">
               <div class="row mb-5">
                  <div class="col-lg-7 mx-auto text-center">
                     <h2>How does this app work</h2>
                     <p class="my-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut 
                        labore et dolore magna aliquyam erat, sed diam voluptua.
                     </p>
                  </div>
               </div>
               <div class="row gy-5">
                  <div class="col-xl-6 text-center">
                     <figure><img src="{{asset('assets/images/Address-bro.jpg')}}"></figure>
                  </div>
                  <div class="col-xl-6">
                     <ul>
                        <li>
                           <div class="WorkBox">
                              <span class="icon-work-1"></span>
                              <h5>Open app</h5>
                              <p>Lorem ipsum dolor sit amet, cotur sadipscing elitr, sed diam.</p>
                           </div>
                        </li>
                        <li>
                           <div class="WorkBox">
                              <span class="icon-work-2"></span>
                              <h5>Sign in/Sign up</h5>
                              <p>Lorem ipsum dolor sit amet, cotur sadipscing elitr, sed diam.</p>
                           </div>
                        </li>
                        <li>
                           <div class="WorkBox">
                              <span class="icon-work-3"></span>
                              <h5>Explore</h5>
                              <p>Lorem ipsum dolor sit amet, cotur sadipscing elitr, sed diam.</p>
                           </div>
                        </li>
                        <li>
                           <div class="WorkBox">
                              <span class="icon-work-4"></span>
                              <h5>Explore</h5>
                              <p>Lorem ipsum dolor sit amet, cotur sadipscing elitr, sed diam.</p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </section>
      </main>


	@include("inc/footer");