<?php

 $base_url =  URL::to('/');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@include("inc/header");
<style>
   label.error {
    display: inline-block;
    width: 100%;
    clear: both;
    margin-top: 8px;
    color: #db0707;
}</style>
<script>
   $(function(){
      function GetMonthName(monthNumber) {
         var months = ['Jan', 'Feb', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'];
         return months[monthNumber - 1];
         }

      var app = @json($BusinessReview1);
     
      for(i=0;i<app.length;i++)
      {
         console.log(app);
             html=' <div class="BoxShade commutyReview">';
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
        

         html +=            '<p class="r-date">  '+dateDD +" " + GetMonthName(dateMM) +" " + dateYY+'</p>';
         html+='        <ul class="share-up">';
         html+='           <li><a href="javascript:void(0)" data-business_id="'+app[i].id+'" data-review_id="'+app[i].id+'">Report</a></li>';
         html+='           <li><span class="icon-thumbs-up"></span> '+app[i].total_like+'</li>';
         html+='           <li><span class="icon-thumbs-down"></span> '+app[i].total_dislike+'</li>';
         html+='        </ul>';
         html+='        <p>'+app[i].review+'</p>';
       
         if(app[i].image)
         {
            html+='<figure><img src="'+app[i].image+'"></figure>';
         }else{
            html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
         }
         html+='<p class="Viewrepla" data-bs-toggle="collapse" href="#collapseExample'+i+'" role="button" aria-expanded="false" aria-controls="collapseExample">&nbsp;</p>';
         html+='<div class="collapse" id="collapseExample'+i+'">';
         //replies loop start
          if(app[i].replies.length>0)
         {
            for(r=0;r<app[i].replies.length;r++)
            {
             //  console.log(app[i].replies[r].message);
               html+='           <div class="Allreply">';
               
               if(app[i].replies[r].user.image)
               {
                  html+='<figure><img src="'+app[i].replies[r].user.image+'"></figure>';
            
               }else{
                  html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
               }

               html+='              <div class="review-detail">';
               html+='                 <h6>'+app[i].replies[r].user.name+'</h6>';
               html+='                 <p>'+app[i].replies[r].message+'</p>';
               
               html+='<a href="#" class="reply">Reply</a>';
               html+='              </div>';
               html+='           </div>';
            }
         }
         // replies loop end
         html+='        </div>';
         html+='         <a href="#" class="reply" data-user_id = "'+app[i].business_id+'" data-type = "REVIEW" data-review_id = "'+app[i].replies[0].id+'" data-reply_id = "'+app[i].id+'" data-bs-toggle="modal" data-bs-target="#exampleModal">Reply</a>';
         html+='     </div>';
         html+='  </div>';
         $("#communityReviewData1").append(html);
      }


      ///updated Code
      for(i=0;i<app.length;i++)
      {
         html=' <div class="BoxShade commutyReview">';
         if(app[i].user_image)
         {
            html+='<figure><img src="'+app[i].user_image+'"></figure>';
         }
         else{
            html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
         }
         html+='            <div class="user-Detail">';
         html+='<h5>'+app[i].user_name+'</h5>';
         
         dd  = app[i].created_at.split('T');
              dateStr = dd[0].split('-');
               dateYY = dateStr[0];
               dateMM = dateStr[1];
               dateDD = dateStr[2];
         html +=            '<p class="r-date">  '+dateDD +" " + GetMonthName(dateMM) +" " + dateYY+'</p>';
         url = "community_reportweb/"+app[i].id+"/"+app[i].id;
         html+='        <ul class="share-up">';
          html+='<li><a href="'+url+'" data-business_id="'+app[i].id+'" data-review_id="'+app[i].id+'">Report</a></li>';
         html+='           <li><span class="icon-thumbs-up"></span> '+app[i].total_like+'</li>';
         html+='           <li><span class="icon-thumbs-down"></span> '+app[i].total_dislike+'</li>';
         html+='        </ul>';
         html+='        <p>'+app[i].review+'</p>';

         if(app[i].image)
         {
            html+='<figure><img src="'+app[i].image+'"></figure>';
         }else{
            html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
         }

         html+='        <p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow'+i+'" role="button" aria-expanded="false" aria-controls="reviewshow1">&nbsp;</p>';
         html+='        <div class="collapse" id="reviewshow'+i+'">';
         //replies loop start
         if(app[i].replies.length>0)
         {
            for(r=0;r<app[i].replies.length;r++)
            {
               html+='  <div class="Allreply">';
               if(app[i].replies[r].user.image)
               {
                  html+='<figure><img src="'+app[i].replies[r].user.image+'"></figure>';
            
               }else{
                  html+='<figure><img src="{{asset('assets/images/img-3.png')}}"></figure>';
               }
               html+='              <div class="review-detail">';
               html+='                 <h6>'+app[i].replies[r].user.name+'</h6>';
               html+='                 <p>'+app[i].replies[r].message+'</p>';
               html+='                 <a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+app[i].replies[r].id+'" >Reply</a>';
               html+='              </div>';
                   
                     if(app[i].replies[r].children.length > 0)
                     {
                        for(c1 =0; c1<app[i].replies[r].children.length;c1++)
                        {
                          // console.log(app[i].replies[r].children[c1].user.image);
                           //------------------------start----------------------------------------------
                           html+='<p style="margin-left: 65px;" class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow2" role="button" aria-expanded="false" aria-controls="reviewshow2">&nbsp;</p>';
                           html+='<div class="collapse" id="reviewshow2" style="margin-left: 65px;">';
                              html+='<div class="Allreply">';
                              if(app[i].replies[r].children[c1].user.image)
                              {
                                 html+='<figure><img src="'+app[i].replies[r].children[c1].user.image+'"></figure>';
                              }else{
                                 html+='<figure><img src="{{asset('assets/images/img-2.png')}}"></figure>';
                              }
                              html+='<div class="review-detail">';
                                 html+='<h6>'+app[i].replies[r].children[c1].user.name+'</h6>';
                                 html+='<p>'+app[i].replies[r].children[c1].message+'</p>';
                                 html+='<a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+app[i].replies[r].children[c1].id+'">Reply</a>';
                              html+='</div>';
                           html+='</div>';
                                    //level 3
                                    if(app[i].replies[r].children[c1].children.length > 0)
                                    {
                                       for(c2 =0; c2<app[i].replies[r].children[c1].children.length;c2++)
                                       {
                                          child2Data = app[i].replies[r].children[c1].children;

//                                          console.log();
                                            //----------------------------Inner--start-----------------------------
                                          html+='<p style="margin-left: 65px;" class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow2" role="button" aria-expanded="false" aria-controls="reviewshow2">&nbsp;</p>';
                                          html+='<div class="collapse" id="reviewshow2" style="margin-left: 65px;">';
                                             html+='<div class="Allreply">';
                                             if(child2Data[c2].user.image)
                                             {
                                                html+='<figure><img src="'+child2Data[c2].user.image+'"></figure>';
                                             }else{
                                                html+='<figure><img src="{{asset('assets/images/img-2.png')}}"></figure>';
                                             }
                                             html+='<div class="review-detail">';
                                                html+='<h6>'+child2Data[c2].user.name+'</h6>';
                                                html+='<p>'+child2Data[c2].message+'</p>';
                                                html+='<a href="#" class="reply btnreply" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+child2Data[c2].id+'">Reply</a>';
                                             html+='</div>';
                                          html+='</div>';
                                          html+='</div>';
                           //=------------------------------Inner--End-----------------------------------
                                    }
                              }
                           html+='</div>';
                           //--------------------------end--------------------------------------------

                          
                        }
                     }
               html+='        </div>';
               html+='     </div>';
         }
      }
         html+='     <a href="#" class="btnreply" class="ReplyModel" data-bs-toggle="modal" data-review_id ="'+app[i].id+'" data-type="REVIEW" data-reply_id ="'+app[i].id+'" data-bs-target="#exampleModal">Reply</a>';
          
                  html+='</div>';
                  $("#communityReviewData").append(html);
      }
    
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
						jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>"+obj.message+"</strong> </div>");
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