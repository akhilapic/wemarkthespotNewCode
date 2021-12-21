<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quoates extends Model
{
  use HasFactory;
      protected $table="quoates_managements";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'short_information','image','video','status','detail_information','created_at','updated_at'
    ];

  
}
