<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotspots extends Model
{
  use HasFactory;
      protected $table="hotspots";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
          'business_id','user_id','message','reply','created_at','updated_at'
    ];

  
}
