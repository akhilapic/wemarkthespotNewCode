<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table="users";
    protected $fillable =[ 'name', 'username', 'email', 'country_code', 'status', 'email_verified_at','password',   'role', 'image', 'phone','dob', 'upload_doc',  'login_check','business_type','location','business_type','lat','long','review'];
 
}
