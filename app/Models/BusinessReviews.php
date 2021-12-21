<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessReviews extends Model
{
  use HasFactory;
      protected $table="business_reviews";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',  'business_id','ratting','review','status','image','created_at','updated_at', 'tag', 'type', 'check_status'
    ];

    public function user(){
      return $this->belongsTo('App\Models\User','business_id')->withDefault();
  }
 
  public function userRole(){
    return $this->belongsTo('App\Models\User','user_id')->withDefault();
}

}
