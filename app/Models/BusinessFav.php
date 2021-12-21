<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessFav extends Model
{
  use HasFactory;
      protected $table="business_fav";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',  'business_id', 'fav','created_at','updated_at'
    ];

}
