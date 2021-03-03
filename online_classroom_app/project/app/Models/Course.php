<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course_profiles()
    {
        return $this->hasMany(Course_profile::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
