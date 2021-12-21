<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessReviews;
use App\Models\Replies;
use App\Models\Businessreviewlikedislike;
use App\Models\User;
use App\Models\BuinessReports;
use Session;
use Validator;
class CommunityReviewsController extends Controller
{
    public function index()
    {
        $business_id =Session::get('id');
        $BusinessReviews  = BusinessReviews::where('business_id',$business_id)->get();
       // dd($BusinessReviews);
         $BusinessReview1=array();
 
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
             
          
         foreach ($BusinessReviews as $key => $value) {
               $data = Replies::with('user:id,name,image')->where('review_id', $value->id)->where('type',"REVIEW")->get();

               if(count($data)){
                  $value->replies = $tree($data);
                   $userData = User::where('id',$value->user_id)->first(); 
                 $value->user_name = $userData->name;
                 $value->user_image = $userData->image;
                 
                 $like=0;
                 $dislike=0;

                 $business_reviewlikeData = Businessreviewlikedislike::where('businessreview_id', $value->id)->get();
           
                 if (isset($business_reviewlikeData)) {
                     foreach ($business_reviewlikeData as $reviewlikedislike) {
                        
                         if ($reviewlikedislike->likedislike == 1) {
                             $like += 1;
                         } else {
                             $dislike += 1;
                         }
                     }
                 }
                 $value->total_like = $like;
                 $value->total_dislike = $dislike;
                   array_push($BusinessReview1, $value);
               }
         }
        // dd($BusinessReview1);
         return view('wemarkthespot.community-reviews',compact('BusinessReview1'));
    }
    public function index1()
    {
         $business_id =Session::get('id');
        $BusinessReviews = BusinessReviews::where('business_id', $business_id)->get();
        
        foreach($BusinessReviews as $breview)
        {

        }
        

        $data = Replies::with('user:id,name,image')->where('review_id', $business_id)->where('type',"REVIEW")->get();
       


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
        $like=0;
        $dislike=0;
        $tree = $tree($data);
        foreach($tree as $t)
        {
            $business_reviewlikeData = Businessreviewlikedislike::where('businessreview_id', $t->id)->get();
           
            if (isset($business_reviewlikeData)) {
                foreach ($business_reviewlikeData as $reviewlikedislike) {
                   
                    if ($reviewlikedislike->likedislike == 1) {
                        $like += 1;
                    } else {
                        $dislike += 1;
                    }
                }
            }
        }

        $tree[0]['total_like'] = $like;
        $tree[0]['total_dislike'] = $dislike;
        return view('wemarkthespot.community-reviews',compact('tree'));
    }

    public function communutyReplies(Request $request)
    {
        $Validation = Validator::make($request->all(), [
          
            'message' => 'required'
        ]);

        if ($Validation->fails()) {
            $result = array('status' => false, 'message' => 'validate Failed.', 'error' => $Validation->errors());
        } else {
            $business_id =Session::get('id');
            if ($request->type == 'REVIEW') {
                $data = array(
                    'user_id' => $business_id,
                    'review_id' => $request->review_id,
                    'reply_id' => $request->reply_id,
                    'type' => 'REVIEW',
                    'message' => $request->message,
                    'updated_at' => date("Y-m-d h:i:s", time()),
                    'created_at' => date("Y-m-d h:i:s", time())
                );
              //  dd($data);
                $inserted = Replies::create($data);
                if ($inserted) {
                    $result = array("status" => true, 'message' => "Replies added successfully", 'record_count' => 1);
                } else {
                    $result = array("status" => false, 'message' => "Replies added Failed", 'record_count' => 0);
                }
            }  else {
                $result = array("status" => false, 'message' => "Something Went Wrong");
            }
        }
        echo json_encode($result);
    }

    public function community_reportweb($business_id,$review_id)
    {
        if((!empty($business_id) && (!empty($review_id))))
        {
            $business_id =Session::get('id');
            $data = BuinessReports::create(array('user_id' => $business_id, 'business_id' => $business_id, 'review_id' => $review_id));
            if($data)
            {
                return redirect()->to('community-reviews');
            }
        }

    }
}
