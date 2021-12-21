<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
    <main class="mt-lg-0">
      <section class="change-password">
         <div class="container-fluid">
            <div class="row gy-5">
               <div class="col-lg-6 p-5 p-lg-0">
                  <img src="{{asset('assets/images/Forgot-password.png')}}">
               </div>
               <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                  <div class="login w-100">
                     <div class=" text-center mb-4">
                        <h1 class="title">Change Password</h1>
                     </div>
                     <form class="mt-100" action="{{url('login')}}">
                        <div class="mb-4">
                           <label for="password" class="form-label">New Password</label>
                           <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter New Password">
                        </div>
                        <div class="mb-4">
                           <label for="password" class="form-label">Confirm New Password</label>
                           <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Confirm Password">
                        </div>
                        <div class="w-50 mx-auto my-5">
                           <button type="submit" class="btn btn-primary w-100 mt-xl-5">Sign in</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </main>
@include("inc/footer");