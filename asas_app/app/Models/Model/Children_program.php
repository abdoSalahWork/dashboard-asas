<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children_program extends Model
{
    use HasFactory;
   protected $table="children_programs";
   protected $fillable = [
    'id_reservation_statuses',
   
];
}
