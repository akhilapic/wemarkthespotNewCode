<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
  use HasFactory;
      protected $table="replies";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','review_id','reply_id','message','created_at','updated_at','type'
    ];

    public function user(){
      return $this->belongsTo('App\Models\User','user_id')->withDefault();
  }

 
}
