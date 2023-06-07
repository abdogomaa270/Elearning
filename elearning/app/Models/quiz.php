<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    protected $table='quizzes';
//    protected $fillable = [
//        'options',
//
//
//    ];
    use HasFactory;
}
