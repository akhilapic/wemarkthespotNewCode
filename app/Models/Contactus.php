<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
  use HasFactory;
      protected $table="contact_us";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','email','user_id','status','phone','created_at','updated_at','comment','country_code'
    ];

  

  
}
