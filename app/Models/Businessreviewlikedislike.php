<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Businessreviewlikedislike extends Model
{
  use HasFactory;
      protected $table="businessreview_likedislike";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
          'businessreview_id','user_id','likedislike','created_at','updated_at'
    ];

  
}
