<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='sub_categories';
    use HasFactory;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
