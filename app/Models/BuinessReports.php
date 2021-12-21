<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuinessReports extends Model
{
  use HasFactory;
      protected $table="business_reports";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','business_id','review_id','report_status','report_delete','status','created_at','updated_at'
    ];

  

  
}
