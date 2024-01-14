<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'notefication_id',
    //     'read',
    // ];

    public function notefication_read(){
        return $this->hasMany(notefication_read::class);
    }
    
}
