<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Hotspots;
use App\Models\BusinessReviews;
use App\Models\Replies;
class HotspotUpdatesController extends Controller
{
    
    public function index()
    {
        $id =Session::get('id');
        $Hotspots  = Hotspots::where('business_id',$id)->get();
       $total_checkin_count  =BusinessReviews::where('business_id',$id)->where('check_status',1)->count();
    
        $hotspot=array();

         $tree1 = function ($replies_reviews, $reply_id = 0) use (&$tree1) {
                $branch = array();
                foreach ($replies_reviews as $element) {

                    if ($element['reply_id'] == $reply_id) {

                        $children = $tree1($replies_reviews, $element['id']);
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
      
        foreach ($Hotspots as $key => $value) {
              $data = Replies::with('user:id,name,image')->where('review_id', $value->id)->where('type',"HOTSPOT")->get();
              // dd($data);
              if(count($data)){
                 $tree = $tree1($data);
                  array_push($hotspot, $tree);
              }
        }
            return view('wemarkthespot.hotspot-updates',compact('hotspot','total_checkin_count'));
    }

        function trees($replies_reviews, $reply_id = 0)  {
                $branch = array();
                foreach ($replies_reviews as $element) {

                    if ($element['reply_id'] == $reply_id) {

                        $children = $trees($replies_reviews, $element['id']);
                        if ($children) {
                            $element['children'] = $children;
                        } else {
                            $element['children'] = [];
                        }
                        $branch[] = $element;
                    }
                }

                return $branch;
            }
}
