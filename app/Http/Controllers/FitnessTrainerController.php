<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Str;
use Carbon\Carbon;
use Hash;
use App\Models\User;
use App\Models\Categorys;
use App\Models\SubCategorys;
use App\Models\FitnessTrainers;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception;
use Validator;
use App\Models\Quoates;
use App\Models\BusinessReviews;
use App\Models\BuinessReports;
use App\Models\Contactus;
use App\Models\Hotspots;
use App\Models\Businessreviewlikedislike;
use App\Models\Faqs;
use App\Models\Aboutus;
use App\Models\Subscriptions;
use App\Models\Payments;

class FitnessTrainerController extends Controller
{
    public function index()
    {
        date_default_timezone_set("Asia/Kolkata");
        $data['active']="beaTrainer";
        return view('BeaTrainer',$data);
    }
  public function add_quotes() { // create category
      return view('Pages.add_quotes');
   }
   
    public function getdata()
    {
      $fitnesstrainer  =  User::where("role",99)->orderBy('id', 'DESC')->get();
      return view('Pages.fitnesstrainers.manager_firness_trainers', compact('fitnesstrainer'));
    }
    public function getdatacategory()
    {
         $categorys  =  Categorys::orderBy('id', 'DESC')->get();
//    dd($categorys);

     return view('Pages.fitnesstrainers.manager_category',compact('categorys'));   
    }
    public function create() { // create category
      return view('Pages.add_category');
   }


   public function categorydata(Request $request)
   {
    //dd($request->input());
        if($request->input())
        {
            $image_url=url('public/images/userimage.png');
            $Validation = Validator::make($request->all(),[
                   'name' => 'unique:categorys',
            ]);
            if($Validation->fails())
            {
                  $result=array('status'=>false,'message'=> 'categorys name Already exists.' ,'error'=>$Validation->errors());
            }
            else
            {
                $fileimage="";
                $image_url='';
                if($request->hasfile('image'))
               {
                 $file_image=$request->file('image');
                 $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                 $destination=public_path("images");
                 $file_image->move($destination,$fileimage);
                 $image_url=url('public/images').'/'.$fileimage;
              
               }
               else
               {
                 $image_url= $usreData->image;
               }
                $date = date("Y-m-d h:i:s", time());
                $detail_Information = $request->detail_information;

                $data = ['name'=>$request->name,'short_information'=>$request->short_information,'detail_information'=>$detail_Information,'image'=>$image_url,'updated_at'=>date("Y-m-d h:i:s", time()),'created_at'=>date("Y-m-d h:i:s", time())];
            
                $insertRecord=    Categorys::create($data);
                if($insertRecord){
                    $result = array('status'=> true, 'message'=>'Category Added  successfully.');
                   }
                   else{
                    $result = array('status'=> false, 'message'=>'Profile Update  Failed.');
                   }
            }
            echo json_encode($result);
        }
   }
    /*
    public function fitness_trainer_dataold(Request $request)
    {
         $fitnesstrainer  =  new FitnessTrainers();
        if(!empty($request->input()))
        {
            $mobile_number =  $fitnesstrainer->where("mobile_number",$request->mobile_number)->first();
            $checkemail =  $fitnesstrainer->where("email",$request->email)->first();
            
            if(!is_null($mobile_number))
            {
               $result=array('statusmobile_number'=> false,'message'=> 'Mobile Number is allready taken.');
            }
            else if(!is_null($checkemail))
            {
               $result=array('statusemail'=> false,'message'=> 'Email is allready taken.');
            }
            else if(is_null($checkemail) && is_null($mobile_number))
            {
                $fitnesstrainer->name = $request->name;
                $fitnesstrainer->email = $request->email;
                $fitnesstrainer->country_code = $request->country_code;
          
                $fitnesstrainer->mobile_number = $request->mobile_number;
                $fitnesstrainer->gender = $request->gender;
                $fitnesstrainer->specialization =  implode(",",$request->specialization);
                $fileimage="";
                $image_url='';
             
                if($request->hasfile('upload_doc'))
                {
                    $file_image=$request->file('upload_doc');
                    $fileimage=$file_image->getClientOriginalName();
                    $fitnesstrainer->upload_doc = $fileimage;
                    $destination=public_path("upload_doc");
                    $file_image->move($destination,$fileimage);
                }   
             
                $fitnesstrainer->address = $request->address;
                $fitnesstrainer->updated_at = date("Y-m-d h:i:s");
                $fitnesstrainer->created_at = date("Y-m-d h:i:s");
                $fitnesstrainer->status = 1;
             
                $fitnesstrainers =  $fitnesstrainer->save();
             
                if($fitnesstrainers){
                    $result=array('status'=>true,'message'=> 'Your Request Send  Successfully.');
                }
                else{
                    $result=array('status'=>false,'message'=> 'Your Request Send Not Successfully.');
                } 
            }
        }
        echo json_encode($result);
    }*/

public function fitness_trainer_data(Request $request)
    {
         $fitnesstrainer  =  new User();
        if(!empty($request->input()))
        {
            $mobile_number =  $fitnesstrainer->where("phone",$request->mobile_number)->first();
            $checkemail =  $fitnesstrainer->where("email",$request->email)->first();
            
            if(!is_null($mobile_number))
            {
               $result=array('statusmobile_number'=> false,'message'=> 'Mobile Number is allready taken.');
            }
            else if(!is_null($checkemail))
            {
               $result=array('statusemail'=> false,'message'=> 'Email is allready taken.');
            }
            else if(is_null($checkemail) && is_null($mobile_number))
            {
                $fitnesstrainer->name = $request->name;
                $fitnesstrainer->email = $request->email;
                $fitnesstrainer->country_code = $request->country_code;
          
                $fitnesstrainer->phone = $request->mobile_number;
                $fitnesstrainer->gender = $request->gender;
                $fitnesstrainer->specialization =  implode(",",$request->specialization);
                $fileimage="";
                $image_url='';
                
                // if($request->hasfile('upload_doc'))
                // {
                //     $file_image=$request->file('upload_doc');
                //     $fileimage=$file_image->getClientOriginalName();
                //     $fitnesstrainer->upload_doc = $fileimage;
                //     $destination=public_path("upload_doc");
                //     $file_image->move($destination,$fileimage);
                    
                    
                // }   

                 if($request->hasfile('upload_doc')){
                    foreach($request->file('upload_doc') as $file){
                        $fileimage=$file->getClientOriginalName();
                        $file->move(public_path().'/upload_doc/',$fileimage);
                        $imagdata[] = $fileimage;
                    }

                 }
                 // $fitnesstrainer->upload_doc = implode(",",$fileimage); 
                $fitnesstrainer->address = $request->address;
                $fitnesstrainer->updated_at = date("Y-m-d h:i:s");
                $fitnesstrainer->created_at = date("Y-m-d h:i:s");
                 $fitnesstrainer->upload_doc = json_encode($imagdata);
                $fitnesstrainer->status = 1;
                $fitnesstrainer->role = "97";
             
                $fitnesstrainers =  $fitnesstrainer->save();
             
                if($fitnesstrainers){
                    $result=array('status'=>true,'message'=> 'Your Request Send  Successfully.');
                }
                else{
                    $result=array('status'=>false,'message'=> 'Your Request Send Not Successfully.');
                } 
            }
        }
        echo json_encode($result);
    }
    public function set_password_fitness_trainerold(Request $request)
    {
         $fitnesstrainer  =  new User();

        if(!empty($request->input()))
        {
           
            if(!empty($request->status))
            {
                $id = $request->id;
                
                if($request->status=='2')
                {
                    $data['password']  = $request->password;
                    $data['status'] =2;
                }
                else
                {
                    $data['status'] =$request->status;
                }
                $data['updated_at'] = date("Y-m-d h:i:s");
                $update = $fitnesstrainer->where('id',$id) ->update($data);
                if($update){
                    if($request->status=='1')
                    {
                        $result=array('status'=>true,'message'=> 'Your Request Is Pending Id :  '.$id);
                    }
                    else if($request->status=='3')
                    {
                        $result=array('status'=>true,'message'=> 'Your Request is Rejected Id :  '.$id);
                    }
                    else if($request->status=='2')
                    {
                         $subject="Verify Your Account Email";
                        $message=url('/signin')."Your Business account on We Mark the Spot has been Approved. You can now signin to your account.
                                    Click here .";
                         if($this->sendMail($request->email,$subject,$message)){
                        $result=array('status' => true,'message' =>"Verify Your Account Email");
                    }
                        $result=array('status'=>true,'message'=> 'Your Request Approved Successfully');
                    }
                }
                else{
                $result=array('status'=>false,'message'=> 'Set Password Fails.');
                } 
            }
            else
            {
                echo "reject pending";
            }
           
            echo json_encode($result);
        }
    }


public function set_password_fitness_trainer(Request $request)
    {
         $fitnesstrainer  =  new User();
  // dd($request->input());
        if(!empty($request->input()))
        {
            if(!empty($request->status))
            {
                $id = $request->id;
                $userdata = User::where('id',$id)->first();
            //    dd($userdata->email);
                if($request->status=='2')
                {
                    $data['status'] =2;
                    $subject="Your Request";
                    $message="Your registration on We Mark the Spot platform has been Approved by Admin .";
                    $this->sendMail($userdata->email,$subject,$message);
                }
                else
                {
                    if($request->status==3)
                    {
                        $subject="Your Request";
                         $message="Your registration on We Mark the Spot platform has been rejected.<br>"."Reason:".$request->reason;
                        $this->sendMail($userdata->email,$subject,$message);
                    }
                    $data['reason'] =$request->reason;
                    $data['status'] =$request->status;
                  
                }
                $data['updated_at'] = date("Y-m-d h:i:s");
                $update = $fitnesstrainer->where('id',$id) ->update($data);
                if($update){
                    if($request->status==2)
                    {
                        $result=array('status'=>true,'message'=> 'Status changed to Approved.');
                    }
                    else if($request->status==3){
                        $result=array('status'=>true,'message'=> 'Status changed to Rejected.');
                    }
                    else
                    {
                        $result=array('status'=>true,'message'=> 'Status changed to Pending.');
                    }
                     //   $result=array('status'=>true,'message'=> 'Your Request Approved Successfully');
                    }
                }
                else{
                $result=array('status'=>false,'message'=> ' Fails.');
                } 
            }
            else
            {
                echo "reject pending";
            }
           
            echo json_encode($result);
        }
    
    public function fitness_trainer_edit(Request $request,$id)
    {
        $fitnesstrainer  =  User::where("id",$id)->first();
    //    dd($fitnesstrainer);
        $country_code = $fitnesstrainer->country_code;
        $mobile_number = $fitnesstrainer->phone;

        $fitnesstrainer->phone = preg_replace("/^\+?{$country_code}/", '',$mobile_number);
        //dd($fitnesstrainer);
         return view('Pages.fitnesstrainers.fitness_trainer_edit', compact('fitnesstrainer'));
    }

 
    public function deleteAll(Request $request){
        $ids = $request->ids;
       // dd($ids);
        $FitnessTrainers = new User();
    //    dd(explode(",",$ids));
        $ar = explode(",",$ids);
        if(!is_null($ar))
        {
            foreach ($ar as $key => $value) 
            {
               $getdata = $FitnessTrainers->select("upload_doc")->where("id",$value)->first();
                if(!is_null($getdata->upload_doc))
                {
                    if(file_exists(public_path('upload_doc/'.$getdata->upload_doc)))
                    {
                         unlink(public_path('upload_doc/'.$getdata->upload_doc));
                    }
                }
            }
           $FitnessTrainers->whereIn("id",explode(",",$ids))->delete();
             return response()->json(['success'=>"Business data successfully deleted."]);
          }
    }


    public function  delete(Request $request,$id){ 
        
      $Categorys = new Categorys();
         $getdata = $Categorys->select("image")->where("id",$id)->first();
            if(!is_null($getdata->image))
            {
                if(file_exists(public_path('images/'.$getdata->image)))
                {
                     unlink(public_path('images/'.$getdata->image));
                }
            }
        $Categorys->where("id",$id)->delete();
        return redirect('/manager_category');
    }
    public function  manage_business_del(Request $request,$id){ 
        
      $Categorys = new User();
         $getdata = $Categorys->select("image")->where("id",$id)->first();
        // dd($getdata);
            if(!is_null($getdata->image))
            {
                if(file_exists(public_path('images/'.$getdata->image)))
                {
                     unlink(public_path('images/'.$getdata->image));
                }
            }
        $Categorys->where("id",$id)->delete();
        return redirect('/manager_business');
    }

    public function fitness_trainer_view(Request $request,$id)
    {
          $fitnesstrainer  =  user::where("id",$id)->first();
          $hotspots = Hotspots::join("users","users.id","=","hotspots.user_id")
          ->where('hotspots.user_id',$id)->select(
              "users.name",
              "users.image",
              "hotspots.*",
          )
          ->get();


        $category = Categorys::where("id",$fitnesstrainer->business_category)->first();
          $subcategory = SubCategorys::where("id",$fitnesstrainer->business_sub_category)->first();
          
            $fitnesstrainer->category_name = isset($category->name)? $category->name : '';
            $fitnesstrainer->subcategory_name = isset($subcategory->name)? $subcategory->name : '';
         //   dd($fitnesstrainer);

            $reviewratting = BusinessReviews::join('users',"users.id","=","business_reviews.user_id")
            ->where("business_reviews.user_id",$id)
            ->select("business_reviews.*",
            "users.image",
            "users.name",
            "users.business_name as business_name",
            "users.business_images")
            ->orderby('id',"desc")
            ->get();

            foreach($reviewratting as $i=> $review)
            {
                $reviewratting[$i]->overallratings =BusinessReviews::where('business_id',$review->business_id)->avg('ratting');
            }
         //   dd($reviewratting);
        $subscriptions =Payments::where('user_id',$id)->get();

      return view('Pages.fitnesstrainers.fitness_trainer_view', compact('fitnesstrainer','hotspots','reviewratting','subscriptions'));
    }

    public function firness_trainer_update(Request $request)
    {
        $fitnesstrainer  =  new User();
        if(!empty($request->input()))
        {
            $data =array();
            $id = $request->id;
            // $old_password = $request->old_password;
            // $old_upload_doc = $request->old_upload_doc;

            $fitnesstrainer  =  $fitnesstrainer->where('id',$id)->first();
            
            // if(!empty($old_password))
            // {
            //     if($fitnesstrainer->password==$old_password)
            //     {
            //         $fitnesstrainer->passowrd = $request->password;
            //     }
            // }
                // $fileimage="";
                //     $image_url='';
                
                //     if($request->hasfile('upload_doc'))
                //     {
                //         if(!is_null($old_upload_doc))
                //         {
                //             if(file_exists(public_path('upload_doc/'.$old_upload_doc)))
                //             {
                //                 unlink(public_path('upload_doc/'.$old_upload_doc));
                //             }
                //         }
                //         $file_image=$request->file('upload_doc');
                //         $fileimage=$file_image->getClientOriginalName();
                //         //$fitnesstrainer->upload_doc = $fileimage;
                //         $data['upload_doc'] =$fileimage;
                //         $destination=public_path("upload_doc");
                //         $file_image->move($destination,$fileimage);
                //     }   
                    // else
                    // {
                    //     $data['upload_doc'] =($fileimage)? $fileimage:$fitnesstrainer->upload_doc;
                    // }
                $data['name']=($request->name)? $request->name:$fitnesstrainer->name;
                $data['email']=($request->email)? $request->email:$fitnesstrainer->email;
                // $data['password']=($request->password)? $request->password:$fitnesstrainer->password;
                // $data['phone']=($request->mobile_number)? $request->country_code.$request->mobile_number:$fitnesstrainer->phone;
                $data['business_type']=($request->business_type)? $request->business_type:$fitnesstrainer->business_type;
                // $data['dob']=($request->dob)? $request->dob:$fitnesstrainer->dob;
                // $data['specialization']=($request->specialization)? implode(",",$request->specialization):$fitnesstrainer->specialization;
                // $data['address']=($request->adaddressd)? $request->address:$fitnesstrainer->address;
                // $data['education'] =($request->education)? $request->education:$fitnesstrainer->education;
                // $data['bio'] =($request->bio)? $request->bio:$fitnesstrainer->bio;

                $data['updated_at'] = date("Y-m-d h:i:s");
                $update = $fitnesstrainer->where('id',$id) ->update($data);
                if($update){
                    $result=array('status'=>true,'message'=> 'Your Trainer Record Update Successfully');
                }
                else
                {
                    $result=array('status'=>false,'message'=> 'Your Trainer Record Update Not Successfully.');
                }
            echo json_encode($result);
        } 
    }

    public function fitness_trainer_filter(Request $request)
    {
     //   dd($request->status);
        if($request->status==1)
        {
            $status =0;
        }
        else
        {
            $status=$request->status;
        }
        $fitnesstrainer  =  User::where(['status'=>$status,'role'=>"99"])->orderBy('id', 'DESC')->get();
        // $fitnesstrainer  =  User::where(['status'=>$request->status,'role'=>"99"])->get();
      //  dd(count($fitnesstrainer));
        if(!is_null($fitnesstrainer))
        {
            $result=array('status'=>true,'data'=> $fitnesstrainer);
        }
        else
        {
            $result=array('status'=>false,'data'=> 'null');
        }
        echo json_encode($result);
    }

    public function checklogin(Request $request)
    {
        if($request->input())
        {

            $fitnesstrainer  =  User::where('email',$request->email)->first();
            
        if(!is_null($fitnesstrainer))
        {
            $fitnesstrainer  =  User::where('password',$request->password)->first();
            if(is_null($fitnesstrainer))
            {
                $result=array('status'=>false,'statuspsd'=> 'Invalid Password','check'=>"password");
            }
            else
            {
                $where =array('email'=>$request->email,'password'=>$request->password);
                $fitnesstrainer  =  User::where($where)->first();

                $request->session()->put('fitness_tranner_id', $fitnesstrainer->id);
                $request->session()->put('name', $fitnesstrainer->name);
               
                $request->session()->put('email', $fitnesstrainer->email);
                $request->session()->put('phone', $fitnesstrainer->phone);
                $request->session()->put('upload_doc', $fitnesstrainer->upload_doc);
                $request->session()->put('address', $fitnesstrainer->address);

          //  dd($fitnesstrainer);
                return redirect()->to('/fitness-trainer-login-my-profile'); 
            }
            
        }
        else
        {
            $result=array('status'=>false,'statusemail'=> 'Invalid Email address','check'=>"email");
        }
        echo json_encode($result);

        }
    }
    public function fitness_trainer_login_my_profile()
    {
    
        $result=array('status'=>true,'url'=> 'fitness_trainer_login_my_profile_view');
        echo json_encode($result);
       
    }

    public function fitness_trainer_login_my_profile_view()
    {
        $where =array('id'=>session()->get('fitness_tranner_id'));
        $fitnesstrainer  =  User::where($where)->first();
             if(is_null($fitnesstrainer->image))
        {
            $fitnesstrainer->image="1.png";
        }
    
        return view('Pages.fitnesstrainers.fitness_trainer_login_my_profile',compact('fitnesstrainer'));
    }

    public function fitness_trainer_logout()
    {
        $request->session()->forget(['fitness_tranner_id', 'name','email','mobile_number','upload_doc','address']);
        return redirect()->to('/home');
    }

    public function trainer_publishe_profile($id)
    {
        $where =array('id'=>$id);
        $fitnesstrainer  =  User::where($where)->first();
         if(is_null($fitnesstrainer->image))
        {
            $fitnesstrainer->image="1.png";
        }
        dd($fitnesstrainer);
        return view('Pages.fitnesstrainers.trainer_publishe_profile',compact('fitnesstrainer'));
    }
    
    public function trainer_edit_profile($id)
    {
        $where =array('id'=>$id);
        $fitnesstrainer  =  User::where($where)->first();
        if(is_null($fitnesstrainer->image))
        {
            $fitnesstrainer->image="1.png";
        }

        return view('Pages.fitnesstrainers.trainer_edit_profile',compact('fitnesstrainer'));
    }

    public function trainer_forgot_password()
    {
        return view('Pages.fitnesstrainers.trainer_forgot_password');
    }

    public function firness_forget_passwordcheck(Request $request )
    {
        if($request->input())
        {
            $fitnesstrainer  =  User::where('email',$request->email)->first();
            if(is_null($fitnesstrainer))
            {
                  $result=array('status'=>false,'statusemail'=> 'Invalid Email address');
            }
            else
            {
                $token=Str::random(16);
            //    $pass= new Password_reset();
           //     $pass->email=$request->email;
             //   $pass->timestamps=false;
               // $pass->token=$token;
               // $pass->created_at=Carbon::now();
            //    $created_at=Carbon::now();
              //  $pass->save();
                $c = Carbon::now();
                $data = array('email'=>$request->email,'token'=>$token,'created_at'=>$c);
                
             //   dd($data);
                DB::table('password_resets')->insert($data);
               // exit;
                $msg="";
                $subject="Password Reset Email";
                
                $test = "<h1>Reset Your Password</h1>
                    <center>Hii ".$fitnesstrainer->name ."<br />We're sending you this email because you requested a password reset. Click on this link to create a new password <br /><br /><br />";

                $message=url('')."/reset-password/".$token;
                $msg.=$test;
                $msg .= "<br><a  href='".$message."'>Set a new password</a><br /><br /><br />if you didn't request a password reset, you can ignore this email. Your password will not be changed</center>";
               
                if($this->sendMail($request->email,$subject,$msg)){
                //if(1){  
            //    $result=array('status' => true,'message' =>"Enter your email address associated with your account 
			//				we'll send you a link to reset your password.","url"=>"home");
                    $result=array('status' => true,'message' =>"Enter your email address associated with your account 
            //              we'll send you a link to reset your password.","url"=>"home");
              
              
                }else{
                    $result=array('status' => false,'message' =>"Something Went Wrong");
                }
            }
              echo json_encode($result);
            }
    }
    
    public function trainer_reset_password($token)
    {

            return view('Pages.fitnesstrainers.trainer_reset_password',compact('token'));
    }
    
    public function  trainer_updatepassword(Request $request)
    {
      
        $token_status=DB::table('password_resets')->where('token', $request->email_token)->first();
        if(is_null($token_status)){
            $result=array('status'=>false,'message' => "Token Does Not Exist");
            }
            else
            {
                //$data['password']=Hash::make($request->password);
                  $data['password']=$request->password;
                  
                DB::table('users')->where('email',$token_status->email)->update($data);
                DB::table('password_resets')->where('email',$token_status->email)->delete();
		$result=array('status'=>true,'message' =>'Password Reset Success','url'=>'signin');
            }
    echo json_encode($result);
            
            }

    public function sendMail($email,$stubject=NULL,$message=NULL){

            require base_path("vendor/autoload.php");
            $mail = new PHPMailer(true);     // Passing `true` enables exceptions
            try {
                $mail->SMTPDebug = 0;   
                $mail->isSMTP();
                $mail->Host="smtp.gmail.com";
                $mail->Port=587;
                $mail->SMTPSecure="tls";
                $mail->SMTPAuth=true;
                $mail->Username= "wemarkspot@gmail.com"; //"raviappic@gmail.com";
            $mail->Password="dwspcijqkcgagrzl";//"audnjvohywazsdqo";
                $mail->addAddress($email,"User Name");
                $mail->Subject=$stubject;
                $mail->isHTML();
                $mail->Body=$message;
                $mail->setFrom("wemarkspot@gmail.com");
                $mail->FromName="Wemark The Spot";
                
                if($mail->send())
                {   
                    return 1;                 
                }
                else
                { 
                    return 0;
                }
    
            } catch (Exception $e) {
                 return 0;
            }
        }
        
    public function website_trainer_edit(Request $request)
    {

        $fitnesstrainer  =  new User();
        if(!empty($request->input()))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'gender'=>'required',
                'mobile_number'=>'required|min:10',
                'confirm_password' => 'same:new_password',
                'specialization'=>'required',
                'address'=>'required',
                'bio'=>'required'
            ],[
                'name.required' => 'Name is required',
                'new_password.required' => 'Password is required',
                'mobile_number'=>'Please Enter Mobile Number',
                'specialization'=>'Please Enter Specialization',
                'address'=>"please Enter Address",
                'bio'=>"please Enter Bio"
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
                $old_password = $request->old_password;
                if(!empty($request->input()))
                {
                    $id = $request->id;
                    $fitnesstrainer  =  $fitnesstrainer->where('id',$id)->first();
                    if(!empty($old_password))
                    {
                        if($fitnesstrainer->password==$old_password)
                        {
                            if(!empty($old_password))
                            {
                                if($fitnesstrainer->password==$old_password)
                                {
                                    $fitnesstrainer->passowrd = $request->new_password;
                                    $data =array();
                                    $id = $request->id;
                                    $old_password = $request->old_password;
                                    $old_upload_doc = $request->old_upload_doc;
            
                                    $fitnesstrainer  =  $fitnesstrainer->where('id',$id)->first();
                                    
                                  
                                        
                                        $data['upload_doc'] =$fitnesstrainer->upload_doc;
                                    $data['name']=($request->name)? $request->name:$fitnesstrainer->name;
                                    $data['email']=($request->email)? $request->email:$fitnesstrainer->email;
                                    $data['password']=($request->password)? $request->password:$fitnesstrainer->password;
                                   
                                    $data['country_code']=($request->country_code)? $request->country_coder:$fitnesstrainer->country_code;
                                   
                                    $data['phone']=($request->mobile_number)? $request->country_code.$request->mobile_number:$fitnesstrainer->phone;
                                    $data['gender']=($request->gender)? $request->gender:$fitnesstrainer->gender;
                                    $data['dob']=($request->dob)? $request->dob:$fitnesstrainer->dob;
                                    $data['specialization']=($request->specialization)? implode(",",$request->specialization):$fitnesstrainer->specialization;
                                    $data['address']=($request->adaddressd)? $request->address:$fitnesstrainer->address;
                                    $data['education'] =($request->education)? $request->education:$fitnesstrainer->education;
                                    $data['bio'] =($request->bio)? $request->bio:$fitnesstrainer->bio;
            
                                    $data['updated_at'] = date("Y-m-d h:i:s");
                                }
                            }
                        }
                    }
                    else
                    {
                        $data =array();
                        $id = $request->id;
                        $old_password = $request->old_password;
                        $old_upload_doc = $request->old_upload_doc;

                        $fitnesstrainer  =  $fitnesstrainer->where('id',$id)->first();
                        
                      
                            
                            $data['upload_doc'] =$fitnesstrainer->upload_doc;
                        $data['name']=($request->name)? $request->name:$fitnesstrainer->name;
                        $data['email']=($request->email)? $request->email:$fitnesstrainer->email;
                        $data['password']=($request->password)? $request->password:$fitnesstrainer->password;
                         $data['country_code']=($request->country_code)? $request->country_coder:$fitnesstrainer->country_code;
                                   
                        $data['phone']=($request->mobile_number)?$request->mobile_number:$fitnesstrainer->phone;
                        $data['gender']=($request->gender)? $request->gender:$fitnesstrainer->gender;
                        $data['dob']=($request->dob)? $request->dob:$fitnesstrainer->dob;
                        $data['specialization']=($request->specialization)? implode(",",$request->specialization):$fitnesstrainer->specialization;
                        $data['address']=($request->adaddressd)? $request->address:$fitnesstrainer->address;
                        $data['education'] =($request->education)? $request->education:$fitnesstrainer->education;
                        $data['bio'] =($request->bio)? $request->bio:$fitnesstrainer->bio;

                        $data['updated_at'] = date("Y-m-d h:i:s");
                    }
                  
                        
                        $update = $fitnesstrainer->where('id',$id) ->update($data);
                        if($update){
                            return redirect()->to("/fitness_trainer_login_my_profile_view")
                            
                            ->with('message','Your Trainer Record Update Successfully');
                        }
                }

            }
       
        } 
    }

    public function website_trainer_change_password(Request $request)
    {
        $fitnesstrainer  =  new User();
        if(!empty($request->input()))
        {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'confirm_password'=>'required|same:new_password|min:6',
                'id'=>'required',
            ],[
                'old_password.required' => 'Current Password is required',
                'new_password.required' => 'New Password is required',
                'old_password.min' => 'Current Password is Minimum of 6 digits',
                'new_password.min' => 'New Password is Minimum of 6 digits',
                'confirm_password.required'=>'Confirm Password is same as New Password',
                'confirm_password.min'=>'Confirm Password is Minimum of 6 digits',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
              
                    $id =$request->id;
                    $fitnesstrainer  =  $fitnesstrainer->where('id',$id)->where('password',$request->old_password)->first();
                    if($fitnesstrainer){
                        $data =array();
                    $data['password']=($request->new_password)? $request->new_password:$fitnesstrainer->new_password;
                    $data['updated_at'] = date("Y-m-d h:i:s");
                    $update = $fitnesstrainer->where('id',$id) ->update($data);
                    if($update){
                            return redirect()->back()
                            
                            ->with('message','Your Password Record Update Successfully');
                        }
                    }else{
                        return redirect()->back()
                            
                            ->with('message','Your Old Password Is not Match');
                    }
                    
                

            }
       
        } 
    }


     function sendVerifyEmail(Request $request){
                 $validate=Validator::make($request->all(),[
                        'email' => 'required|email',
                      ]);
                         if($validate->fails()){
                        $result=array('status' =>'Failed',"success" => false,'message' =>'Validation failed','error' =>$validate->errors());
                 }else{
                        $email_status=User::where('email',$request->email)->first();
                        if(is_null($email_status)){
                        $result=array('status' => false,'status' => false,'message' =>"Email does not exist");
                    }
                 else{
                    
                    $subject="Verify Your Account Email";
                    $message=url('signin')."Your Business account on We Mark the Spot has been Approved. You can now signin to your account.
                                    Click here .";
                    if($this->sendMail($request->email,$subject,$message)){
                        $result=array('status' => true,'message' =>"Password reset link send to your email address");
                    }else{
                        $result=array('status' => false,'message' =>"Something Went Wrong");
                    }
                   
            }
    }
    
    echo json_encode($result);
}

    public function category_status(Request $request)
    {
   

        $id = $request->id;
        $status = $request->status;
        $data = ['status'=>$status];

        $update =  Categorys::where('id',$id)->update($data);
        if($update){

            $result = array("status"=> true, "message"=>"status  updated successfully");
        }
        else{
            $result = array("status"=> false, "message"=>"not updated status");
        }
         echo json_encode($result);
    }

    public function edit($id)
    {
        $categorys =  Categorys::where('id',$id)->first();
        if(!empty($categorys))
        {
        //    dd($categorys);
            return view('Pages.edit_category',compact('categorys'));
        }
        
    }
    public function categoryupdate(Request $request)
    {
        if(!empty($request->id))
        {
               $categorysData = Categorys::where('id', $request->id)->first();
                $fileimage="";
                $image_url='';
                if($request->hasfile('image'))
                {
                    $file_image=$request->file('image');
                    $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                    $destination=public_path("images");
                    $file_image->move($destination,$fileimage);
                    $image_url=url('public/images').'/'.$fileimage;
                }
                else
                {
                    $image_url= $categorysData->image;
                }
                // echo $image_url;
                // exit;
                $updateData = array(
                'name'=>isset($request->name)? $request->name : $categorysData->name,
                'short_information'=>isset($request->short_information)? $request->short_information : $categorysData->short_information,
                'detail_information'=>isset($request->detail_information)? $request->detail_information : $categorysData->detail_information,
                    'image'=>$image_url,
                    'updated_at'=>date("Y-m-d h:i:s", time())
                );
                $updateRecord = Categorys::where('id',$categorysData->id)->update($updateData);
                if($updateRecord){
                    $result = array('status'=> true, 'message'=>'Category Update  successfully.');
                }
                else{
                $result = array('status'=> false, 'message'=>'Category Update  Failed.');
                }
        }
        else
        {
             $result = array('status'=> false, 'message'=>'No Record Found');
        }
         echo json_encode($result);
    }
    public function categoryview($id)
    {
        $categorys = Categorys::where('id', $id)->first();
        return view('Pages.category_view',compact('categorys'));
    }

    public function getdatasubcategory()
    {
        $subcategorys = SubCategorys::join('categorys', 'categorys.id', '=', 'sub_categorys.category_id')
              ->get(['sub_categorys.*', 'categorys.name as category_name']);
        //      dd($subcategorys);
        return view('Pages.fitnesstrainers.manage_subcategory',compact('subcategorys'));   
    }
    public function add_sub_category()
    {
        $categorylist = Categorys::where('status', 0)->get();
    //    dd($categorylist);
        return view("Pages.add_sub_category",compact('categorylist'));
    }

    public function subcategorydata(Request $request)
    {
        if($request->input())
        {

            $name = $request->name;
            $res =SubCategorys::where('name',$name)->where('category_id',$request->category_id)->first();
        
            $image_url=url('public/images/userimage.png');
            
            if(!empty($res))
            {
                  $result=array('status'=>false,'message'=> 'sub categorys name Already exists.' );
            }
            else
            {
                $fileimage="";
                $image_url='';
                if($request->hasfile('image'))
               {
                 $file_image=$request->file('image');
                 $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                 $destination=public_path("images");
                 $file_image->move($destination,$fileimage);
                 $image_url=url('public/images').'/'.$fileimage;
              
               }
               else
               {
                 $image_url= $usreData->image;
               }
                $date = date("Y-m-d h:i:s", time());
                $detail_Information = $request->detail_information;
               
                $data = ['category_id'=>$request->category_id,'name'=>$request->name,'short_information'=>$request->short_information,'detail_information'=>$detail_Information,'image'=>$image_url,'updated_at'=>date("Y-m-d h:i:s", time()),'created_at'=>date("Y-m-d h:i:s", time())];
             //  dd($data);
                $insertRecord=    SubCategorys::create($data);
                if($insertRecord){
                    $result = array('status'=> true, 'message'=>'Sub Category Added  successfully.');
                   }
                   else{
                    $result = array('status'=> false, 'message'=>'Sub Category Added  Failed.');
                   }
            }
            echo json_encode($result);
        }
    }
    public function subcategoryview($id)
    {
//        $subcategorys = SubCategorys::where('id', $id)->first();

        // $subcategorys = SubCategorys::join('categorys', 'categorys.id', '=', 'sub_categorys.category_id')
        //       ->get(['sub_categorys.*', 'categorys.name as category_name'])->where('id',$id);
    
        $subcategorys = SubCategorys::where('id',$id)->first();
         $categorys = Categorys::where('id',$subcategorys->category_id)->first();
        $subcategorys->category_name = $categorys->name;
       // dd($subcategorys);
    
        return view('Pages.subcategory_view',compact('subcategorys'));
    }

    public function subcategory_delete($id)
    {
        $Categorys = new SubCategorys();
        $getdata = SubCategorys::where("id",$id)->first();
    //    dd($getdata->image);
           if(!is_null($getdata->image))
           {
               if(file_exists(public_path('images/'.$getdata->image)))
               {
                    unlink(public_path('images/'.$getdata->image));
               }
           }
       $Categorys->where("id",$id)->delete();
       return redirect('/manage_sub_category');
    }

    public function subcategory_edit($id)
    {
        //dd(date("Y-m-d h:i:s"));
        $subcategorys = SubCategorys::where('id',$id)->first();
        $categorylist = Categorys::where('status', 0)->get();
    //    dd($subcategorys->category_id);
        // foreach($categorylist as $list)
        // {
        //     if($list->id == $subcategorys->category_id)
        //     {
        //         print_r($list->name);
        //     }
        //     else{
        //         print_r($list->name);
        //     }
        // }
        // exit;
        return view('Pages.edit_subcategory',compact('subcategorys','categorylist'));
    }
    public function subcategoryupdate(Request $request)
    {
        if(!empty($request->id))
        {
               $subcategorysData = SubCategorys::where('id', $request->id)->first();
                $fileimage="";
                $image_url='';
                if($request->hasfile('image'))
                {
                    $file_image=$request->file('image');
                    $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                    $destination=public_path("images");
                    $file_image->move($destination,$fileimage);
                    $image_url=url('public/images').'/'.$fileimage;
                }
                else
                {
                    $image_url= $subcategorysData->image;
                }
                date_default_timezone_set("Asia/Kolkata"); 
                $updateData = array(
                
                    'category_id'=>isset($request->category_id)? $request->category_id : $subcategorysData->category_id,
                    'name'=>isset($request->name)? $request->name : $subcategorysData->name,
                    'short_information'=>isset($request->short_information)? $request->short_information : $subcategorysData->short_information,
                    'detail_information'=>isset($request->detail_information)? $request->detail_information : $subcategorysData->detail_information,
                    'image'=>$image_url,
                    'updated_at'=>date("Y-m-d h:i:s", time())
                    );
                //    dd($updateData);
                $updateRecord = SubCategorys::where('id',$request->id)->update($updateData);
                if($updateRecord){
                    $result = array('status'=> true, 'message'=>'SubCategory Update  successfully.');
                }
                else{
                $result = array('status'=> false, 'message'=>'SubCategory Update  Failed.');
                }
        }
        else
        {
             $result = array('status'=> false, 'message'=>'No Record Found');
        }
         echo json_encode($result);
    }
    public function subcategory_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $data = ['status'=>$status];
        $update =  SubCategorys::where('id',$id)->update($data);
        if($update){
            $result = array("status"=> true, "message"=>"status  updated successfully");
        }
        else{
            $result = array("status"=> false, "message"=>"not status  updated successfully");
        }
        echo json_encode($result);
    }
    
    public function sub_category_by_category_id(Request $request)
    {
        $where =array('status'=>0,'category_id'=>$request->category_id);

        $category =  SubCategorys::where($where)->get();
    //    dd($category);
        if($category){
            $result = array("status"=> true, "message"=>"update status",'data'=>$category);
        }
        else{
            $result = array("status"=> false, "message"=>"not update status");
        }
        echo json_encode($result);
    }

    // public function checkemail(Request $request)
    // {
    //     dd($request->input());
    // }

      public function quoates_managements()
    {
        $quoates  =  Quoates::orderBy('id', 'DESC')->get();
        if(!empty($quoates))
        {
            foreach($quoates as $q)
            {
                $target_file=$q->image;
                  // Select file type
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                 // Valid file extensions
                $extensions_arr = array("jpg","jpeg","png","gif");
                if( in_array($imageFileType,$extensions_arr) ){
                    $q->imagevideocheck=1;//image
                }
                else
                {
                    $q->imagevideocheck=0;//video
                }
               
            }   
        }
    
        return view('Pages.fitnesstrainers.quoates_managements',compact('quoates')); 
    }

     public function quoteview($id)
    {
        $quoates  =  Quoates::where('id', $id)->first();
          $target_file=$quoates->image;
                  // Select file type
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                 // Valid file extensions
                $extensions_arr = array("jpg","jpeg","png","gif");
                if( in_array($imageFileType,$extensions_arr) ){
                    $quoates->imagevideocheck=1;//image
                }
                else
                {
                    $quoates->imagevideocheck=0;//video
                }

        return view('Pages.quote_view',compact('quoates')); 
    }
    public function quote_edit($id)
    {
        $quoates  =  Quoates::where('id', $id)->first();
        // dd($quoates);
        // exit;
          $target_file=$quoates->image;
                  // Select file type
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                 // Valid file extensions
                $extensions_arr = array("jpg","jpeg","png","gif");
                if( in_array($imageFileType,$extensions_arr) ){
                    $quoates->imagevideocheck=1;//image
                }
                else
                {
                    $quoates->imagevideocheck=0;//video
                }

        return view('Pages.edit_quote',compact('quoates')); 
    }
    public function quotes_edit(Request $request)
    {
       if(!empty($request->id))
        {
               $categorysData = Quoates::where('id', $request->id)->first();
                $fileimage="";
                $image_url='';
                if($request->hasfile('image'))
                {
                    $old_image = $request->old_image;
                    $file_image=$request->file('image');
                    $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                    $destination=public_path("images");
                    $file_image->move($destination,$fileimage);
                    $image_url=url('public/images').'/'.$fileimage;

                    if(!is_null($old_image))
                    {
                        if(file_exists(public_path('images/'.$old_image)))
                        {
                             unlink(public_path('images/'.$old_image));
                        }
                    }
                    
                }
                else
                {
                    $image_url= $categorysData->image;
                }
         
                $updateData = array(
                'name'=>isset($request->name)? $request->name : $categorysData->name,
                'short_information'=>isset($request->short_information)? $request->short_information : $categorysData->short_information,
                'detail_information'=>isset($request->detail_information)? $request->detail_information : $categorysData->detail_information,
                    'image'=>$image_url,
                    'updated_at'=>date("Y-m-d h:i:s", time())
                );
                $updateRecord = Quoates::where('id',$categorysData->id)->update($updateData);
                if($updateRecord){
                    $result = array('status'=> true, 'message'=>'Quoates Update  successfully.');
                }
                else{
                $result = array('status'=> false, 'message'=>'Quoates Update  Failed.');
                }
        }
        else
        {
             $result = array('status'=> false, 'message'=>'No Record Found');
        }
         echo json_encode($result); 
    }
    public function quotesdata(Request $request)
    {
      //  dd($request->input());
          if($request->input())
            {
            $image_url=url('public/images/userimage.png');
            $Validation = Validator::make($request->all(),[
                   'name' => 'unique:quoates_managements',
            ]);
            if($Validation->fails())
            {
                  $result=array('status'=>false,'message'=> 'Quoates name Already exists.' ,'error'=>$Validation->errors());
            }
            else
            {
                $fileimage="";
                $image_url='';
                if($request->hasfile('image'))
               {
                 $file_image=$request->file('image');
                 $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                 $destination=public_path("images");
                 $file_image->move($destination,$fileimage);
                 $image_url=url('public/images').'/'.$fileimage;
               }
               else
               {
                 $image_url= $usreData->image;
               }
                $date = date("Y-m-d h:i:s", time());
                $detail_Information = $request->detail_information;

                $data = ['name'=>$request->name,'short_information'=>$request->short_information,'detail_information'=>$detail_Information,'image'=>$image_url,'updated_at'=>date("Y-m-d h:i:s", time()),'created_at'=>date("Y-m-d h:i:s", time())];
            
                    $insertRecord=    Quoates::create($data);
                    if($insertRecord){
                        $result = array('status'=> true, 'message'=>'Quoates Added  successfully.');
                   }
                   else{
                        $result = array('status'=> false, 'message'=>'Quoates added  Failed.');
                   }
            }
            echo json_encode($result);
        }
    }

    public function business_report()
    {
        $buinessReports = BuinessReports::join('users', 'users.id', '=', 'business_reports.user_id')
            ->join('business_reviews','business_reviews.id',"=","business_reports.review_id")
            ->join('users as business_user','business_user.id',"=","business_reports.business_id")
            ->get(
                    [   'business_reports.*',
                        'users.name as user_name',
                        'users.image as user_image',
                        'business_reviews.review as comment',
                        'business_reviews.created_at as post_date', 
                        'business_reviews.image as business_reviews_image',
                        'business_reviews.ratting as business_reviews_ratting',
                        'business_user.name as business_username',
                        'business_user.id as business_user_id',
                        'business_reports.created_at as business_reports_created_date'
                    ]
                    );
        return view('Pages.fitnesstrainers.manage_business_report',compact('buinessReports'));
    }


    public function report_status(Request $request)
    {
        if($request->all())
        {
           // dd($request->all());
            $business_report_id  =$request->business_report_id;
            $business_id  =$request->business_id;
            $user_id  =$request->user_id;
            $review_id = $request->review_id;
            $report_status_value = $request->report_status_value;
           
            if($report_status_value==1)//send mail
            {
                $userData = User::where('id',$user_id)->first();
              //  dd($userData->email);
                $subject ="Report Review";
                $message = "Not Good Comment";
                
                if($this->sendMail($userData->email,$subject,$message)){
                    BuinessReports::where('id',$business_report_id)->update(array('report_status'=>1));
                        $result=array('status' => true,'message' =>"Mail Send");
                    }
            }
            else if($report_status_value==2)// remove comment
            {
                  BuinessReports::where('id',$business_report_id)->update(array('report_status'=>2));
                  BusinessReviews::where('id',$review_id)->update(array('status'=>2));
                  $result=array('status' => true,'message' =>"Mail Send and Remove Comment");
                
            }
            echo json_encode($result);
        }
    }

    public function ReviewandRattingManagement(Request $request)
    {
         $buinessReports = User::join('business_reviews', 'business_reviews.user_id', '=', 'users.id')
          ->join('users as business_user','business_user.id',"=","business_reviews.business_id")
               ->orderBy('users.id', 'desc')
                ->get(
                        [
                        'users.id as user_id',
                        'users.name as user_name',
                        'users.image as user_image', 
                        'business_reviews.ratting',
                        'business_reviews.status',
                        'business_reviews.business_id as business_id',
                        'business_reviews.id as business_reviews_id',
                        'business_reviews.review', 
                        'business_reviews.image as business_review_image',
                        'business_user.name as business_owner_name',
                        'business_user.business_name as business_name',
                        'business_user.image as business_owner_image',
                        'business_user.business_images as business_image',
                        'business_reviews.created_at as post_date'
                    ]
                );
             //   dd($usreData);

                foreach($buinessReports  as $b)
                {
                    $business_avg=   BusinessReviews::where('business_id',$b->business_id)->avg('ratting');
                   
                    $target_file=$b->business_review_image;
                    // Select file type
                  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                   // Valid file extensions
                  $extensions_arr = array("jpg","jpeg","png","gif");
                  if( in_array($imageFileType,$extensions_arr) ){
                      $b->imagevideocheck=1;//image
                  }
                  else
                  {
                      $b->imagevideocheck=0;//video
                  }

                    $b->overall_rating_of_business =number_format($business_avg,2);
                }    
          //   dd($buinessReports);
                 return view('Pages.fitnesstrainers.management_review_ratting',compact('buinessReports'));
                

    }

    public function business_review__remove(Request $request)
    {
        if($request->all())
        {
            $business_id  =$request->business_id;
            $user_id  =$request->user_id;
            $review_id = $request->review_id;

             $response = BusinessReviews::where(['id'=>$review_id,'user_id'=>$user_id,'business_id'=>$business_id])->update(array('status'=>2));
              if($response)
              {
                $result=array('status' => true,'message' =>"Ratting And Review Remove Successfully");
              }
              else
              {
                $result=array('status' => true,'message' =>"Ratting And Review Remove Failed");
              }
              echo json_encode($result); 
        }

    }
    
    public function getcontact()
    {
        $contactus = Contactus::orderBy('id')->get();
        return view('Pages.fitnesstrainers.manager_contactus',compact('contactus'));   
    }
    
    public function contact_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $data = ['status'=>$status];
        $update =  Contactus::where('id',$id)->update($data);
        if($update){
            $result = array("status"=> true, "message"=>"Status  change successfully");
        }
        else{
            $result = array("status"=> false, "message"=>"not updated status");
        }
         echo json_encode($result);
    }

    public function likedislikeweb(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'business_id' => 'required',
            'businessreview_id' => 'required',
            'likedislike' => 'required',
        ]);


        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
     $user_id = $request->session()->get('id');

            $checkResult = Businessreviewlikedislike::where(array('user_id' => $user_id, 'business_id' => $request->business_id, 'businessreview_id' => $request->businessreview_id))->count();
            if ($checkResult > 0) {
                $data =  Businessreviewlikedislike::where(array('user_id' => $user_id, 'business_id' => $request->business_id, 'businessreview_id' => $request->businessreview_id))->update(array('likedislike' => $request->likedislike));
            } else {
                $data = Businessreviewlikedislike::create(array('user_id' => $user_id, 'business_id' => $request->business_id, 'businessreview_id' => $request->businessreview_id, 'likedislike' => $request->likedislike));
            }
            if ($data) {
                $result  = array("status" => true, "message" => 'Like dislike Added Successfully');
            } else {
                $result  = array("status" => False, "message" => 'Like dislike  Added Failed');
            }
        }
        echo json_encode($result);
    }

    public function getfaq()
    {
      $faq  =  Faqs::orderBy('id', 'DESC')->get();
    
      return view('Pages.fitnesstrainers.faq', compact('faq'));
    }

    public function add_Faq() { // create add_Faq
        return view('Pages.add_Faq');
     }

     public function Faq_data(Request $request)
     {
        if($request->input())
        {
          
            $Validation = Validator::make($request->all(),[
                   'question' => 'required',
                   'answers'=>'required',
            ]);
            if($Validation->fails())
            {
                  $result=array('status'=>false,'message'=> 'Please enter question or answers.' ,'error'=>$Validation->errors());
            }
            else
            {
                $date = date("Y-m-d h:i:s", time());
                $data = ['answers'=>$request->answers,'question'=>$request->question,'updated_at'=>date("Y-m-d h:i:s", time()),'created_at'=>date("Y-m-d h:i:s", time())];
                $insertRecord=    Faqs::create($data);
                if($insertRecord){
                    $result = array('status'=> true, 'message'=>'Faq Added  successfully.');
                   }
                   else
                   {
                    $result = array('status'=> false, 'message'=>'Faq Added  Failed.');
                   }
            }
            echo json_encode($result);
        }
     }

     public function faq_edit($id)
     {
        $faq =  Faqs::where('id',$id)->first();
        if(!empty($faq))
        {
        //   dd($faq);
            return view('Pages.edit_faq',compact('faq'));
        }
     }

     public function Faq_update(Request $request)
     {
        $id = $request->id;
        $result = Faqs::where('id',$id)->first();
        
        $updateArray = array('question'=>isset($request->question) ?$request->question: $result->question,
                            'answers'=>isset($request->answers) ?$request->answers: $result->answers
                        );
  
     
        $update =  Faqs::where('id',$id)->update($updateArray);
        if($update){

            $result = array("status"=> true, "message"=>"Faq  updated successfully");
        }
        else{
            $result = array("status"=> false, "message"=>"not updated Faq");
        }
         echo json_encode($result);
     }

     public function Faq_status(Request $request)
     {
        $id = $request->id;
        $status = $request->status;
        $data = ['status'=>$status];
 
        $update =  Faqs::where('id',$id)->update($data);
        if($update){

            $result = array("status"=> true, "message"=>"status  updated successfully");
        }
        else{
            $result = array("status"=> false, "message"=>"not updated status");
        }
         echo json_encode($result);
     }
     public function Faq_delete($id)
     {
        Faqs::where("id",$id)->delete();
        return redirect('/faq');
     }

     public function manage_aboutus()
     {
         $aboutus = Aboutus::first();
    
         return view('Pages.Aboutus',compact('aboutus'));
        
       
     }

     public function aboutdata(Request $request)
     {
        if($request->input())
        {
          
            $Validation = Validator::make($request->all(),[
                   'description' => 'required',
            ]);
            if($Validation->fails())
            {
                  $result=array('status'=>false,'message'=> 'Please enter description' ,'error'=>$Validation->errors());
            }
            else
            {
               // dd($request);
                $id = $request->id;
                if(isset($id))
                {
                    $date = date("Y-m-d h:i:s", time());
                    $data = ['description'=>$request->description,'updated_at'=>date("Y-m-d h:i:s", time()),'created_at'=>date("Y-m-d h:i:s", time())];
                    $insertRecord= Aboutus::where('id',$id)->update($data);
                    if($insertRecord){
                        $result = array('status'=> true, 'message'=>'About  details updated  successfully.');
                       }
                       else
                       {
                        $result = array('status'=> false, 'message'=>'Faq Added  Failed.');
                       }
                }
                else
                {
                    $date = date("Y-m-d h:i:s", time());
                    $data = ['description'=>$request->description,'updated_at'=>date("Y-m-d h:i:s", time()),'created_at'=>date("Y-m-d h:i:s", time())];
                    $insertRecord=    Aboutus::create($data);
                    if($insertRecord){
                        $result = array('status'=> true, 'message'=>'About  details added  successfully.');
                       }
                       else
                       {
                        $result = array('status'=> false, 'message'=>'Faq Added  Failed.');
                       }
                }
               
            }
            echo json_encode($result);
        }
     }

     public function getdataSubscriptions()
     {
         $subscriptions  =  Subscriptions::orderBy('id', 'DESC')->get();  //table
         return view('Pages.admin_subscriptions',compact('subscriptions'));   
     }
     
      public function editSubscriptions($id)
     {
         $subscriptions =  Subscriptions::where('id',$id)->first();
         if(!empty($subscriptions))
         {
             //dd($subscriptions);
             return view('Pages.edit_subscriptions',compact('subscriptions'));
         }   
     }
     
    public function subscriptionsUpdate(Request $request)
     {
         if(!empty($request->id) && $request->id == 1)
         {
             $updateData = array(
                 'weekBusiness'=>$request->BusinessoftheWeek,
                 'featuredBusiness'=>$request->FeaturedBusiness,
                 'weekAndFeatured'=>$request->WeekAndFeaturedBusiness,
                 'updated_at'=>date("Y-m-d h:i:s", time())
             );
 
             $updateRecord = Subscriptions::where('id',$request->id)->update($updateData);
 
             if($updateRecord){
                 $result = array('status'=> true, 'message'=>'Subscription Update successfully.');
             }else{
                 $result = array('status'=> false, 'message'=>'Subscription Update Failed.');
             }
         }
         else
         {
             $result = array('status'=> false, 'message'=>'Something Went Wrong!');
         }
         echo json_encode($result);
     }
}
