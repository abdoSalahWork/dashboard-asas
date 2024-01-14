<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notefication_read extends Model
{
    use HasFactory;
    

    public function notefication(){
        return $this->belongsTo(notefication::class);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }
}
