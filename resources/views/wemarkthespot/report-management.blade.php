<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
     <main class="reportManagement">
         <div class="container-fluid">
            <h1 class="title">Report Management</h1>
            <div class="row gy-4">
               <div class="col-md-4 col-lg-5  d-flex align-items-stretch">
                  <div class="BoxShade report text-center w-100">
                     <p>Total number of view on business profile</p>
                     <p class="totle">
                     @if($BusinessVisits>1000)
                     {{$BusinessVisits}} K 
                     @else
                     {{$BusinessVisits}}
                     @endif
                     Views</p>
                  </div>
               </div>
               <div class="col-md-8 col-lg-7 d-flex align-items-stretch">
                  <div class="w-100">
                  <div class="row gy-4">
                     <div class="col-md-6 col-lg-7 d-flex align-items-stretch">
                        <div class="BoxShade report text-center w-100">
                           <p>Total Number of check ins</p>
                           <p class="totle">{{$totalCheckin}}</p>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-5 d-flex align-items-stretch">
                        <div class="BoxShade report  text-center w-100">
                           <p>Overall Rating</p>
                           <p class="totle">{{$OverallRating}}<span class="icon-star"></span></p>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
               <div class="col-md-4 d-flex align-items-stretch">
                  <div class="BoxShade report w-100">
                     <!-- <canvas id="chart" height="400px"></canvas> -->
                     <img src="{{asset('assets/images/chart-1.png')}}">
                  </div>
               </div>
               <div class="col-md-8 d-flex align-items-stretch">
                  <div class="BoxShade report w-100">
                     <img src="{{asset('assets/images/chart-2.png')}}">
                  </div>
               </div>
            </div>
         
         </div>
      
     
      </main>
            <script src="{{asset('assets/js/jquery.min.js')}}"></script>
            <script src="{{asset('assets/js/popper.min.js')}} "></script>
            <script src="{{asset('assets/js/bootstrap.min.js')}} "></script>
            <script src="{{asset('assets/js/custom.js')}} "></script>
            <script src="{{asset('assets/js/chart.min.js')}}"></script>

            <script type="text/javascript">

               var data = {
           labels: ["Today", "Weekly", "Monthly"],
           datasets: [{
             label: 'My First Dataset',
             data: [600, 400, 1000,1400],
             backgroundColor: [
               'rgba(255, 63, 122, 1)',
               'rgba(181, 255, 255, 1)',
               'rgba(169, 134, 255, 1)',
             ],
           
             
           }]
         };

         var options = {
           maintainAspectRatio: false,
           scales: {
             y: {
               stacked: true,
               grid: {
                 display: false,
                 color: "rgba(255,99,132,0.2)"
               }
               
             },
             x: {
               grid: {
                 display: false
               }
             }
           }
         };

         new Chart('chart', {
           type: 'bar',
           options: options,
           data: data
});
      </script>
</script>
@include("inc/footer");
<script type="text/javascript">
    $(document).ready(function(e) {
      $(".nav-item a").removeClass("active");
      $("#report-management").addClass('active');
    });
 </script>

