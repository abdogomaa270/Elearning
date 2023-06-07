<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function instructor()
    {
        return $this->belongsTo(instructor::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }

    public function quiz()
    {
        return $this->hasMany(quiz::class);
    }
    public function certificates()
    {
        return $this->hasMany(Certificate::class)->with('user');
    }

    use HasFactory;
}
