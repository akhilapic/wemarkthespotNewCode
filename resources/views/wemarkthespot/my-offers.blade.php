<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
 <main class="Myoffer">
         <div class="container-fluid">
            <h1 class="title">My Offers</h1>
            <div class="row gy-4">
               <div class="col-lg-4">
                  <div class="BoxShade offerBox">
                    <h6>Business Category</h6>
                    <p>Online Only</p>
                     <div class="offerType d-sm-flex justify-content-between my-4">
                        <div>
                           <p><strong>Offer</strong></p>
                           <p>Friday Night</p>
                           <p><strong>Date of activation</strong></p>
                           <p>12 Aug 2021</p>
                        </div>
                        <div>
                           <p><strong>Offer Type</strong></p>
                           <p>Happy Hours</p>
                           <p><strong>Date of deactivation</strong></p>
                           <p>17 Aug 2021</p>
                        </div>
                     </div>
                     <h6>Offer Message</h6>
                     <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                     
                     <div class="text-center mt-4">
                        <a href="#"><span class="icon-edit"></span></a>
                     <a href="#"><span class="icon-delete"></span></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="BoxShade offerBox">
                     <h6>Business Category</h6>
                     <p>Online Only</p>
                      <div class="offerType d-sm-flex justify-content-between my-4">
                         <div>
                            <p><strong>Offer</strong></p>
                            <p>Friday Night</p>
                            <p><strong>Date of activation</strong></p>
                            <p>12 Aug 2021</p>
                         </div>
                         <div>
                            <p><strong>Offer Type</strong></p>
                            <p>Happy Hours</p>
                            <p><strong>Date of deactivation</strong></p>
                            <p>17 Aug 2021</p>
                         </div>
                      </div>
                      <h6>Offer Message</h6>
                      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                      
                      <div class="text-center mt-4">
                         <a href="#"><span class="icon-edit"></span></a>
                      <a href="#"><span class="icon-delete"></span></a>
                      </div>
                   </div>
               </div>
               <div class="col-lg-4">
                  <div class="BoxShade offerBox">
                     <h6>Business Category</h6>
                     <p>Online Only</p>
                      <div class="offerType d-sm-flex justify-content-between my-4">
                         <div>
                            <p><strong>Offer</strong></p>
                            <p>Friday Night</p>
                            <p><strong>Date of activation</strong></p>
                            <p>12 Aug 2021</p>
                         </div>
                         <div>
                            <p><strong>Offer Type</strong></p>
                            <p>Happy Hours</p>
                            <p><strong>Date of deactivation</strong></p>
                            <p>17 Aug 2021</p>
                         </div>
                      </div>
                      <h6>Offer Message</h6>
                      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                      
                      <div class="text-center mt-4">
                         <a href="#"><span class="icon-edit"></span></a>
                      <a href="#"><span class="icon-delete"></span></a>
                      </div>
                   </div>
               </div>
            </div>
            <div class="text-center mt-5 mb-1"><button type="button" class="addmore btn btn-primary px-4">Add New Offer</button></div>
            
            <section class="addoffers">
               <h1 class="title">Add New Offer</h1>
               <div class="BoxShade my-4">
                  <form>
                  <div class="row gy-5">
                        <div class="col-md-4">
                           <label class="form-label">Business Category</label>
                           <select class="form-select" aria-label="Default select example">
                              <option selected>Select Business Category</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                           </select>
                        </div>

                           <div class="col-md-4">
                              <label class="form-label">Name of Offer</label>
                              <input type="text" class="form-control" placeholder="Enter Name of Offer">
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Offer Type</label>
                              <select class="form-select" aria-label="Default select example">
                                 <option selected>Select Offer Type</option>
                                 <option value="1">One</option>
                                 <option value="2">Two</option>
                                 <option value="3">Three</option>
                              </select>
                           </div>
                           <div class="col-md-6 datepiker">
                              <label class="form-label">Date of Activation</label>
                              <input type="date" class="form-control" value="2021-10-21">
                             
                              <span class="open-button icon-calendar"></span>
                           </div>
                           <div class="col-md-6 datepiker">
                              <label class="form-label">Date of Deactivation</label>
                              <input type="date" class="form-control" value="2021-10-21">
                              <span class="open-button icon-calendar"></span>
                           </div>
                           <div class="col-md-12">
                              <label class="form-label">Offer Message</label>
                              <textarea class="form-control" placeholder="Type Offer Message"></textarea>
                           </div>
                  </div>
                  <div class="text-center mt-5 mb-4"><button type="submit" class="addmore btn btn-primary px-4">Add Offer</button></div>
               </form>
               </div>
            </section>
            
         </div>
      </main>

@include("inc/footer");

<script type="text/javascript">
    $(document).ready(function(e) {
   //   alert("s");
      $(".nav-item a").removeClass("active");
      $("#my-offers").addClass('active');
    });
 </script>