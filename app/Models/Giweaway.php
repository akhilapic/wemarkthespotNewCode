<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giweaway extends Model
{
  use HasFactory;
      protected $table="giweaways";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'business_id','description','status','created_at','updated_at'
    ];

  
}
