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
                           <li class="active"><a href="{{url('faqs')}}">FAQs</a></li>
                           <li ><a href="{{url('contact-us')}}">Contact Us</a></li>
                           <li><a href="{{url('/websignout')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               <div class="col-md-8">
                  <h4 class="acTitle">FAQs</h4>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                     <div class="accordion-item">
                       <h2 class="accordion-header" id="flush-headingOne">
                         <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                           Lorem ipsum dolor sit amet?
                         </button>
                       </h2>
                       <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                         <div class="accordion-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore mana aliqm erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</div>
                       </div>
                     </div>
                     <div class="accordion-item">
                       <h2 class="accordion-header" id="flush-headingTwo">
                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                           Lorem ipsum dolor sit amet?
                         </button>
                       </h2>
                       <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                         <div class="accordion-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore mana aliqm erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</div>
                       </div>
                     </div>
                     <div class="accordion-item">
                       <h2 class="accordion-header" id="flush-headingThree">
                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                           Lorem ipsum dolor sit amet?
                         </button>
                       </h2>
                       <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                         <div class="accordion-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore mana aliqm erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</div>
                       </div>
                     </div>
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            Lorem ipsum dolor sit amet?
                          </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore mana aliqm erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFive">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFour">
                            Lorem ipsum dolor sit amet?
                          </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore mana aliqm erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</div>
                        </div>
                      </div>
                   </div>
                  
               </div>
            </div>
         </div>
      </main>

@include("inc/footer");
