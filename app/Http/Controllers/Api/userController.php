<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;
use Validator;
use App\Models\User;
use App\Models\Fitness_survey;
use App\Models\Verification;

use App\Models\BusinessReviews;
use App\Models\Faqs;
use App\Models\Categorys;
use App\Models\BusinessVisits;
use App\Models\Aboutus;



use App\Models\Contactus;



use App\Models\Businessreviewlikedislike;
use Hash;
use DateTime;
use Session;

use App\Models\Quoates;
use App\Models\Giweaway;

use App\Models\Hotspots;
use App\Models\BusinessFav;

use App\Models\Replies;
use App\Models\BuinessReports;
use App\Models\SubCategorys;



class userController extends Controller
{

    public function logincheck(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;

        if (!isset($email)) {
            $result = array('status' => false, 'message' => 'Email is required.');
        } else if (!isset($request->password)) {
            $result = array('status' => false, 'message' => 'Password is required.');
        } else {
           
            $password = md5($request->password);
            $emailExist = DB::table('users')->where('email', $email)->first();
            if (!empty($emailExist)) {
                if ($emailExist->email = $email) {
                    if ($emailExist->status == 1) {
                        if (Hash::check($request->password, $emailExist->password)) {
                         
                            $data['login_check'] = 1;
                           
                            DB::table('users')->where('email', $email)->update($data);
                            $image_url = url('public/images/userimage.png');
                            $emailExist->image =  isset($emailExist->image) ? $emailExist->image : $image_url;
                            $result = array('status' => true, 'message' => 'Logged in Successfully.', 'data' => $emailExist,'old_password'=>$request->password);
                        } else {
                            $result = array('status' => false, 'message' => 'Invalid Password');
                        }
                    } else {
                        $result = array('status' => false, 'message' => 'Your account has been deactivated by admin');
                    }
                } else {
                    $result = array('status' => false, 'message' => 'Invalid Email address');
                }
            } else {
                $result = array('status' => false, 'message' => 'User not registered');
            }
        }
        echo json_encode($result);
    }

    //user register 
    public function userRegister(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $username = $request->username;
        $email = $request->email;


        $emailExist = DB::table('users')->where('email', $email)->count();
        $userExist = DB::table('users')->where('username', $username)->count();
        if ($emailExist > 0) {
            $result = array('status' => false, 'message' => 'Email address already registered');
        } else {
            $username = $request->username;
            $email = $request->email;

            $image_url = url('public/images/userimage.png');
            $password = Hash::make($request->password);
            $otp =  rand(1000, 9999);
            $date = date("Y-m-d h:i:s", time());
            $data = ['username' => $username, 'name' => $username, 'image' => $image_url, 'email' => $email, 'password' => $password, 'status' => 1, 'role' => 97];
            $updated = DB::table('temp_users')->where('email', $request->email)->first();
            $up_otp = ['otp' => $otp, 'email' => $email, 'create_at' => $date, 'update_at' => $date];
            if (!empty($updated)) {
                DB::table('temp_users')->where('email', $request->email)->delete();

                DB::table('password_otp')->where('email', $request->email)->delete();
                $subject = "Register Otp";
                $message = "Register Otp OTP " . $otp;

                $update = DB::table('temp_users')->where('id', $request->id)->insert($data);
                $upt_success = DB::table('password_otp')->insert($up_otp);
            } else {
                $subject = "Register Otp";
                $message = "Register Otp OTP " . $otp;

                $update = DB::table('temp_users')->where('id', $request->id)->insert($data);
                $up_otp = ['otp' => $otp, 'email' => $email, 'create_at' => $date, 'update_at' => $date];
                $upt_success = DB::table('password_otp')->insert($up_otp);
            }



            // dd($data);

            // $addUsers =User::create($data);

            // dd($upt_success);
            if ($this->sendMail($request->email, $subject, $message)) {
                //  $this->sendMail($request->email,$subject,$message);
                $emailExist = DB::table('temp_users')->where('email', $email)->first();
                $result = array('status' => true, 'message' => 'OTP sent successfully.', 'data' => $emailExist);
            } else {
                $result = array('status' => false, 'message' => 'Something went wrong. Please try again.');
            }
        }
        echo json_encode($result);
    }

    public function userRegisterold(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $Validation = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',

        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $username = $request->username;
            $email = $request->email;
            $image_url = url('public/images/userimage.png');
            $password = Hash::make($request->password);
            $otp =  rand(1000, 9999);
            $date = date("Y-m-d h:i:s", time());
            $data = ['username' => $username, 'name' => $username, 'image' => $image_url, 'email' => $email, 'password' => $password, 'status' => 1, 'role' => 97];
            $subject = "Register Otp";
            $message = "Register Otp OTP " . $otp;


            $addUsers = User::create($data);
            $up_otp = ['otp' => $otp, 'email' => $email, 'create_at' => $date, 'update_at' => $date];
            $upt_success = DB::table('password_otp')->insert($up_otp);
            if ($addUsers) {
                $this->sendMail($request->email, $subject, $message);
                $emailExist = DB::table('users')->where('email', $email)->first();
                $result = array('status' => true, 'message' => 'User added successfully.', 'data' => $emailExist);
            } else {
                $result = array('status' => false, 'message' => 'Something went wrong. Please try again.');
            }
        }



        echo json_encode($result);
    }
    public function guestuser(Request $request)
    {
        //dd($request->input());
        date_default_timezone_set('Asia/Kolkata');

        $image_url = url('public/images/userimage.png');

        $username = $request->username;
        $email = $request->email;
        $password = Hash::make($request->password);
        $emailExist = DB::table('users')->where('email', $email)->count();
        $userExist = DB::table('users')->where('username', $username)->count();

        if (!isset($username)) {
            $result = array('status' => false, 'message' => 'Name is required.');
        } else if (!isset($email)) {
            $result = array('status' => false, 'message' => 'Email is required.');
        } else if (!isset($request->password)) {
            $result = array('status' => false, 'message' => 'Password is required.');
        } else if ($emailExist > 0) {
            $result = array('status' => false, 'message' => 'Email is already exist.');
        } else if ($userExist > 0) {
            $result = array('status' => false, 'message' => 'Username is already exist.');
        } else {
            $otp =  mt_rand(1000, 9999);
            $date = date("Y-m-d h:i:s", time());
            $data = ['username' => $username, 'name' => $username, 'image' => $image_url, 'email' => $email, 'password' => $password, 'status' => 1, 'created_at' => $date, 'updated_at' => $date, 'role' => 96];
            // echo "<pre>";
            // print_r($data);
            // exit;
            //    $subject="Register Otp";
            //  $message = "Register Otp OTP ". $otp;


            $addUsers = DB::table('users')->insert($data);
            //$up_otp = ['otp'=>$otp,'email'=>$email, 'create_at'=>$date, 'update_at'=>$date];
            //$upt_success = DB::table('password_otp')->insert($up_otp);
            if ($addUsers) {
                // $this->sendMail($request->email,$subject,$message);
                $result = array('status' => true, 'message' => 'Guest User added successfully.');
            } else {
                $result = array('status' => false, 'message' => 'Something went wrong. Please try again.');
            }
        }
        echo json_encode($result);
    }
    //email verification otp

    public function emailSentOtp(Request $request)
    {
        $email = $request->email;
        $otp =  mt_rand(1000, 9999);
        $date = date("Y-m-d h:i:s", time());
        $check_email = DB::table('email_otp')->where('email', $email)->count();

        $mail = new PHPMailer();
        $mail->SMTPDebug  = 0;
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->Username = "sakil.appic@gmail.com";
        $mail->Password = 'APPICSOFTWARES';
        $mail->SetFrom("sakil.appic@gmail.com");
        $mail->Subject = "Email verification";
        $mail->Body = "Email verification OTP " . $otp;
        $mail->AddAddress($email);

        if ($check_email > 0) {
            $up_otp = ['otp' => $otp, 'create_at' => $date, 'update_at' => $date];
            $upt_success = DB::table('email_otp')->where('email', $email)->update($up_otp);
            if ($upt_success) {
                if ($mail->Send()) {
                    $result = array('status' => 200, 'message' => 'OTP sent your email successfully');
                }
            } else {
                $result = array('status' => 201, 'message' => 'OTP not sent');
            }
        } else {
            $gan_otp = ['email' => $email, 'otp' => $otp, 'create_at' => $date, 'update_at' => $date];
            $otp_success = DB::table('email_otp')->insert($gan_otp);

            if ($otp_success) {
                if ($mail->Send()) {
                    $result = array('status' => 200, 'message' => 'OTP sent your email successfully');
                } else {
                    $result = array('status' => 201, 'message' => 'OTP not sent');
                }
            } else {
                $result = array('status' => 201, 'message' => 'Something is Wrong.');
            }
        }
        echo json_encode($result);
    }

    public function emailVerification(Request $request)
    {
        $email = $request->email;
        $otp = $request->otp;

        $verify_otp = DB::table('email_otp')->where('email', $email)->where('otp', $otp)->first();
        $otp_expires_time = Carbon::now()->subMinutes(5);

        if ($verify_otp->create_at < $otp_expires_time) {
            $result = array('status' => false, 'message' => 'OTP is unvalid.');
        } else {
            $result = array('status' => true, 'message' => 'OTP valid successfully.');
        }
        echo json_encode($result);
    }


    public function forgotPassword(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        $otp =  mt_rand(1000, 9999);
        $date = date("Y-m-d h:i:s", time());
        if (!empty($email)) {
            $check_email = DB::table('users')->where('email', $email)->count();

            $subject = "Forgot password";
            $message = "Forgot password OTP " . $otp;
            if ($check_email > 0) {

                $this->sendMail($request->email, $subject, $message);
                // if($this->sendMail($email,$subject,$message))
                // {
                $up_otp = ['otp' => $otp, 'create_at' => $date, 'update_at' => $date, 'email' => $email];
                $upt_success = DB::table('password_otp')->where('email', $email)->update($up_otp);
                if ($upt_success) {

                    $result = array('status' => true, 'message' => 'OTP sent successfully');
                } else {
                    $upt_success2 = DB::table('password_otp')->insert($up_otp);
                    if ($upt_success2) {
                        $result = array('status' => true, 'message' => 'OTP sent successfully');
                    } else {
                        $result = array('status' => false, 'message' => 'OTP not Send');
                    }
                }
                //        }
                // else
                // {
                //          $result = array('status'=> false, 'message'=>'Otp not sent');
                // }
            } else {
                // $subject="Forgot password";
                // $message = "Forgot password OTP ". $otp;
                // if($this->sendMail($request->email,$subject,$message))
                // {
                //     $gan_otp = ['email'=> $email, 'otp'=>$otp, 'create_at'=>$date, 'update_at'=>$date];
                //     $otp_success = DB::table('password_otp')->insert($gan_otp);
                //     if($otp_success){
                //             $result = array('status'=> true, 'message'=>'Otp sent successfully');
                //     }else{
                //             $result = array('status'=> false, 'message'=>'Otp not sent');
                //         }
                // }
                // else
                // {
                //     $result = array('status'=> false, 'message'=>'Otp not sent');
                // }
                $result = array('status' => false, 'message' => 'Invalid Email Address');
            }
        } else {
            $result = array('status' => false, 'message' => 'Email is required');
        }
        echo json_encode($result);
    }
    public function resendotp(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        $otp =  mt_rand(1000, 9999);
        $date = date("Y-m-d h:i:s", time());
        if (!empty($email)) {
            $check_email = DB::table('temp_users')->where('email', $email)->count();

            $subject = "Resend Otp";
            $message = "Resend OTP " . $otp;
            if ($check_email > 0) {

                $this->sendMail($request->email, $subject, $message);
                // if($this->sendMail($email,$subject,$message))
                // {
                $up_otp = ['otp' => $otp, 'create_at' => $date, 'update_at' => $date, 'email' => $email];
                $upt_success = DB::table('password_otp')->where('email', $email)->update($up_otp);
                if ($upt_success) {

                    $result = array('status' => true, 'message' => 'OTP send successfully');
                } else {
                    $upt_success2 = DB::table('password_otp')->insert($up_otp);
                    if ($upt_success2) {
                        $result = array('status' => true, 'message' => 'OTP send successfully');
                    } else {
                        $result = array('status' => false, 'message' => 'OTP not Send');
                    }
                }
                //        }
                // else
                // {
                //          $result = array('status'=> false, 'message'=>'Otp not sent');
                // }
            } else {
                // $subject="Forgot password";
                // $message = "Forgot password OTP ". $otp;
                // if($this->sendMail($request->email,$subject,$message))
                // {
                //     $gan_otp = ['email'=> $email, 'otp'=>$otp, 'create_at'=>$date, 'update_at'=>$date];
                //     $otp_success = DB::table('password_otp')->insert($gan_otp);
                //     if($otp_success){
                //             $result = array('status'=> true, 'message'=>'Otp sent successfully');
                //     }else{
                //             $result = array('status'=> false, 'message'=>'Otp not sent');
                //         }
                // }
                // else
                // {
                //     $result = array('status'=> false, 'message'=>'Otp not sent');
                // }
                $result = array('status' => false, 'message' => 'Invalid Email Address');
            }
        } else {
            $result = array('status' => false, 'message' => 'Email is required');
        }
        echo json_encode($result);
    }
    public function get_allusers()
    {
        $get_allusers = DB::table('users')->where('role', 97)->get();
        if (!empty($get_allusers)) {
            $result = array('status' => true, "data" => $get_allusers);
        } else {
            $result = array('status' => false, "message" => "No Record Found");
        }
        echo json_encode($result);
    }

    public function passwordVerification(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        $otp = $request->otp;
        $method = $request->method;

        $verify_otp = DB::table('password_otp')->where('email', $email)->where('otp', $otp)->first();
        // echo "<pre>";
        // // print_r($verify_otp);
        // // exit;
        if (!empty($verify_otp)) {
            //    $otp_expires_time = Carbon::now()->subMinutes(5);
            $otp_expires_time =  date('m/d/Y h:i:s', time());
            if ($verify_otp->create_at < $otp_expires_time) {
                $result = array('status' => false, 'message' => 'OTP Expired.');
            } else {
                DB::table('password_otp')->where('email', $email)->delete();
                $user_data = DB::table('temp_users')->where('email', $email)->first();
                //  dd($user_data);

                $image_url = url('public/images/userimage.png');
                $date = date("Y-m-d h:i:s", time());
                if ($method == 1) {
                    $updateData['email'] = $user_data->email;
                    $updateData['name'] = $user_data->name;
                    $updateData['username'] = $user_data->username;
                    $updateData['country_code'] = $user_data->country_code;
                    $updateData['password'] = $user_data->password;
                    $updateData['role'] = $user_data->role;
                    $updateData['image'] =  isset($user_data->image) ? $user_data->image : $image_url;
                    $updateData['created_at'] =   $date;
                    $updateData['updated_at'] =   $date;
                    $updateData['status'] =   1;
                    //  dd($updateData);

                    DB::table('users')->insert($updateData);
                    DB::table('temp_users')->where('email', $email)->delete();
                    $insertedData =  DB::table('users')->where('email', $email)->first();
                    $result = array('status' => true, 'message' => 'Signed up successfully.', 'data' => $insertedData);
                } else {
                    $insertedData =  DB::table('users')->where('email', $email)->first();
                    $result = array('status' => true, 'message' => 'Password OTP verified.', 'data' => $insertedData);
                }
            }
        } else {
            $result = array('status' => false, 'message' => 'invalid Otp');
        }

        echo json_encode($result);
    }
    public function forgetpasswordVerification(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        $otp = $request->otp;

        $verify_otp = DB::table('password_otp')->where('email', $email)->where('otp', $otp)->first();
        // echo "<pre>";
        // // print_r($verify_otp);
        // // exit;
        if (!empty($verify_otp)) {
            //    $otp_expires_time = Carbon::now()->subMinutes(5);
            $otp_expires_time =  date('m/d/Y h:i:s', time());
            if ($verify_otp->create_at < $otp_expires_time) {
                $result = array('status' => false, 'message' => 'OTP Expired.');
            } else {
                DB::table('password_otp')->where('email', $email)->delete();
                $user_data = DB::table('users')->where('email', $email)->first();
                $image_url = url('public/images/userimage.png');
                $user_data->image =  isset($user_data->image) ? $user_data->image : $image_url;
                $result = array('status' => true, 'message' => 'OTP Valid Successfull.', 'data' => $user_data);
            }
        } else {
            $result = array('status' => false, 'message' => 'invalid email or OTP');
        }

        echo json_encode($result);
    }

    public function passwordUpdate(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;

        $newPassword = Hash::make($request->newPassword);
        // $confirmPassword = Hash::make($request->confirmPassword);

        if (!isset($email)) {
            $result = array('status' => false, 'message' => 'Email is required');
        } else if (!isset($request->newPassword)) {
            $result = array('status' => false, 'message' => 'New password is required');
        } else if (!isset($request->confirmPassword)) {
            $result = array('status' => false, 'message' => 'Confirm password is required');
        } else if (!Hash::check($request->confirmPassword, $newPassword)) {
            $result = array('status' => false, 'message' => 'password not match');
        } else {
            $date = date("Y-m-d h:i:s", time());
            $data = ['password' => $newPassword, 'updated_at' => $date];
            $pass_upde = DB::table('users')->where('email', $email)->update($data);
            if ($pass_upde) {
                $result = array('status' => true, 'message' => 'Password reset successful.');
            } else {
                $result = array('status' => false, 'message' => 'password not changed.');
            }
        }

        echo json_encode($result);
    }


    public function signUp(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',

        ]);
        if ($validate->fails()) {
            $result = array("status" => false, "message" => "Validation Failed", "error" => $validate->errors());
        } else {
            $res = User::where('email', $request->email)->first();
            if ($res) {
                $result = array("status" => false, "message" => "User  Already Register");
            } else {
                $verify = new Verification();

                session(["name" => $request->name]);
                session(["email" => $request->email]);
                session(["phone" => $request->phone]);
                session(["language" => $request->language]);
                session(["password" => $request->password]);

                $otp =  mt_rand(100000, 999999);
                $verify->email = $request->email;
                $verify->otp = $otp;
                $verify->verify_at = Carbon::now();
                $verify->save();

                $subject = "Verify your account";
                $message = $otp;
                if ($this->sendMail($request->email, $subject, $message)) {
                    //   return view('Pages.email-verification');
                    $result = array('status' => true, 'message' => "Send Email in your Email Address");
                } else {
                    $result = array('status' => false, 'message' => "Something Went Wrong");
                    //  return view('signup');
                }


                // $user->password=Hash::make($request->password);
                // $user->save();
                // $result=array("status"=>true,"message"=>"Send Otp In your Email Address ","data"=>$user);
            }
            echo json_encode($result);
        }
    }

    public function edit(Request $request)
    {
        $useData = DB::table('users')->where('id', $request->id)->first();

        if (!empty($useData)) {

            $result = array('status' => true, 'data' => $useData);
        } else {
            $result = array('status' => false, 'message' => 'No Record Found');
        }
        echo json_encode($result);
    }

    public function profile_update(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        if (!empty($request->id)) {
            $usreData = DB::table('users')->where('id', $request->id)->first();

            if (!isset($request->name)) {
                $result = array('status' => false, 'message' => 'Name is required');
            } else if (!isset($request->country_code)) {
                $result = array('status' => false, 'message' => 'Please Enter country_code');
            } else if (!isset($request->phone)) {
                $result = array('status' => false, 'message' => 'Phone Number is required');
            } else if (!isset($request->dob)) {
                $result = array('status' => false, 'message' => 'Date of Birth is required');
            } else {
                $fileimage = "";
                $image_url = '';
                if ($request->hasfile('image')) {
                    $file_image = $request->file('image');
                    $fileimage = md5(date("Y-m-d h:i:s", time())) . "." . $file_image->getClientOriginalExtension();
                    $destination = public_path("images");
                    $file_image->move($destination, $fileimage);
                    $image_url = url('public/images') . '/' . $fileimage;
                } else {
                    $image_url = $usreData->image;
                }
                // echo $image_url;
                // exit;
                $updateData = array(
                    'name' => isset($request->name) ? $request->name : $usreData->name,
                    // 'email'=>isset($request->email)? $request->email : $usreData->email,
                    'phone' => isset($request->phone) ? $request->phone : $usreData->phone,
                    'dob' => isset($request->dob) ? $request->dob : $usreData->dob,
                    'country_code' => isset($request->country_code) ? $request->country_code : $usreData->country_code,
                    'image' => $image_url,
                    'updated_at' => date("Y-m-d h:i:s", time())
                );
                $updateRecord = DB::table('users')->where('id', $usreData->id)->update($updateData);
                if ($updateRecord) {
                    $updatedeData = DB::table('users')->where('id', $request->id)->first();
                    $result = array('status' => true, 'message' => 'Profile Update Successfully.', 'data' => $updatedeData);
                } else {
                    $result = array('status' => false, 'message' => 'Profile Update Failed.');
                }
            }
        } else {
            $result = array('status' => false, 'message' => 'No Record Found');
        }
        echo json_encode($result);
    }


    public function sendMail($email, $stubject = NULL, $message = NULL)
    {

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->SMTPSecure = "tls";
            $mail->SMTPAuth = true;
            $mail->Username = "wemarkspot@gmail.com"; //"raviappic@gmail.com";
            $mail->Password = "dwspcijqkcgagrzl"; //"audnjvohywazsdqo";
            $mail->addAddress($email, "User Name");
            $mail->Subject = $stubject;
            $mail->isHTML();
            $mail->Body = $message;
            $mail->setFrom("raviappic@gmail.com");
            $mail->FromName = "We Mark The Spot";

            if ($mail->send()) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function verifyOtp(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $email =  session("email");
        $otp = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4 . $request->digit5 . $request->digit6;
        $otp = (int)$otp;
        $date1 = new DateTime(date('d-m-Y h:i:s', time()));
        $res = Verification::where('email', $email)->first();

        if ($res) {
            $date2 = new DateTime($res->verify_at);
            $differance = $date2->diff($date1);
            $diff = $differance->i;
            if ($diff <= 2) {
                $res = Verification::where('otp', $otp)->first();
                if ($res) {
                    Verification::where('email', $email)->delete();
                    //yaha databse me entry hogi  user ki sari details           
                    $user = new User();
                    $user->name =  session("name");
                    $user->email = session("email");
                    $user->phone = session("phone");
                    $user->language = session("language");
                    $user->password = session("password");
                    $user->save();

                    $result = array('status' => true, 'message' => 'User Register Successfully');
                } else {
                    $result = array('status' => false, 'message' => 'Wrong OTP ');
                }
            } else {
                $result = array('status' => false, 'message' => 'OTP Expired', 'time' => $differance);
            }
        } else {
            $result = array('status' => false, 'message' => 'email not exits ');
        }
        echo json_encode($result);
    }

    //   public function resendotp(Request $request]){
    //       'email' => 're'
    //   }




    public function fitness_one(Request $request)
    {
        //dd($request->input());
        $request->session()->put('gender', $request->gender);
        //session(["gender"=>$request->gender]);
        $request->session()->put('weight', $request->weight);
        //session(["weight"=>$request->weight]);
        //    dd($request->input());
        if (!is_null($request->weight_lb)) {
            // session(["weight_unit"=>$request->weight_unit]);
            $request->session()->put('weight_unit', $request->LB);
        } else {

            $request->session()->put('weight_unit', $request->KG);
        }
        //session(["height"=>$request->height]);
        $request->session()->put('height', $request->height);
        if (!is_null($request->height_cm)) {
            $request->session()->put('height_unit', "CN");
        } else {
            if ((!is_null($height_unit_ft)) && (!is_null($height_unit_in))) {
                $request->session()->put('height_unit', "IN");
            }
        }
        // session(["height_unit"=>$request->height_unit]);
        //dd($request->input());
        return view('Pages.fitness-survey2');
    }
    public function fitness_two(Request $request)
    {
        // dd($request->input());
        // session(["interest"=>$request->interest]);
        $request->session()->put('interest', $request->interest);
        // session(["bodyparts_work"=>$request->bodyparts_work]);
        $request->session()->put('bodyparts_work', $request->bodyparts_work);
        // session(["exercise"=>$request->exercise]);
        $request->session()->put('exercise', $request->exercise);
        // session(["height_unit"=>$request->height_unit]);
        return view('Pages.fitness-survey3');
    }

    public function fitness_survey(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'length_training' => 'required',
            'fitness_goal' => 'required',
            'diedt_impact' => 'required'
        ]);
        if ($validate->fails()) {
            $result = array('status' => false, 'message' => 'Validation failed', 'error' => $validate->errors());
        } else {
            //  dd($request->input());
            // session(["gender"=>$request->gender]);
            // session(["weight"=>$request->weight]);
            // session(["weight_unit"=>$request->weight_unit]);

            $fitness = new Fitness_survey();
            $fitness->gender = session()->get('gender'); // session("gender");
            $fitness->weight = session()->get('weight'); // session("weight");
            $fitness->weight_unit = session()->get('weight_unit'); // session("weight_unit");
            $fitness->height = session()->get('height'); // session("height");
            $fitness->height_unit = session()->get('height_unit'); //  session("height_unit");
            $fitness->interest = session()->get('interest'); // session("interest");
            $fitness->bodyparts_work = session()->get('bodyparts_work'); //session("bodyparts_work");
            $fitness->exercise = session()->get('exercise'); //  session("exercise");
            $fitness->length_training = $request->length_training;
            $fitness->fitness_goal = $request->fitness_goal;
            $fitness->diedt_impact =   $request->diedt_impact;
            // dd($fitness);
            $fitness->save();

            if ($fitness) {
                Session::forget('gender');
                Session::forget('weight');
                Session::forget('weight_unit');
                Session::forget('height');
                Session::forget('height_unit');
                Session::forget('interest');
                Session::forget('exercise');
                Session::forget('exercise');
                // $url =url('membership');
                // $result = array('status'=>true, 'message'=>'Fitness Survey Successfully',
                //     "url"=>$url );

                return redirect()->to('membership');
            } else {
                $result = array('status' => false, 'message' => 'Something Went Wrong');
            }
        }
        echo json_encode($result);
    }

    public function getquoatesdata(Request $request)
    {
        // dd($request->input());
        $id = $request->id;

        $latitude = $request->lat;
        $longitude = $request->long;
        $updateData = array('lat' => $latitude, 'long' => $longitude);

        User::where('id', $id)->update($updateData);



        $dataArray = array();
        $Quoatesdata = Quoates::first();
        // $business = Giweaway::all();
        $business_details = Giweaway::join('users', 'users.id', '=', 'giweaways.user_id')->first(['users.*']);
        // dd($business_details->business_category);
        $uid = $business_details->id;

        $category_data = categorys::where('id', $business_details->business_category)->first();

        $business_details->category_name = $category_data->name;
        $data1 = DB::select("select (((acos(sin((" . $latitude . "*pi()/180)) * sin((p.lat*pi()/180))+cos((" . $latitude . "*pi()/180)) * cos((p.lat*pi()/180)) * cos(((" . $longitude . "-p.long)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM users p where id =" . $uid);

        $distance = isset($data1[0]->distance) ?  number_format($data1[0]->distance, 2) : "0.0";
        $business_details->distance = $distance;
        // dd($business_details);
        // array_push($dataArray,$Quoatesdata);
        if (!is_null($Quoatesdata)) {

            $Quoatesdata->title = $Quoatesdata->name;
            $Quoatesdata->sub_heading = $Quoatesdata->short_information;
            $Quoatesdata->description = $Quoatesdata->detail_information;
            $result = array('status' => true, 'message' => 'Data', "quoatesdata" => $Quoatesdata, 'data' => $business_details);
        } else {
            $result = array('status' => false, 'message' => 'No record found', 'data' => '');
        }
        echo json_encode($result);
    }









    public function getnearby(Request $request)
    {

        $user_id = $request->input('id');
        $user_data = User::where('id', $user_id)->first();

        $latitude = $user_data->lat;
        $longitude = $user_data->long;





        $business_details = DB::select("select *, cast((((acos(sin((" . $latitude . "*pi()/180)) * sin((p.lat*pi()/180))+cos((" . $latitude . "*pi()/180)) * cos((p.lat*pi()/180)) * cos(((" . $longitude . "-p.long)*pi()/180))))*180/pi())*60*1.1515*1.609344) as decimal(10,2)) * 0.6213711922 as distance FROM users p where role=99  having distance < 5 order by distance asc");
        //    echo json_encode($business_details);
        //  $distance =number_format($data1[0]->distance,2); 
        // $business_details[0]->distance=$distance;
        $review_count = BusinessReviews::where('user_id', $user_id)->count();
        $users = BusinessReviews::select('user_id')->groupBy('user_id')->get()->toArray();
        $totalreview = 0;
        foreach ($business_details as $b) {
            $b->avgratting = number_format(BusinessReviews::where('business_id', $b->id)->avg('ratting'), 1);
            $totalreviews = BusinessReviews::where('business_id', $b->id)->groupBy('user_id')->count();

            $checkin_count = BusinessReviews::where('business_id', $b->id)->where('type', "CHECK_IN")->count();
            $b->user_count = isset($checkin_count) ? $checkin_count : 0;
            $totalreview = $totalreview + $totalreviews;
            $b->totalReviewusers = $totalreview;

            $category_data = categorys::where('id', $b->business_category)->first();
            $b->category_name = isset($category_data->name) ? $category_data->name : '';
            // $b->user_count = isset($users) ? count($users) : 0;
            //  $b->user_count = isset($checkin_count) ? count($checkin_count) : 0;
            $b->review_count = isset($review_count) ? $review_count : 0;
            $b->distance = number_format($b->distance, 1);

            $BusinessFav = BusinessFav::where(['user_id' => $user_id, 'business_id' => $b->id])->count();
            if ($BusinessFav > 0) {
                $b->fav = 1;
            } else {
                $b->fav = 0;
            }
        }

        if (isset($business_details)) {
            $result = array('status' => true, 'message' => 'Data', 'data' => $business_details);
        } else {
            $result = array('status' => false, 'message' => 'No record found', 'data' => '');
        }
        echo json_encode($result);
    }

    public function getnearby4(Request $request)
    {

        $user_id = $request->input('id');
        $user_data = User::where('id', $user_id)->first();

        $latitude = $user_data->lat;
        $longitude = $user_data->long;





        $business_details = DB::select("select *, cast((((acos(sin((" . $latitude . "*pi()/180)) * sin((p.lat*pi()/180))+cos((" . $latitude . "*pi()/180)) * cos((p.lat*pi()/180)) * cos(((" . $longitude . "-p.long)*pi()/180))))*180/pi())*60*1.1515*1.609344) as decimal(10,2)) * 0.6213711922 as distance FROM users p where role=99  having distance < 5 order by distance asc");
        //    echo json_encode($business_details);
        //  $distance =number_format($data1[0]->distance,2); 
        // $business_details[0]->distance=$distance;
        $review_count = BusinessReviews::where('user_id', $user_id)->count();
        $users = BusinessReviews::select('user_id')->groupBy('user_id')->get()->toArray();
        $totalreview = 0;
        foreach ($business_details as $b) {
            $b->avgratting = number_format(BusinessReviews::where('business_id', $b->id)->avg('ratting'), 1);
            $totalreviews = BusinessReviews::where('business_id', $b->id)->groupBy('user_id')->count();

            $checkin_count = BusinessReviews::where('business_id', $b->id)->where('type', "CHECK_IN")->count();

            $totalreview = $totalreview + $totalreviews;
            $b->totalReviewusers = $totalreview;

            $category_data = categorys::where('id', $b->business_category)->first();
            $b->category_name = isset($category_data->name) ? $category_data->name : '';
            // $b->user_count = isset($users) ? count($users) : 0;
            $b->user_count = isset($checkin_count) ? $checkin_count : 0;
            $b->review_count = isset($review_count) ? $review_count : 0;
            $b->distance = number_format($b->distance, 1);

            $BusinessFav = BusinessFav::where(['user_id' => $user_id, 'business_id' => $b->id])->count();
            if ($BusinessFav > 0) {
                $b->fav = 1;
            } else {
                $b->fav = 0;
            }
        }

        if (isset($business_details)) {
            $result = array('status' => true, 'message' => 'Data', 'data' => $business_details);
        } else {
            $result = array('status' => false, 'message' => 'No record found', 'data' => '');
        }
        echo json_encode($result);
    }
    public function business_review(Request $request)
    {

        date_default_timezone_set('Asia/Kolkata');
        if ($request->input()) {
            $id  = $request->input('id');
            $business_id = $request->input('business_id');
            $user_id = $request->input('user_id');
            $ratting = $request->input('ratting');
            $review  = $request->input('review');
            $image_video_status = $request->input('image_video_status'); // 0 for not image/video only ratting 1 for image 2 for video
            $array_wheere = array('id' => $id);
            $business_review =  BusinessReviews::where($array_wheere)->first();

            if (!isset($business_review)) {
                $fileimage = "";
                $image_url = '';
                if ($request->hasfile('image')) {
                    $file_image = $request->file('image');
                    $fileimage = md5(date("Y-m-d h:i:s", time())) . "." . $file_image->getClientOriginalExtension();
                    $destination = public_path("images");
                    $file_image->move($destination, $fileimage);
                    $image_url = url('public/images') . '/' . $fileimage;
                }

                $data = [
                    'business_id' => $business_id,
                    'user_id' => $user_id,
                    'ratting' => $ratting,
                    'review' => $review,
                    'image' => $image_url,
                    'tag' => $request->tag,
                    'type' => $request->type,
                    'image_video_status' => $image_video_status,
                    'check_status' => $request->check_status,
                    'updated_at' => date("Y-m-d h:i:s", time()),
                    'created_at' => date("Y-m-d h:i:s", time())
                ];
                if ($request->type == 'CHECK_IN') {
                    $message = 'CHECK IN .';
                } else {
                    $message = 'Review added successfully.';
                }
                $insertRecord =    BusinessReviews::create($data);
                if ($insertRecord) {
                    $result = array('status' => true, 'message' => $message);
                } else {
                    $result = array('status' => false, 'message' => 'Review added  Failed.');
                }
            } else {

                // updated 
                $fileimage = "";
                $image_url = '';
                if ($request->hasfile('image')) {

                    $file_image = $request->file('image');
                    $fileimage = md5(date("Y-m-d h:i:s", time())) . "." . $file_image->getClientOriginalExtension();
                    $destination = public_path("images");
                    $file_image->move($destination, $fileimage);
                    $image_url = url('public/images') . '/' . $fileimage;
                } else {
                    $image_url = $business_review->image;
                }

                $updateData = array(
                    'image_video_status' => isset($image_video_status) ? $image_video_status : $business_review->image_video_status,
                    'business_id' => isset($business_id) ? $business_id : $business_review->name,
                    'user_id' => isset($user_id) ? $user_id : $business_review->user_id,
                    'ratting' => isset($ratting) ? $ratting : $business_review->ratting,
                    'review' => isset($review) ? $review  : $business_review->review,
                    'image' => $image_url,
                    'updated_at' => date("Y-m-d h:i:s", time()),
                );

                $updateRecord = BusinessReviews::where('id', $business_review->id)->update($updateData);
                if ($updateRecord) {
                    $result = array('status' => true, 'message' => 'Review Updated  successfully.');
                } else {
                    $result = array('status' => false, 'message' => 'Review Updated  Failed.');
                }
            }
        } else {
            $result = array('status' => false, 'message' => 'Something Went Wrong');
        }
        echo json_encode($result);
    }

    public function business_review_delete(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'review_id' => 'required',
            'user_id' => 'required',

        ]);
        if ($validate->fails()) {
            $result = array('status' => false, "message" => 'Validation Failed', 'errors' => $validate->errors());
        } else {
            BusinessReviews::where('id', $request->review_id)->where('user_id', $request->user_id)->delete();
            $result = array('status' => true, "message" => 'Review Deleted');
        }
        echo json_encode($result);
    }

    public function checkOut(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'business_id' => 'required',

        ]);
        if ($validate->fails()) {
            $result = array('status' => false, "message" => 'Validation Failed', 'errors' => $validate->errors());
        } else {
            $check = BusinessReviews::where('business_id', $request->business_id)
                ->where('user_id', $request->user_id)
                ->where('check_status', 1)
                ->where('type', 'CHECK_IN')
                ->where('created_at', 'like', '%' . date('Y-m-d') . '%')
                ->first();
            if ($check) {
                $check->check_status = 2;
                $check->save();
                $result = array('status' => true, "message" => 'check Out');
            } else {
                $result = array('status' => false, "message" => 'check In First');
            }
        }

        echo json_encode($result);
    }


    public function community_reviews(Request $request)
    {
        //Businessreviewlikedislike
        if ($request->input()) {
            $user_id = $request->user_id;
            $business_id = $request->business_id;

            $usreData = BusinessReviews::join('users', "users.id", "=", "business_reviews.user_id")
                ->where(array('business_reviews.business_id' => $business_id))
                ->orderBy('business_reviews.id', 'desc')
                ->select(
                    'users.id',
                    'users.name',
                    'users.image as image',
                    'business_reviews.type',
                    'business_reviews.image_video_status',
                    'users.business_images as business_images',
                    'business_reviews.ratting',
                    'business_reviews.status',
                    'business_reviews.business_id as business_id',
                    'business_reviews.id as business_reviews_id',
                    'business_reviews.review',
                    'business_reviews.image as business_review_image'
                )
                ->get();
            $replies_co = 0;


            $like = 0;
            $dislike = 0;
            $like_status = 0;
            $total_likeDislike = 0;

            if (isset($usreData)) {
                foreach ($usreData as $review) {
                    $replies_count = Replies::where(['review_id' => $review->business_reviews_id])->count();
                    $review->replies_count = $replies_count;
                    if (!empty($review->business_review_image)) {
                        $review->business_review_image_status = $business_review_image_status = 1;
                    } else {
                        $review->business_review_image_status = $business_review_image_status = 0;
                    }

                    // $business_reviewlikeData = Businessreviewlikedislike::where([
                    //     'businessreview_id' => $review->business_reviews_id,
                    //     'user_id' => $user_id, 'business_id' => $business_id
                    // ])->first();
                    


                    $total_like = Businessreviewlikedislike::where([
                        'businessreview_id' => $review->business_reviews_id,
                        'likedislike' => 1, 'business_id' => $business_id
                    ])->count();

                    $total_dislike = Businessreviewlikedislike::where([
                        'businessreview_id' => $review->business_reviews_id,
                        'likedislike' => 2, 'business_id' => $business_id
                    ])->count();


                    if (($total_like == 0) && ($total_dislike == 0)) {
                        $like_status = 0;
                    } else {
                        $likedislikeData = Businessreviewlikedislike::where([
                            'businessreview_id' => $review->business_reviews_id,
                            'user_id' => $user_id, 'business_id' => $business_id
                        ])->first();
                        if($likedislikeData){
                            $like_status =  $likedislikeData->likedislike;
                        }else{
                            $like_status = 0;
                        }
                        
                    }
                    $review->like_status = $like_status;
                    $review->total_like = $total_like;
                    $review->total_dislike = $total_dislike;
                }
            }


            if ($usreData) {
                $result = array('status' => true, 'message' => 'data ', 'data' => $usreData);
            } else {
                $result = array('status' => false, 'message' => '', 'data' => '');
            }
            echo json_encode($result);
        }
    }



    public function get_businessusers(Request $request)
    {
        if ($request->input()) {
            $name = $request->name;

            $business_name = User::where(['name' => $name, 'role' => 99])
                ->orWhere('name', 'like', '%' . $name . '%')->get();
            if ($business_name) {
                $result = array('status' => true, "message" => '', 'data' => $business_name);
            } else {
                $result = array('status' => true, "message" => 'no record found', 'data' => '');
            }
            echo json_encode($result);
        }
    }

    public function add_hotspots(Request $request)
    {
        if ($request->input()) {
            $data = [
                'business_id' => $request->business_id,
                'user_id' => $request->user_id,
                'message' => $request->message,
                'updated_at' => date("Y-m-d h:i:s", time()),
                'created_at' => date("Y-m-d h:i:s", time())
            ];

            $insertRecord =    Hotspots::create($data);
            if ($insertRecord) {
                $result = array('status' => true, 'message' => 'Hotspots added  successfully.');
            } else {
                $result = array('status' => false, 'message' => 'Hotspots added  Failed.');
            }
            echo json_encode($result);
        }
    }

    public function gethotspots()
    {
        $hotspots = Hotspots::join('users', 'users.id', '=', 'hotspots.user_id')
            ->join('users as business_users', 'business_users.id', '=', 'hotspots.business_id')
            ->orderBy('hotspots.id', 'desc')
            ->get(['users.name as person_name', 'users.image as user_image', 'business_users.business_name as business_user_name', 'hotspots.*']);

        if (isset($hotspots)) {
            $result = array("status" => true, "message" => "data", "data" => $hotspots);
        } else {
            $result = array("status" => false, "message" => "no Reocrd found", "data" => '');
        }
        echo json_encode($result);
    }
    public function BusinessFav(Request $request)
    {
        if ($request->input()) {
            $fav = $request->fav;
            $user_id = $request->user_id;
            $business_id = $request->business_id;

            if ($fav == 1) {
                $data = array(
                    'user_id' => $user_id, "business_id" => $business_id, 'fav' => 1, 'updated_at' => date("Y-m-d h:i:s", time()),
                    'created_at' => date("Y-m-d h:i:s", time())
                );

                $checked =   BusinessFav::create($data);
                if ($checked) {
                    $result = array("status" => true, 'message' => "Business added to favourites.");
                } else {
                    $result = array("status" => false, 'message' => "Business removed from favourites falils.");
                }
            } else {
                $data = array('user_id' => $user_id, "business_id" => $business_id);
                $checked =   BusinessFav::where($data)->delete();

                if ($checked) {
                    $result = array("status" => true, 'message' => "Business removed from favorites.");
                } else {
                    $result = array("status" => false, 'message' => "Business removed from favorites fails.");
                }
            }
            echo json_encode($result);
        }
    }

    public function replies_community_reviews(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');

        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'review_id' => 'required',
            'reply_id' => 'required',
            'type' => 'required',
            'message' => 'required'
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {

            if ($request->type == 'REVIEW') {
                $data = array(
                    'user_id' => $request->user_id,
                    'review_id' => $request->review_id,
                    'reply_id' => $request->reply_id,
                    'type' => 'REVIEW',
                    'message' => $request->message,
                    'updated_at' => date("Y-m-d G:i:s", time()),
                    'created_at' => date("Y-m-d G:i:s", time())
                );
                $inserted = Replies::create($data);
                if ($inserted) {
                    $result = array("status" => true, 'message' => "Replies added successfully", 'record_count' => 1);
                } else {
                    $result = array("status" => false, 'message' => "Replies added Failed", 'record_count' => 0);
                }
            } else if ($request->type == 'HOTSPOT') {
                $data = array(
                    'user_id' => $request->user_id,
                    'review_id' => $request->review_id,
                    'reply_id' => $request->reply_id,
                    'type' => 'HOTSPOT',
                    'message' => $request->message,
                    'updated_at' => date("Y-m-d G:i:s", time()),
                    'created_at' =>     date("Y-m-d G:i:s", time())
                );
                $inserted = Replies::create($data);
                if ($inserted) {
                    $result = array("status" => true, 'message' => "Replies added successfully", 'record_count' => 1);
                } else {
                    $result = array("status" => false, 'message' => "Replies added Failed", 'record_count' => 0);
                }
            } else {
                $result = array("status" => false, 'message' => "Something Went Wrong");
            }
        }
        echo json_encode($result);
    }

    public function get_replies_community_reviews(Request $request)
    {

        $Validation = Validator::make($request->all(), [
            'review_id' => 'required',
            'type' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $data = Replies::with('user:id,name,image')->where('review_id', $request->review_id)->where('type', $request->type)->get();
            // foreach($data as $d)
            // {
            //     $timestamp = strtotime($d->created_at);
            //     $new_date_format = date('Y-m-d H:i:s', $timestamp);
            //     $date1 = date_create($new_date_format);
            //   //  $date1 = date_create($d->created_at);
            //     $date2 = date_create(date("Y-m-d H:m:i"));
            //     $diff = date_diff($date1,$date2);
            //     $d->dif =$diff;
            //     $diffInSeconds = $diff->s; //45
            //     $diffInMinutes = $diff->i;
            //     $d->hour = $diff->h;
            //     $d->Seconds = $diffInSeconds;
            //     $d->Minutes = $diffInMinutes;
            // }


            $tree = function ($replies_reviews, $reply_id = 0) use (&$tree) {
                $branch = array();
                foreach ($replies_reviews as $element) {

                    if ($element['reply_id'] == $reply_id) {

                        $children = $tree($replies_reviews, $element['id']);
                        if ($children) {
                            $element['children'] = $children;
                        } else {
                            $element['children'] = [];
                        }
                        $branch[] = $element;
                    }
                }

                return $branch;
            };

            $tree = $tree($data);

            $result  = array("status" => true, "message" => '', "data" => $tree);
        }

        echo json_encode($result);
    }


    public function get_replies_community_reviews1(Request $request)
    {

        $Validation = Validator::make($request->all(), [
            'review_id' => 'required',
            'type' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $data = Replies::with('user:id,name,image')->where('review_id', $request->review_id)->where('type', $request->type)->get();
            foreach ($data as $d) {
                $date1 = date_create($d->created_at);
                $date2 = date_create(date("Y-m-d H:m:i"));
                $diff = date_diff($date1, $date2);
                $d->hour = $diff->h;
            }

            $tree = function ($replies_reviews, $reply_id = 0) use (&$tree) {
                $branch = array();
                foreach ($replies_reviews as $element) {

                    if ($element['reply_id'] == $reply_id) {

                        $children = $tree($replies_reviews, $element['id']);
                        if ($children) {
                            $element['children'] = $children;
                        } else {
                            $element['children'] = [];
                        }
                        $branch[] = $element;
                    }
                }

                return $branch;
            };

            $tree = $tree($data);

            $result  = array("status" => true, "message" => '', "data" => $tree);
        }

        echo json_encode($result);
    }
    public function userCheckInList(Request $request)
    {

        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',

        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $data = BusinessReviews::with('user:id,name,image')->where('check_status', 1)->where('type', 'CHECK_IN')->get();



            $result  = array("status" => true, "message" => '', "data" => $data);
        }

        echo json_encode($result);
    }

    public function getbusinessFav(Request $request)
    {

        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',

        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $user_id = $request->user_id;
            $user_data = User::where('id', $user_id)->first();
            $latitude = $user_data->lat;
            $longitude = $user_data->long;

            $business_details = DB::select("select *, (((acos(sin((" . $latitude . "*pi()/180)) * sin((p.lat*pi()/180))+cos((" . $latitude . "*pi()/180)) * cos((p.lat*pi()/180)) * cos(((" . $longitude . "-p.long)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM users p where role=99 order by distance desc ");

            $review_count = BusinessReviews::where('user_id', $user_id)->count();
            $users = BusinessReviews::select('user_id')->groupBy('user_id')->get()->toArray();

            foreach ($business_details as $b) {
                $BusinessFav = BusinessFav::where(['user_id' => $user_id, 'business_id' => $b->id, 'fav' => 1])->count();
                if ($BusinessFav > 0) {
                    $b->fav = 1;
                    $category_data = categorys::where('id', $b->business_category)->first();
                    $b->category_name = isset($category_data->name) ? $category_data->name : '';
                    $b->user_count = isset($users) ? count($users) : 0;
                    $b->review_count = isset($review_count) ? $review_count : 0;
                    $b->distance = number_format($b->distance, 1);
                } else {
                    $b->fav = 0;
                }
            }
            $filter_data = array();
            $v = 0;
            foreach ($business_details as $k => $f) {
                if ($f->fav == 1) {
                    $filter_data[] = $f;
                }
                $v++;
            }
            // print_r($filter_data);
            // exit;
            if (isset($filter_data)) {
                $result = array('status' => true, 'message' => 'Data', 'data' => $filter_data);
            } else {
                $result = array('status' => false, 'message' => 'No record found', 'data' => '');
            }
        }
        echo json_encode($result);
    }

    public function addBuinessReports(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'business_id' => 'required',
            'review_id' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $data = BuinessReports::create(array('user_id' => $request->user_id, 'business_id' => $request->business_id, 'review_id' => $request->review_id));
            if ($data) {
                $result  = array("status" => true, "message" => 'Report Added Successfully');
            } else {
                $result  = array("status" => False, "message" => 'Report Added Failed');
            }
        }

        echo json_encode($result);
    }

    public function Businesslikedislike2(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'business_id' => 'required',
            'businessreview_id' => 'required',
            'likedislike' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            // dd($request->business_id);
            $data = Businessreviewlikedislike::create(array('user_id' => $request->user_id, 'business_id' => $request->business_id, 'businessreview_id' => $request->businessreview_id, 'likedislike' => $request->likedislike));
            if ($data) {
                $result  = array("status" => true, "message" => 'Like dislike Added Successfully');
            } else {
                $result  = array("status" => False, "message" => 'Like dislike  Added Failed');
            }
        }
        echo json_encode($result);
    }
    public function Businesslikedislike(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'business_id' => 'required',
            'businessreview_id' => 'required',
            'likedislike' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            // dd($request->business_id);
            $checkResult = Businessreviewlikedislike::where(array('user_id' => $request->user_id, 'business_id' => $request->business_id, 'businessreview_id' => $request->businessreview_id))->count();
            if ($checkResult > 0) {
                $data =  Businessreviewlikedislike::where(array('user_id' => $request->user_id, 'business_id' => $request->business_id, 'businessreview_id' => $request->businessreview_id))->update(array('likedislike' => $request->likedislike));
            } else {
                $data = Businessreviewlikedislike::create(array('user_id' => $request->user_id, 'business_id' => $request->business_id, 'businessreview_id' => $request->businessreview_id, 'likedislike' => $request->likedislike));
            }

            if ($data) {
                $result  = array("status" => true, "message" => 'Like dislike Added Successfully');
            } else {
                $result  = array("status" => False, "message" => 'Like dislike  Added Failed');
            }
        }
        echo json_encode($result);
    }

    public function BusinessSearch2(Request $request)
    {
        $user_id = $request->input('id');
        $key = $request->key;
        $user_data = User::where('id', $user_id)->first();
        if ($user_data) {
            $latitude = $user_data->lat;
            $longitude = $user_data->long;





            $business_details = DB::select("select *, (((acos(sin((" . $latitude . "*pi()/180)) * sin((p.lat*pi()/180))+cos((" . $latitude . "*pi()/180)) * cos((p.lat*pi()/180)) * cos(((" . $longitude . "-p.long)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM users p where role=99  and  p.business_name like '%" . $key . "%' order by distance desc ");

            //  $distance =number_format($data1[0]->distance,2); 
            // $business_details[0]->distance=$distance;
            $review_count = BusinessReviews::where('user_id', $user_id)->count();
            $users = BusinessReviews::select('user_id')->groupBy('user_id')->get()->toArray();

            foreach ($business_details as $b) {
                $category_data = categorys::where('id', $b->business_category)->first();
                $b->category_name = isset($category_data->name) ? $category_data->name : '';
                $b->user_count = isset($users) ? count($users) : 0;
                $b->review_count = isset($review_count) ? $review_count : 0;
                $b->distance = number_format($b->distance, 1);

                $BusinessFav = BusinessFav::where(['user_id' => $user_id, 'business_id' => $b->id])->count();
                if ($BusinessFav > 0) {
                    $b->fav = 1;
                } else {
                    $b->fav = 0;
                }
            }

            if (isset($business_details)) {
                $result = array('status' => true, 'message' => 'Data', 'data' => $business_details);
            } else {
                $result = array('status' => false, 'message' => 'No record found', 'data' => '');
            }
        }

        echo json_encode($result);
    }
    public function searchBybusinessNameCategoryNameSubCategoryName(Request $request)
    {
        if ($request->all()) {
            $name = $request->input('business_name');
            $category_name = $request->input('category_name');
            $sub_category_name = $request->input('sub_category_name');

            if (!empty($name)) {
                $user_data = User::where(['business_name' => $name, 'role' => 99])
                    ->orWhere('business_name', 'like', '%' . $name . '%')->get();
            } else if (!empty($category_name)) {

                $user_data = Categorys::join('users', "users.business_category", "=", "categorys.id")
                    ->where(['categorys.name' => $category_name])
                    ->orWhere('categorys.name', 'like', '%' . $category_name . '%')
                    ->select([
                        "users.*",
                        "categorys.name as category_name",
                    ])
                    ->get();
            } else if (!empty($sub_category_name)) {

                $user_data = SubCategorys::join('users', "users.business_sub_category", "=", "sub_categorys.id")
                    ->join('categorys', "sub_categorys.category_id", "=", "categorys.id")
                    ->where('users.role', 99)
                    //->where('sub_categorys.name', $sub_category_name)
                    ->where('sub_categorys.name', 'like', '%' . $sub_category_name . '%')
                    ->select(
                        "users.*",
                        "categorys.name as category_name",
                        "sub_categorys.name as sub_category_name",
                    )
                    ->get();
            }
            //   dd($user_data);
            if (!empty($user_data)) {

                foreach ($user_data as $u) {
                    if ((isset($u->lat)) && (isset($u->long))) {
                        $latitude = $u->lat;
                        $longitude = $u->long;
                        $user_id = $u->id;
                        $business_details = DB::select("select *, (((acos(sin((" . $latitude . "*pi()/180)) * sin((p.lat*pi()/180))+cos((" . $latitude . "*pi()/180)) * cos((p.lat*pi()/180)) * cos(((" . $longitude . "-p.long)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM users p where role=99 order by distance asc ");

                        $review_count = BusinessReviews::where('user_id', $user_id)->count();
                        $users = BusinessReviews::select('user_id')->groupBy('user_id')->get()->toArray();

                        foreach ($business_details as $b) {
                            $category_data = categorys::where('id', $b->business_category)->first();
                            $b->category_name = isset($category_data->name) ? $category_data->name : '';
                            $b->user_count = isset($users) ? count($users) : 0;
                            $b->review_count = isset($review_count) ? $review_count : 0;
                            $b->distance = number_format($b->distance, 1);

                            $BusinessFav = BusinessFav::where(['user_id' => $user_id, 'business_id' => $b->id])->count();
                            if ($BusinessFav > 0) {
                                $b->fav = 1;
                            } else {
                                $b->fav = 0;
                            }
                        }
                    }
                    if (isset($business_details)) {
                        $result = array('status' => true, 'message' => 'Data', 'data' => $business_details);
                    } else {
                        $result = array('status' => false, 'message' => 'No record found', 'data' => '');
                    }
                }
            } else {
                $result = array('status' => false, 'message' => 'No record found', 'data' => '');
            }
            echo json_encode($result);
        }
    }
    public function BusinessSearch(Request $request)
    {
        $user_id = $request->input('id');
        $key = $request->key;

        $hotspots = Hotspots::join('users', 'users.id', '=', 'hotspots.user_id')
            ->join('users as business_users', 'business_users.id', '=', 'hotspots.business_id')
           // ->where('users.id', $user_id)
            ->where('business_users.business_name', 'like', '%' . $key . '%')
            // ->orwhere('business_users.business_name', 'like', '%' .$key. '%')
            ->get(
                [
                    'users.id',
                    'users.name as person_name',
                    'users.image as user_image',
                    'business_users.business_name as business_user_name',
                    'hotspots.*'
                ]
            );
        if (isset($hotspots)) {
            $result = array("status" => true, "message" => "data", "data" => $hotspots);
        } else {
            $result = array("status" => false, "message" => "no Reocrd found", "data" => '');
        }
        echo json_encode($result);
    }
    public function getreviewbyuserid(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $user_id = $request->user_id;
            // $usreData = BusinessReviews::join('users', "users.id", "=", "business_reviews.business_id")
            // ->where(array('users.id' => $user_id,'role'=>99))->whereNotNull('users.business_name')->whereNotNull('users.business_images')
            // ->orderBy('business_reviews.id', 'desc')
            // ->select(
            //     'users.id',
            //     'users.business_name',
            //     'users.business_images',
            //     'business_reviews.created_at',
            //     'business_reviews.ratting',
            //     'business_reviews.status',
            //     'business_reviews.business_id as business_id',
            //     'business_reviews.id as business_reviews_id',
            //     'business_reviews.review',
            //     'business_reviews.image as business_review_image'
            // )
            // ->get();

            $usreData = BusinessReviews::join('users', 'users.id', "=", "business_reviews.business_id")

                ->where('business_reviews.user_id', $user_id)
                ->select(
                    'users.id',
                    'business_reviews.business_id as business_id',
                    'business_reviews.id as business_reviews_id',
                    'business_reviews.created_at',
                    'business_reviews.ratting',
                    'business_reviews.status',
                    "users.business_name",
                    "users.business_images",
                    "business_reviews.review",
                    'business_reviews.image as business_review_image',
                )
                ->get();

            if ($usreData) {
                $result  = array("status" => true, "message" => '', 'data' => $usreData);
            } else {
                $result  = array("status" => False, "message" => ' Failed', 'data' => '');
            }
        }
        echo json_encode($result);
    }

    public function editReview(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'reviews_id' => 'required',
            'review' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $updateData = array('review' => $request->review);
            $data = BusinessReviews::where('id', $request->reviews_id)->update($updateData);
            if ($data) {
                $result  = array("status" => true, "message" => 'Edit Review Updated Successfully');
            } else {
                $result  = array("status" => False, "message" => 'Edit Review Updated Failed');
            }
        }
        echo json_encode($result);
    }

    public function deletereview(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'business_id' => 'required',
            'reviews_id' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $user_id = $request->user_id;
            $business_id = $request->business_id;
            $reviews_id = $request->reviews_id;

            $BusinessReviews = BusinessReviews::where('id', $reviews_id)->delete();

            //array('reviews_id'=>$reviews_id,'user_id'=>$user_id)
            $Replies = Replies::where('review_id', $reviews_id)->delete();
            //array('businessreview_id'=>$reviews_id,'user_id'=>$user_id,'business_id'=>$business_id)

            $Businessreviewlikedislike =    Businessreviewlikedislike::where('businessreview_id', $reviews_id)->delete();

            //array('businessreview_id'=>$reviews_id,'user_id'=>$user_id,'business_id'=>$business_id)

            $BuinessReports = BuinessReports::where('review_id', $reviews_id)->where('user_id', $user_id)->where("business_id", $business_id)->delete();
            $result  = array("status" => true, "message" => 'Review Deleted Successfully');
        }
        echo json_encode($result);
    }

    public function getAllbusiness()
    {

        //   $data = User::where('role',99)
        $data = User::where(array('role' => 99))->whereNotNull('business_name')
            ->select(
                "users.id as business_id",
                "users.business_name"
            )
            ->get();
        if ($data) {
            $result  = array("status" => true, "message" => '', "data" => $data);
        } else {
            $result  = array("status" => False, "message" => '', "data" => '');
        }
        echo json_encode($result);
    }

    public function getfilterbusiness()
    {
        $category_data = Categorys::with('subcategory')->where('status', 0)->get();
        if (!empty($category_data)) {
            $result  = array("status" => true, "message" => '', "data" => $category_data);
        } else {
            $result  = array("status" => false, "message" => '', "data" => '');
        }
        echo json_encode($result);
    }
    public function getfaq()
    {
          $faq = Faqs::where('status',0)->get();
      
        if (!empty($faq)) {
            $result  = array("status" => true, "message" => '', "data" => $faq);
        } else {
            $result  = array("status" => false, "message" => '', "data" => '');
        }
        echo json_encode($result);
    }

    public function BusinessVisits(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'business_id' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $user_id = $request->user_id;
            $business_id = $request->business_id;
           
            $BusinessVisits = BusinessVisits::where('user_id', $user_id)->where('business_id', $business_id)->first();
            if(!empty($BusinessVisits))
            {
                $updateData= BusinessVisits::where('id',$BusinessVisits->id)->update(array('visit_count'=>$BusinessVisits->visit_count+1));
                if ($updateData) {
                    $result  = array("status" => true, "message" => 'visit updated successfully');
                } else {
                    $result  = array("status" => False, "message" => 'fails');
                }
            }
            else
            {
                $insertData =BusinessVisits::create(array('user_id'=>$request->user_id,'business_id'=>$request->business_id,'visit_count'=>1));
                if ($insertData) {
                    $result  = array("status" => true, "message" => 'visit add successfully');
                } else {
                    $result  = array("status" => False, "message" => 'fails');
                }
            }
        }
        echo json_encode($result);
    }

    public function contactus(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'country_code'=>'required',
            'phone' => 'required',
            'comment' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            
            $insertData =Contactus::create(array('user_id'=>$request->user_id,'name'=>$request->name,'email'=>$request->email,'country_code'=>$request->country_code,'phone'=>$request->phone,'comment'=>$request->comment));
            if ($insertData) {
                    $result  = array("status" => true, "message" => 'contact us added successfully');
                } else {
                    $result  = array("status" => False, "message" => 'fails');
                }
            
        }
        echo json_encode($result);
    }

    public function getabout()
    {
        $data = Aboutus::all();
        if ($data) {
            $result  = array("status" => true, "message" => '','data'=>$data);
        } else {
            $result  = array("status" => False, "message" => 'fails');
        }
        echo json_encode($result);
    }
    public function changepassword(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'old_password'=>'required',
            'password' => 'required',
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else if($request->old_password == $request->password){
            $result  = array("status" => false, "message" => 'Old passowrd and new password same');
        }else {
            $insertData =User::where('id',$request->user_id)->update(array('password'=>Hash::make($request->password)));
            if ($insertData) {
                    $result  = array("status" => true, "message" => 'change password successfully');
                } else {
                    $result  = array("status" => False, "message" => 'fails');
                }
            
        }
        echo json_encode($result);
    }
    

}    
// $data = array('gender' =>$request->gender, 'weight' =>$request->weight, 'weight_unit'=>$request->weight_unit,
// 'height'=>$request->height, 'height_unit'=>$request->height_unit, 'interest'=>$request->interest,
// 'bodyparts_work'=>$request->bodyparts_work, 'exercise'=>$request->exercise, 'length_training'=>$request->length_training,

// 'fitness_goal'=>$request->fitness_goal, 'diedt_impact'=>$request->diedt_impact);
// dd($data);