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
                     <figure>
                        @if($account->business_images)   
                        <img src="{{$account->business_images}}">
                        @elseif($account->image)
                        <img src="{{$account->image}}">
                      
                        else
                      
                        <img src="{{asset('assets/images/img-6.png')}}">
                        @endif

                     </figure>
                        @if($account->business_name)  
                     <p>{{$account->business_name}}</p>
                     @else
                     <p>Business Name</p>
                     @endif
                     @if($account->ratting)

<p class="rating">@if($account->ratting)  
                     {{$account->ratting}}
                     @else
                     0.0
                     @endif <span class="icon-star"></span></p>
@else
<p class="rating">0.0 <span class="icon-star"></span></p>
@endif
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
                    @if($faq)
                      @foreach($faq as $k=> $f)
                      <div class="accordion-item">
                     <h2 class="accordion-header" id="flush-headingOne{{$k}}">
                         <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$k}}" aria-expanded="false" aria-controls="flush-collapseOne{{$k}}">
                           {{$f->question}}
                         </button>
                       </h2>
                       <div id="flush-collapseOne{{$k}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                         <div class="accordion-body">{{$f->answers}}</div>
                       </div>
                     </div>
                     @endforeach
                    @endif 
                   
                  
                  
               </div>
            </div>
         </div>
      </main>

@include("inc/footer");
