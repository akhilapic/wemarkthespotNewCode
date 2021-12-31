<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Faqs;
class FaqsController extends Controller
{
    public function index()
    {
        $user_id = session()->get('id');
            $account = Users::where('id', $user_id)->first();
           $faq = Faqs::where('status',0)->get();

            return view('wemarkthespot.faqs',compact('account','faq'));
    }
}
