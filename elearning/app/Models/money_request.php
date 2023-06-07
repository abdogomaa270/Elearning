<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class money_request extends Model
{
    protected $table='money_requests';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
