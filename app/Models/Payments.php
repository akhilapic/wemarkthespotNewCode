<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
  use HasFactory;
      protected $table="payments";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id',  'plan_name','plan_price','startDate','endDate','user_id','customer_name','billing_email','billing_address','created_at','updated_at','status','country','city','zip_code','card_number','validity','cvv','save_card','transaction_id','payment_status','payment_message'
    ];  
}
