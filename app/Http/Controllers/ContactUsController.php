<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Contactus;
use DB;
class ContactUsController extends Controller
{
    public function index()
    {
        $user_id = session()->get('id');
        $account = Users::where('id', $user_id)->first();
        $country_codedata  = DB::table('country_codes')->get();

         return view('wemarkthespot.contact-us',compact('account','country_codedata'));
    }
    public function contactus(Request $request)
    {
        if($request->all())
        {
            $user_id = session()->get('id');

            $checked = Contactus::create(array('user_id'=>$user_id,'email'=>$request->email,'name'=>$request->name,'phone'=>$request->phone,'comment'=>$request->comment,'country_code'=>$request->country_code));
                if ($checked) {
                    $result = array("status" => true, 'message' => "Contact us added successfully.");
                } else {
                    $result = array("status" => false, 'message' => "Contact us added failed.");
                }
            echo json_encode($result);
        }
    }
}
