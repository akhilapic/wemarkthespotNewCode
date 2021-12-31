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
      console.log(app.length);
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
         $("#communityReviewData1").append(html);
      }

      //----------------------------------------------------Updated Code start--------------------------------------------------
      for(i=0;i<app.length;i++)
      {
       //  console.log(app[i]);
         topfirst = app[i];
         
         firstlevel = app[i].replies;
         console.log(firstlevel);
         html='<div class="BoxShade commutyReview">';
     //    html+='       <figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
         
         if(topfirst.user_image!=null)
         {
            html+='<figure><img src="'+topfirst.user_image+'"></figure>';
         }
         else
         {
            html+='   <figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
         }
         html+='<div class="user-Detail">';
         html += '<h5>'+topfirst.user_name+'</h5>'; 
         dd  = topfirst.created_at.split('T');
         dateStr = dd[0].split('-');
         dateYY = dateStr[0];
         dateMM = dateStr[1];
         dateDD = dateStr[2];
         html +=            '<p class="r-date">  '+dateDD +" " + GetMonthName(dateMM) +" " + dateYY+'</p>';
         html+='  <p>'+topfirst.message+'</p>';

         //frist child
            if(firstlevel.length>0)
            {
               for(c=0;c<firstlevel.length;c++)
               {
                  level2 = firstlevel[c].children;
               
                  html+=' <p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow1" role="button" aria-expanded="false" aria-controls="reviewshow1">&nbsp;</p>';
                  html+=' <div class="collapse" id="reviewshow1">';
                  html+='     <div class="Allreply">';
                     if(firstlevel[c].user.image!=null)
                     {
                        html+='<figure><img src="'+firstlevel[c].user.image+'"></figure>';
                     }
                     else
                     {
                        html+='<figure><img src="{{asset('assets/images/img-2.png')}}"></figure>';
                     }
                  html+='          <div class="review-detail">';
                  html+='             <h6>'+firstlevel[c].user.name+'</h6>';
                  html+='           <p>'+firstlevel[c].message+'</p>';
                  html+='      </div>';
                     //level2
                     if(level2.length > 0)
                     {
                        for(l2=0;l2<level2.length;l2++)
                        {
                           level3 = level2[l2].children;
                           html+=' <p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshowl2" role="button" aria-expanded="false" aria-controls="reviewshowl2">&nbsp;</p>';
                           html+='<div class="collapse" id="reviewshowl2">';
                              html+='  <div class="Allreply">';
                                 html+='   <figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
                              html+='  <div class="review-detail">';
                                    html+='   <h6>'+level2[l2].user.name+'</h6>';
                                    html+='  <p>'+level2[l2].message+'</p>';
                              html+='  </div>';

                              
                           //level3 start
                           if(level3.length>0)
                           {
                              for(l3=0;l3<level3.length;l3++)
                              {
                                 html+=' <p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow3" role="button" aria-expanded="false" aria-controls="reviewshow3">&nbsp;</p>';
                                 html+='<div class="collapse" id="reviewshow3">';
                                 html+='<div class="Allreply">';
                                 if(level3[l3].user.image!=null)
                                 {
                                    html+='<figure><img src="'+level3[l3].user.image+'"></figure>';
                                 }
                                 else
                                 {
                                    html+='<figure><img src="{{asset('assets/images/img-2.png')}}"></figure>';
                                 }
                                 html+='<div class="review-detail">';
                                 html+='<h6>'+level3[l3].user.name+'</h6>';
                                 html+='<p>'+level3[l3].message+'</p>';
                                 html+='</div>';
                                 html+='</div>';
                                 html+='</div>';
                              }
                              
                           }
                           
                           //level 3 end
                              html+='   </div>';
                        }
                     }
                  
                     //close level2

                     html+='</div>';
                     //close
                  html+='    </div>';
               }
            }
           
     
         html+='  </div>';
         html+='   <!-- <a href="#" class="reply">Reply</a> -->';
         html+='  </div>';
         html+='  </div>';
         $("#communityReviewData").append(html);
      }
   
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

 <style>
    .commutyReview figure img {
    border-radius: 50%;
}
 </style>