<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessReviews;
use App\Models\BusinessVisits;
class ReportManagementController extends Controller
{
    public function index()
    {
        $business_id = session()->get('id');
     
        $totalCheckin=    BusinessReviews::where(["business_id"=>$business_id,'check_status'=>1,'type'=>"CHECK_IN"])->count();
        $OverallRating = number_format(BusinessReviews::where(["business_id"=>$business_id])->avg('ratting'),2);

        $BusinessVisits = BusinessVisits::where(["business_id"=>$business_id])->sum('visit_count');

        return view('wemarkthespot.report-management',compact('totalCheckin','OverallRating','BusinessVisits'));
    }
}
