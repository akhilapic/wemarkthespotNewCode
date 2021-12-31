<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
<main class="community-review">
         <div class="container-fluid">
            <h1 class="title">Hotspot Updates</h1>
            @if($hotspot)
            <script>
    var app = @json($hotspot);
    console.log(app);
    </script>
            
            @foreach($hotspot as $k=> $host)
            <div class="row gy-4">
               <div class="col-md-12" >
                  <div class="BoxShade commutyReview">
                     <figure>

                        <!-- @if(isset($host->user_image)) -->
                        <!-- <img src="{{$host->user_image}}"> -->
                        <!-- @else -->
                        <img src="{{asset('assets/images/img-3.png')}}">
                        <!-- @endif -->
                        </figure>
                     <div class="user-Detail">
                        <h5> person_name @ business_user_name </h5>
                        <p class="r-date">1 hr ago</p>
                        <p>message</p>
                        <!-- <a href="#" class="reply">Reply</a> -->
                     </div>
                  </div>
               </div>
            
               <div class="col-md-12">
                  <div class="BoxShade commutyReview">
                     <figure> 
                        <!-- @if(isset($host->user_image))
                        <img src="{{$host->user_image}}">
                        @else -->
                        <img src="{{asset('assets/images/img-3.png')}}">
                       <!--  @endif -->
                     </figure>
                     <div class="user-Detail">
                        <h5>person_name @ business_user_name</h5>
                        <p class="r-date"> created_Date </p>
                        <p>$host->message</p>
                        <p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow{{$k}}" role="button" aria-expanded="false" aria-controls="reviewshow{{$k}}">&nbsp;</p>
                        <div class="collapse" id="reviewshow{{$k}}">
                           <div class="Allreply">
                              <figure><img src="{{asset('assets/images/img-2.png')}}"></figure>
                              <div class="review-detail">
                                 <h6>Emily Watson</h6>
                                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                              </div>
                           </div>
                        
                        </div>
                        <!-- <a href="#" class="reply">Reply</a> -->
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            @endif
            <div class="row currentCheck mt-4">
               <div class="col-md-6">
                  <h2>Current Check Ins</h2>
               </div>
               <div class="col-md-6 text-md-end"><h2 class="color2">102 Check-ins</h2></div>
            </div>
         </div>
      </main>

@include("inc/footer");
<script type="text/javascript">
    $(document).ready(function(e) {
      $(".nav-item a").removeClass("active");
      $("#hotspot-updates").addClass('active');
    });
 </script>