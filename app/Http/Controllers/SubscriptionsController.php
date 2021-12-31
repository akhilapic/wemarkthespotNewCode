<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriptions;

use Validator;
use App\Models\Verification;
use URL;
use Illuminate\Http\Response;
use DB;
use Hash;
use DateTime;
use Session;


class SubscriptionsController extends Controller
{
    public function index()
    {   
        $subscriptions  =  Subscriptions::orderBy('id', 'desc')->first();  //table
        // dd($subscriptions); //test
        return view('wemarkthespot.subscriptions', compact('subscriptions'));
    }


    public function oneweek(request $request){
        //Get data from post and view(payments page with user details pass on it ==> get form user table using session id) //RR
        $startDate = $request->post('startDate');
        $endDate   = $request->post('endDate');
        $amount    = $request->post('amount');

        if(empty($startDate) || empty($endDate) || empty($amount)){
            $result=array('status' => false,'message' =>"Please refresh and select a week.");
            echo json_encode($result);
            die;
        }

        $userId = Session::get('id'); //Get user Id from session
        if(!empty($userId)){
            // $userData = DB::table('users')->where('id',$userId)->first(); //Get User information using id//
            $request->session()->put('startDate', $startDate);
            $request->session()->put('endDate', $endDate);
            $request->session()->put('amount', $amount);
            $request->session()->put('planId', '1');

            $result=array('status' => true,'message' =>"Success");

        }else{
            $result=array('status' => false,'message' =>"You are not authorize!");
        }

        echo json_encode($result);
    }

    public function threeweek(request $request){
        //Get data from post and view(payments page with user details pass on it ==> get form user table using session id) //RR
        $startDate = $request->post('startDate');
        $endDate   = $request->post('endDate');
        $amount1    = $request->post('amount');

        if(empty($startDate) || empty($endDate) || empty($amount1)){
            $result=array('status' => false,'message' =>"Please refresh and select a week.");
            echo json_encode($result);
            die;
        }

        $userId = Session::get('id'); //Get user Id from session
        if(!empty($userId)){
            // $userData = DB::table('users')->where('id',$userId)->first(); //Get User information using id//
            $request->session()->put('startDate', $startDate);
            $request->session()->put('endDate', $endDate);
            $request->session()->put('amount', $amount1);
            $request->session()->put('planId', '2');

            $result=array('status' => true,'message' =>"Success");

        }else{
            $result=array('status' => false,'message' =>"You are not authorize!");
        }

        echo json_encode($result);
    }

    public function allweek(request $request){
        //Get data from post and view(payments page with user details pass on it ==> get form user table using session id) //RR
        $startDate = $request->post('startDate');
        $endDate   = $request->post('endDate');
        $amount2    = $request->post('amount');

        if(empty($startDate) || empty($endDate) || empty($amount2)){
            $result=array('status' => false,'message' =>"Please refresh and select a week.");
            echo json_encode($result);
            die;
        }

        $userId = Session::get('id'); //Get user Id from session
        if(!empty($userId)){
            // $userData = DB::table('users')->where('id',$userId)->first(); //Get User information using id//
            $request->session()->put('startDate', $startDate);
            $request->session()->put('endDate', $endDate);
            $request->session()->put('amount', $amount2);
            $request->session()->put('planId', '3');

            $result=array('status' => true,'message' =>"Success");

        }else{
            $result=array('status' => false,'message' =>"You are not authorize!");
        }

        echo json_encode($result);
    }


    public function loadSubcriptionPayment(){
        
        $userId = Session::get('id'); //Get user Id from session
        if(!empty($userId)){
            $userData = DB::table('users')->where('id',$userId)->first(); //Get User information using id//
        }

        // dd($userData);  //test
        return view('wemarkthespot.webpayment', compact('userData'));
    }


    public function submitSubcriptionPayment(request $request){
        // save all data to a new payments table //RR
        // print_r($request->all());
        $userId = Session::get('id'); //Get user Id from session
        if($userId)
        {
            $startDate      = $request->post('startDate');
            $endDate        = $request->post('endDate');
            $amount         = $request->post('amount');

            $planId         = $request->post('planId');
            $planName = "";
            if(!empty($planId)){
                if($planId == 1){
                    $planName = 'weekBusiness';
                }else if($planId == 2){
                    $planName = 'featuredBusiness';
                }else if($planId == 3){
                    $planName = 'weekAndFeatured';
                }
            }

            $customer_name  = $request->post('customer_name');
            $billing_email  = $request->post('billing_email');
            $billing_add    = $request->post('billing_add');
            $country        = $request->post('country');
            $city           = $request->post('city');
            $zip_code       = $request->post('zip_code');

            $save_checkbox = 0;
            $save_checkbox  = $request->post('save_checkbox');
            $card_number = $validity = $cvv = "";   //initialize variables//
            if(isset($save_checkbox) && !empty($save_checkbox) && $save_checkbox == 'saveTheCardValue'){
                $card_number = $request->post('card_number');
                $validity = $request->post('validity');
                $cvv = $request->post('cvv');
                $save_checkbox = 1;
            }

            $transaction_id = $payment_status = $payment_message = "";  //Temp

            $data = array(
                'plan_id'=>$planId,
                'plan_name'=>$planName,
                'plan_price'=>$amount,
                'startDate'=>$startDate,
                'endDate'=>$endDate,
                'user_id'=>$userId,
                'customer_name'=>$customer_name,
                'billing_email'=>$billing_email,
                'billing_address'=>$billing_add,
                'country'=>$country,
                'city'=>$city,
                'zip_code'=>$zip_code,
                'card_number'=>$card_number,
                'validity'=>$validity,
                'cvv'=>$cvv,
                'save_card'=>$save_checkbox,
                'transaction_id'=>isset($transaction_id)?$transaction_id:0,
                'payment_status'=>isset($payment_status)?$payment_status:0,
                'payment_message'=>isset($payment_message)?$payment_message:'',
                'status'=>isset($status)?$status:1,
                'created_at'=>date("Y-m-d h:i:s", time()),
                'updated_at'=>date("Y-m-d h:i:s", time())
            );

            $insertQuery = DB::table('payments')->insert($data);  //insert data into table
            if($insertQuery){
                $id = DB::getPdo()->lastInsertId();
                $result=array('status' => true, 'message' =>"Payment Successful", "last_id"=>$id);
            }else{
                $result=array('status' => false,'message' =>"Record not inserted.");
            }
        }else{
            //Not Authorize
            $result=array('status' => false,'message' =>"Id missing, you are not authorize!");
        }
        echo json_encode($result);
    }
    
}
