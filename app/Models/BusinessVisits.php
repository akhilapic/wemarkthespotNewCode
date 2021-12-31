<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessVisits extends Model
{
  use HasFactory;
      protected $table="business_visits";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',  'business_id','created_at','updated_at','visit_count'
    ];  
}
