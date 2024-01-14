<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Father as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Father extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = ['name','email','phone','password','id_country','id_city','facebook_id','google_id','device_token'];

}
