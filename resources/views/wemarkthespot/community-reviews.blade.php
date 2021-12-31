<?php

 $base_url =  URL::to('/');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@include("inc/header");
<style>
   .replys {
    position: relative;
    color: #d66821;
}
   label.error {
    display: inline-block;
    width: 100%;
    clear: both;
    margin-top: 8px;
    color: #db0707;
}
</style>

<script>
   function likedislike(businessreview_id,business_id,likedislike)
   {
      $.ajax({
            url: "{{ route('likedislikeweb') }}",
            type:'POST',
            'async': false,
        'global': false,
        'dataType': "json",
            data: {_token:"{{ csrf_token() }}", businessreview_id:businessreview_id, business_id:business_id,likedislike:likedislike},
            success: function(data) {
            if(data.status==true)
               {
                  window.location.reload();
               }
         }
                });
   }
   $(function(){
      
      $(".clklikedislike").on("click",function(){
         console.log("sd");
      });
      

      function GetMonthName(monthNumber) {
         var months = ['Jan', 'Feb', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'];
         return months[monthNumber - 1];
         }

      var app = @json($BusinessReview1);
         console.log(app);
       if(app.length >0)
         {
            for(i=0;i<app.length;i++)
            {
             html='<div class="col-md-12">';
                  html+='<div class="BoxShade commutyReview">';
                  if(app[i].user_image)
                  {
                     html+='<figure><img src="'+app[i].user_image+'"></figure>';
                  }
                  else{
                     html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
                  }
                     html+='<div class="user-Detail">';
                        html+='<h5>'+app[i].user_name+'</h5>';
                        dd  = app[i].created_at.split('T');
                        dateStr = dd[0].split('-');
                     dateYY = dateStr[0];
                     dateMM = dateStr[1];
                     dateDD = dateStr[2];
                     url = "community_reportweb/"+app[i].id+"/"+app[i].id;
                     html +='<p class="r-date">  '+dateDD +" " + GetMonthName(dateMM) +" " + dateYY+'</p>';
                        html+='<ul class="share-up">';
                           html+='<li><a href="'+url+'" data-business_id="'+app[i].id+'" data-review_id="'+app[i].id+'">Report</a></li>';
                        ////   ck = "onclick=return ("+app[i].id+","+app[i].business_id+","+1+")";

                           html +='<li class="clklikedislike" onclick="return likedislike('+app[i].id+','+app[i].business_id+','+1+')"  data-businessreview_id='+app[i].id+' data-business_id='+app[i].business_id+' data-like="1"><span class="icon-thumbs-up "  data-businessreview_id='+app[i].id+' data-business_id='+app[i].business_id+' data-llike="1"></span> '+app[i].total_like+'</li>';
                          
                     
                         // ck2 = "onclick=return ("+app[i].id+","+app[i].business_id+","+2+")";

                           html +='<li class="clklikedislike" onclick="return likedislike('+app[i].id+','+app[i].business_id+','+2+')"  data-businessreview_id='+app[i].id+' data-business_id='+app[i].business_id+' data-llike="2" class="" ><span class="icon-thumbs-down"></span> '+app[i].total_dislike+'</li>';
                        html+='</ul>';
                        html+='<p>'+app[i].review+'</p>';
                        if(app[i].image)
                        {
                           var extension = app[i].image.substr( (app[i].image.lastIndexOf('.') +1) ).toLowerCase();
                           if(extension=="png" || extension=="jpg" || extension=="jpeg" || extension=="gif" || extension=="svg")
                           {
                             

                             html+='<figure><img src="'+app[i].image+'"></figure>';
                           }
                           else  
                           {
                              html+='<video controls width="320" height="100"  autoplay muted loop><source src="'+app[i].image+'" ></video>';
                              
                              //html+='<video controls width="320" height="100"  autoplay muted loop><source src="https://builtenance.com/development/wemarkthespot/public/images/dd346b3afbc5f5560cc5826c77c1ab60.mp4" type="video/*" ></video>';

                           
                           //
                           }
                           
                        }else{
                           html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
                        }

                        html+='<div class=""><p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow'+i+'" role="button" aria-expanded="false" aria-controls="reviewshow'+i+'" style="display: inline-block;">&nbsp; </p><a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+app[i].id+'">Reply</a></div>';

                        html+='<div class="collapse" id="reviewshow'+i+'">';
                           //reply start
                              if(app[i].replies.length>0)
                              {
                                 repliesData = app[i].replies;
                                 count =1;
                                 for(r=0;r<repliesData.length;r++)
                                 {
                                   // console.log(repliesData[r].id);
                                    html+='<div class="Allreply">';
                                    if(repliesData[r].user.image)
                                    {
                                       html+='<figure><img src="'+repliesData[r].user.image+'"></figure>';
                                    }
                                    else
                                    {
                                       //html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
                                    }
                                    html+='<div class="review-detail">';
                                       html+='<h6>'+repliesData[r].user.name+'</h6>';
                                       html+='<p>'+repliesData[r].message+'</p>';
                                       if(repliesData.length==count)
                                       {
                                          html+='<p data-bs-toggle="collapse" style="display:inline-block;" class="replys " href="#reviewshow'+r+'" role="button" aria-expanded="false" aria-controls="reviewshow'+r+'"><img src="{{asset('assets/images/reply.png')}}" width="15px"> '+repliesData[r].children.length+' Reply </p>';
                                          html+='<a href="#"  class="reply btnreply ms-2" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+repliesData[r].id+'">Reply</a>';  
                            
                                       }
                                       else{
                                          html+='<p><div class="d-block"><a href="#"  class="reply btnreply ms-2" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+repliesData[r].id+'">Reply</a></div></p>';
                                       }
                             
                                          //end level 1
                                          if(repliesData.length==count)
                                          {
                                             level1 = repliesData[r].children;
                                             if(level1.length>0)
                                             {
                                                countlevel=1;
                                                for(l1 = 0; l1<level1.length;l1++)
                                                 {
                                                   level2 = level1[l1].children;

                                                   html+='<div class="collapse subthreads" id="reviewshow'+r+'">';
                                                   html+='<div class="Allreply">';
                                                      if(level1[l1].user.image)
                                                         {
                                                            html+='<figure><img src="'+level1[l1].user.image+'"></figure>';
                                                      
                                                         }else
                                                         {
                                                            html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
                                                         }
                                                         html+='<div class="review-detail">';
                                                         html+='<h6>'+level1[l1].user.name+'</h6>';
                                                         html+='<p>'+level1[l1].message+'</p>';
                                                         html+='<div/>';
                                                         //html+='<a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+level1[l1].id+'">Reply</a>';
                                                      html+='<div/>';
                                                  


                                                      if(level1.length==countlevel)
                                                      {
                                                         html+='<p data-bs-toggle="collapse" style="display:inline-block;" class="replys" href="#reviewshow'+0+r+'" role="button" aria-expanded="false" aria-controls="reviewshow'+0+r+'"><img src="{{asset('assets/images/reply.png')}}" width="15px"> '+level1[l1].children.length+' Reply </p>';
                                                         html+='<a href="#"  class="reply btnreply ms-2" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+level1[l1].id+'">Reply</a>'; 
                                                         
                                                         //level 2 start

                                                            if(level2.length>0)
                                                            {
                                                               countl2 = 1;
                                                               for(l2 = 0;l2<level2.length;l2++)
                                                               {
                                                                  html+='<div class="collapse" id="reviewshow'+0+r+'">';
                                                                     html+='<div class="Allreply">';
                                                                     console.log(level2[l2].id);

                                                                     level3 = level2[l2].children;

                                                                     if(level2[l2].user.image)
                                                                     {
                                                                        html+='<figure><img src="'+level2[l2].user.image+'"></figure>';
                                                                  
                                                                     }else
                                                                     {
                                                                        html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
                                                                     }
                                                                     html+='<div class="review-detail">';
                                                                        html+='<h6>'+level2[l2].user.name+'</h6>';
                                                                        html+='<p>'+level2[l2].message+'</p>';
                                                                     html+='<div/>';

                                                                     html+='<div/>';
                                                                     if(level2.length==countl2)
                                                                     {
                                                                        html+='<p data-bs-toggle="collapse" style="display:inline-block;" class="replys" href="#reviewshow'+1+r+'" role="button" aria-expanded="false" aria-controls="reviewshow'+1+r+'"><img src="{{asset('assets/images/reply.png')}}" width="15px"> '+level2[l2].children.length+' Reply </p>';
                                                                        html+='<a href="#"  class="reply btnreply ms-2" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+level2[l2].id+'">Reply</a>'; 
                                                                     }
                                                                     else
                                                                     {
                                                                        html+='<a href="#" class="reply btnreply ms-2" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+level2[l2].id+'">Reply</a>';
                                                                     }

                                                                    // console.log("level3"+level3.length);
                                                                     //level 3 start
                                                                     if(level3.length>0)
                                                                     {
                                                                        countleve3=1;
                                                                        for(cl3 = 0; cl3<level3.length;cl3++)
                                                                        {
                                                                           html+='<div class="collapse" id="reviewshow'+1+r+'">';
                                                                           html+='<div class="Allreply">';
                                                                           if(level3[cl3].user.image)
                                                                           {
                                                                              html+='<figure><img src="'+level3[cl3].user.image+'"></figure>';
                                                                        
                                                                           }else
                                                                           {
                                                                              html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
                                                                           }

                                                                              html+='<div class="review-detail">';
                                                                              html+='<h6>'+level3[cl3].user.name+'</h6>';
                                                                              html+='<p>'+level3[cl3].message+'</p>';
                                                                              html+='<a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+level3[cl3].id+'">Reply</a>';
                                                                              html+='</div>';
                                                                           html+='</div>';
                                                                           html+='</div>';
                                                                           countleve3++;
                                                                        }
                                                                      
                                                                     }
                                                                     //level 3 end
                                                                  html+='</div>';
                                                                  countl2 +=1;
                                                               }
                                                            }
                                                         // level 2 end
                                          
                                                      }
                                                      else{
                                                         html+='<a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+level1[l1].id+'">Reply</a>';

                                                      }
                                                   countlevel++;
                                                 }
                                             }
                                            
                                         
                                          }
                                          
										      html+=' </div>';
                                    html+='<div/>';
                                    count++;
                                 }
                              }
                           //close reply 
                        html+='<div/>';
                        //reply

                     html+='<div/>';
                  html+='<div/>';
             html+='<div/>';  
             $("#communityReviewData").append(html);
            }
         }
         // if(app.length >0)
      // {
      //    for(i=0;i<app.length;i++)
      //    {
      //       html='<div class="col-md-12">';
      //       html+='<div class="BoxShade commutyReview">';
      //       if(app[i].user_image)
      //       {
      //          html+='<figure><img src="'+app[i].user_image+'"></figure>';
      //       }
      //       else{
      //          html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
      //       }
            
      //       html+='<div class="user-Detail">';
      //          html+='<h5>'+app[i].user_name+'</h5>';
      //          dd  = app[i].created_at.split('T');
      //         dateStr = dd[0].split('-');
      //          dateYY = dateStr[0];
      //          dateMM = dateStr[1];
      //          dateDD = dateStr[2];
      //          url = "community_reportweb/"+app[i].id+"/"+app[i].id;
      //          html +='<p class="r-date">  '+dateDD +" " + GetMonthName(dateMM) +" " + dateYY+'</p>';
      //          html +='<ul class="share-up">';
      //          html+='<li><a href="'+url+'" data-business_id="'+app[i].id+'" data-review_id="'+app[i].id+'">Report</a></li>';
      //          html +='<li><span class="icon-thumbs-up"></span> '+app[i].total_like+'</li>';
      //          html +='<li><span class="icon-thumbs-down"></span> '+app[i].total_dislike+'</li>';
      //          html +='</ul>';
      //          html+=' <p>'+app[i].review+'</p>';
      //          if(app[i].image)
      //          {
      //             var extension = app[i].image.substr( (app[i].image.lastIndexOf('.') +1) ).toLowerCase();
      //             if(extension=="png" || extension=="jpg" || extension=="jpeg" || extension=="gif" || extension=="svg")
      //             {
      //                html+='<figure><img src="'+app[i].image+'"></figure>';
      //             }
      //             else   if(extension=="m4v" || extension=="avi" || extension=="mpg" || extension=="mp4" || extension=="mp3")
      //             {
      //                html+='<video controls width="320" height="100"  autoplay muted loop><source src="'+app[i].image+'" type="video/*" ></video>';
      //             }
                  
      //          }else{
      //             html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
      //          }
      //          html+='<p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow'+i+'" role="button" aria-expanded="false" aria-controls="reviewshow'+i+'">&nbsp;</p>';
             
      //          //review 1 
      //          if(app[i].replies.length>0)
      //          {
      //             html+='<div class="collapse" id="reviewshow'+i+'">';
      //             count=1;
      //             for(r=0;r<app[i].replies.length;r++)
      //             {
      //                   html+='<div class="Allreply">';
      //                   if(app[i].replies[r].user.image)
      //                      {
      //                         html+='<figure><img src="'+app[i].replies[r].user.image+'"></figure>';
                        
      //                      }else
      //                      {
      //                         html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
      //                      }


      //                      html+='<div class="review-detail">';
      //                      html+='<h6>'+app[i].replies[r].user.name+'</h6>';
      //                      html+='<p>'+app[i].replies[r].message+'</p>';
      //                      //============================================================================
      //                      level1 = app[i].replies[r].children;
      //                      console.log("level 1-->"+level1.length);
      //                      if(level1.length>0)
      //                      {
      //                         for(l1 = 0;l1<level1.length;l1++)
      //                         {
      //                            console.log("level1-->"+level1[l1]);
      //                         }
      //                      }
      //                      //========================================================================================
      //                      if(app[i].replies.length==count)
      //                      {
      //                       // html+='<a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+app[i].replies[r].id+'" ><img src="{{asset('assets/images/reply.png')}}" width="15px"> '+app[i].replies[r].children.length+' Reply</a>';
                             

      //                        html+='<p data-bs-toggle="collapse" class="replys" href="#reviewshow'+r+'" role="button" aria-expanded="false" aria-controls="reviewshow'+r+'"><img src="{{asset('assets/images/reply.png')}}" width="15px"> '+app[i].replies[r].children.length+' Reply</p>';
                          

      //                         html+='<div class="collapse subthreads" id="reviewshow'+r+'">';
      //                            html+='<div class="Allreply">';
      //                            html+=' <figure><img src="{{asset('assets/images/img-2.png')}}"></figure>';
      //                                  html+='<div class="review-detail">';
      //                                  html+=       '<h6>Emily Watson</h6>';
      //                                        html+=       '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo doloreset ea rebum.</p>';
      //                                        html+= '</div>';
      //                                        html+='</div>';
      //                                        html+='<div class="Allreply">';
      //                                        html+='<figure><img src="{{asset('assets/images/img-2.png')}}"></figure>';
      //                                        html+='<div class="review-detail">';

      //                                        html+='<h6>Emily Watson</h6>'
      //                                        html+='<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo doloreset ea rebum.</p>';
      //                                        html+=  '<p class="replys" data-bs-toggle="collapse" href="#reviewshow4" role="button" aria-expanded="false" aria-controls="reviewshow3"><img src="{{asset('assets/images/reply.png')}}" width="15px"> 01 Reply</p>';
      //                                  html+='<div class="collapse" id="reviewshow4">';
      //                                     html+='<div class="Allreply">';
      //                                        html+='<figure><img src="{{asset('assets/images/img-2.png')}}  "></figure>';
      //                                        html+='<div class="review-detail">';
      //                                        html+='<h6>Emily Watson</h6>';
      //                                        html+='<p>Lorem i et justo duo dolores et ea rebum.</p>';
      //                                        html+='</div>';
      //                                        html+='</div>';
      //                                     html+='</div>';
      //                                     html+= '</div>';
      //                                  html+='</div>';
      //                                  html+='</div>';
      //                         }
                         
      //                   html+='</div>';
      //                   html+='</div>';
                     
      //           count++;
      //             }
      //             html+='<div/>';//first review close
      //          }
                 
               
      //             html+='<div/>';//user-Detail class div close
               
      //       html+=' </div>';
      //       html+='<a href="#" class="reply" data-user_id = "'+app[i].business_id+'" data-type = "REVIEW" data-review_id = "'+app[i].id+'" data-reply_id = "'+app[i].id+'" data-bs-toggle="modal" data-bs-target="#exampleModal">Reply</a>';

      //       html+='</div>';
      //      $("#communityReviewData").append(html);
      //    }
      // }
      ///updated Code
      // for(i=0;i<app.length;i++)
      // {
      //    html=' <div class="BoxShade commutyReview">';
      //    if(app[i].user_image)
      //    {
      //       html+='<figure><img src="'+app[i].user_image+'"></figure>';
      //    }
      //    else{
      //       html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
      //    }
      //    html+='            <div class="user-Detail">';
      //    html+='<h5>'+app[i].user_name+'</h5>';
         
      //    dd  = app[i].created_at.split('T');
      //         dateStr = dd[0].split('-');
      //          dateYY = dateStr[0];
      //          dateMM = dateStr[1];
      //          dateDD = dateStr[2];
      //    html +=            '<p class="r-date">  '+dateDD +" " + GetMonthName(dateMM) +" " + dateYY+'</p>';
      //    url = "community_reportweb/"+app[i].id+"/"+app[i].id;
      //    html+='        <ul class="share-up">';
      //     html+='<li><a href="'+url+'" data-business_id="'+app[i].id+'" data-review_id="'+app[i].id+'">Report</a></li>';
      //    html+='           <li><span class="icon-thumbs-up"></span> '+app[i].total_like+'</li>';
      //    html+='           <li><span class="icon-thumbs-down"></span> '+app[i].total_dislike+'</li>';
      //    html+='        </ul>';
      //    html+='        <p>'+app[i].review+'</p>';

      //    if(app[i].image)
      //    {
      //       var extension = app[i].image.substr( (app[i].image.lastIndexOf('.') +1) ).toLowerCase();
      //       if(extension=="png" || extension=="jpg" || extension=="jpeg" || extension=="gif" || extension=="svg")
      //       {
      //          html+='<figure><img src="'+app[i].image+'"></figure>';
      //       }
      //       else   if(extension=="m4v" || extension=="avi" || extension=="mpg" || extension=="mp4" || extension=="mp3")
      //       {
      //          html+='<video controls width="320" height="100"  autoplay muted loop><source src="'+app[i].image+'" type="video/*" ></video>';
      //       }
            
      //    }else{
      //       html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
      //    }

      //    html+='        <p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow'+i+'" role="button" aria-expanded="false" aria-controls="#reviewshow'+i+'">&nbsp;</p>';
      //    html+='        <div class="collapse" id="reviewshow'+i+'">';
      //    //replies loop start
      //    if(app[i].replies.length>0)
      //    {
      //       for(r=0;r<app[i].replies.length;r++)
      //       {
      //          html+='  <div class="Allreply">';
      //          if(app[i].replies[r].user.image)
      //          {
      //             html+='<figure><img src="'+app[i].replies[r].user.image+'"></figure>';
            
      //          }else{
      //             html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
      //          }
      //          html+='              <div class="review-detail">';
      //          html+='                 <h6>'+app[i].replies[r].user.name+'</h6>';
      //          html+='                 <p>'+app[i].replies[r].message+'</p>';
      //          html+='                 <a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+app[i].replies[r].id+'" >Reply</a>';
      //          html+='              </div>';
                   
      //                if(app[i].replies[r].children.length > 0)
      //                {
                        
      //                   for(c1 =0; c1<app[i].replies[r].children.length;c1++)
      //                   {
      //                     // console.log(app[i].replies[r].children[c1].user.image);
      //                      //------------------------start----------------------------------------------
      //                      html+='<p style="margin-left: 65px;" class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow'+r+c1+'" role="button" aria-expanded="false" aria-controls="#reviewshow'+r+c1+'">&nbsp;</p>';
      //                      html+='<div class="collapse" id="reviewshow'+r+c1+'" style="margin-left: 65px;">';
      //                         html+='<div class="Allreply">';
      //                         if(app[i].replies[r].children[c1].user.image)
      //                         {
      //                            html+='<figure><img src="'+app[i].replies[r].children[c1].user.image+'"></figure>';
      //                         }else{
      //                            html+='<figure><img src="{{asset('assets/images/img-2.png')}}"></figure>';
      //                         }
      //                         html+='<div class="review-detail">';
      //                            html+='<h6>'+app[i].replies[r].children[c1].user.name+'</h6>';
      //                            html+='<p>'+app[i].replies[r].children[c1].message+'</p>';
      //                            html+='<a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+app[i].replies[r].children[c1].id+'">Reply</a>';
      //                         html+='</div>';
      //                      html+='</div>';
      //                               //level 3
      //                               if(app[i].replies[r].children[c1].children.length > 0)
      //                               {
      //                                  for(c2 =0; c2<app[i].replies[r].children[c1].children.length;c2++)
      //                                  {
      //                                     child2Data = app[i].replies[r].children[c1].children;
      //                                       //----------------------------Inner--start-----------------------------
      //                                     html+='<p style="margin-left: 65px;" class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow21'+c2+'" role="button" aria-expanded="false" aria-controls="#reviewshow21'+c2+'">&nbsp;</p>';
      //                                     html+='<div class="collapse" id="reviewshow21'+c2+'" style="margin-left: 65px;">';
      //                                        html+='<div class="Allreply">';
      //                                        if(child2Data[c2].user.image)
      //                                        {
      //                                           html+='<figure><img src="'+child2Data[c2].user.image+'"></figure>';
      //                                        }else{
      //                                           html+='<figure><img src="{{asset('assets/images/img-2.png')}}"></figure>';
      //                                        }
      //                                        html+='<div class="review-detail">';
      //                                           html+='<h6>'+child2Data[c2].user.name+'</h6>';
      //                                           html+='<p>'+child2Data[c2].message+'</p>';
      //                                           html+='<a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+child2Data[c2].id+'">Reply</a>';
      //                                        html+='</div>';
      //                                     html+='</div>';
      //                                     html+='</div>';
      //                      //=------------------------------Inner--End-----------------------------------
      //                               }
      //                         }
      //                      html+='</div>';
      //                      //--------------------------end--------------------------------------------
      //                   }
      //                }
      //          html+='        </div>';
      //          html+='     </div>';
      //    }
      // }
      //    html+='     <a href="#" class="btnreply" class="ReplyModel" data-bs-toggle="modal" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+app[i].id+'" data-bs-target="#exampleModal">Reply</a>';
          
      //             html+='</div>';
      //             $("#communityReviewData").append(html);
     // }
    
   });
    
    </script>
<main class="community-review">
         <div class="container-fluid">
            <h1 class="title">Community Reviews</h1>
            <div class="row gy-4">
               <div class="col-md-12" style="display:none">
                  <div class="BoxShade commutyReview">
                     <figure><img src="{{asset('assets/images/img-1.png')}}"></figure>
                     <div class="user-Detail">
                        <h5>Emily Watson</h5>
                        <p class="r-date">12 Jul 2021</p>
                        <ul class="share-up">
                           <li><a href="#">Report</a></li>
                           <li><span class="icon-thumbs-up"></span> 24</li>
                           <li><span class="icon-thumbs-down"></span> 12</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                        <a href="#" class="reply">Reply</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-12" id="communityReviewData">
                 
               </div>
               <div class="col-md-12" style="display:">
                 
               </div>
            </div>
         </div>
      </main>
      <!-- Modal -->
<div class="modal fade ReplyModel" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="replyform" action="javascript(0)" method="POST">  
      <div class="result"></div>
      <div class="modal-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
         <input type="hidden" id="type" name="type" value=""/>
         <input type="hidden" id="review_id" name="review_id" value=""/>
         <input type="hidden" id="reply_id" name="reply_id" value=""/>

      <textarea class="form-control" id="message" name="message" ></textarea>
      </div>
      <div class="modal-footer">
         <input type="submit" class="btn btn-primary" value="Reply"/> 
     
      </div>
      </form>
   </div>

  </div>
</div>

@include("inc/footer");
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
      $("#replyform").validate({
		rules: {
			message: {required: true,},
			
			
				},
			
		messages: {
			message: {required: "Please enter reply",},
		},
			submitHandler: function(form) {
			   var formData= new FormData(jQuery('#replyform')[0]);
            host_url = "/development/wemarkthespot/";
			jQuery.ajax({
					url: host_url+"replyform",
					type: "POST",
					cache: false,
					data: formData,
					processData: false,
					contentType: false,
					
					success:function(data) { 
					
					var obj = JSON.parse(data);
					
					if(obj.status==true){
						jQuery('#name_error').html('');
						jQuery('#email_error').html('');
						jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong style='color:red'>"+obj.message+"</strong> </div>");
						setTimeout(function(){
							jQuery('.result').html('');
							window.location = host_url+"community-reviews";
						}, 2000);
					}
					else{
						if(obj.status==false){
							jQuery('.result').html(obj.message);
							jQuery('#name_error').css("display", "block");
						}
						
					}
					}
				});
			}
		});

      $(".btnreply").on('click',function(){
         
         type =$(this).data("type");
         review_id = $(this).data('review_id');
         reply_id = $(this).data('reply_id');
         $("#reply_id").val(reply_id);
         $("#review_id").val(review_id);
         $("#type").val(type);

         $(".ReplyModel").modal('show');

         //alert("review_id"+review_id +"reply_id"+reply_id);
      })
     
      $(".nav-item a").removeClass("active");
      $("#community-reviews").addClass('active');
    });
 </script>



<style>
    .commutyReview figure img {
    border-radius: 50%;
}
 </style>