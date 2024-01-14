<?php

namespace App\Models\Model;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\user as Authenticatable;
// use Illuminate\Foundation\Auth\facility_owner as Authenticatable;


use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class facility_owner extends Authenticatable
{
    
    
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = ['name','name_corporation','phone','password','device_token','facebook_id','google_id','name_corporation_ar'];
}
