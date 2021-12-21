<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
  use HasFactory;
      protected $table="categorys";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'short_information','image','status','detail_information','created_at','updated_at'
    ];

    function user(){
       $this->hasMany('App\Models\User','business_category','id');
    }

  
}
