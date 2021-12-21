<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<main class="community-review">
         <div class="container-fluid">
            <h1 class="title">Hotspot Updates</h1>
            <script>
 

    $(function(){

      function GetMonthName(monthNumber) {
         var months = ['Jan', 'Feb', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'];
         return months[monthNumber - 1];
         }

      var app = @json($hotspot);
     // console.log(app[0][0].children[0].user.image);
    // console.log(app[0][1].children.length);
 //  console.log();
   // dd  = app[0][0].created_at.split('T');
   //    dateStr = dd[0].split('-');
   //    dateYY = dateStr[0];
	// 	dateMM = dateStr[1];
	// 	dateDD = dateStr[2];
//      console.log(dateDD + GetMonthName(dateMM));
      for(i=0;i<app[0].length;i++)
      {
       

         html = '<div class="BoxShade commutyReview">';
         html +='<figure> ';
         if(app[0][i].user.image!='')
         {

            html +='<figure><img src="'+app[0][i].user.image+'"></figure>';
        
         }
         else{
               html += '<img src="{{asset('assets/images/img-3.png')}}">';
         }
        
         html += '</figure>';         
         html += '<div class="user-Detail">';         
         html += '<h5>'+app[0][i].user.name+'</h5>';  
         dd  = app[0][i].created_at.split('T');
        
         dateStr = dd[0].split('-');
         dateYY = dateStr[0];
         dateMM = dateStr[1];
         dateDD = dateStr[2];
         

         html +=            '<p class="r-date">  '+dateDD +" " + GetMonthName(dateMM) +" " + dateYY+'</p>';

         html +=             '<p>'+app[0][i].message+'</p>';
         html +=            '<p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow'+i+'" role="button" aria-expanded="false" aria-controls="reviewshow'+i+'">&nbsp;</p>'; 
         html +=             '<div class="collapse" id="reviewshow'+i+'">';
         

         // chid start loop
         html +=                '<div class="Allreply">';
         if(app[0][i].children.length>0)
         {
            for(c=0;c<app[0][i].children.length;c++)
            {
               if(app[0][i].children[c].user.image)
               {
                  html +='                <figure><img src="'+app[0][i].children[c].user.image+'"></figure>';
               }
               else
               {
                  html +='                <figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
               }
               html +=                   '<div class="review-detail">';
               html +=                      '<h6>'+app[0][i].children[c].user.name+'</h6>';
               html +=                      '<p>'+app[0][i].children[c].message+'</p>';
               html +=                   '</div>';
               html +=                '</div>';
            }
               
         }
           
         //chid end loop 
         html +=             '</div>';
         html +=             '<!-- <a href="#" class="reply">Reply</a> -->';
         html +=          '</div>';
         html +=       '</div>';
         $("#communityReviewData").append(html);
      }
//     $.each( app, function( key, value ) {
//       console.log(key + ": " + value);
// });

      //console.log(app);
     
  //  console.log(html);
    
   
    })
    </script>
            <div class="row gy-4">
              
            
               <div class="col-md-12" id="communityReviewData" >
                  
               </div>
            </div>
          
            <div class="row currentCheck mt-4">
               <div class="col-md-6">
                  <h2>Current Check Ins</h2>
               </div>
               <div class="col-md-6 text-md-end"><h2 class="color2">{{$total_checkin_count}} Check-ins</h2></div>
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