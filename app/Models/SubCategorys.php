<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategorys extends Model
{
  use HasFactory;
      protected $table="sub_categorys";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'short_information','image','status','detail_information','created_at','updated_at'
    ];

  
}
