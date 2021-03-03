<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_profile extends Model
{
    use HasFactory;

    public function author()
    {
        $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        $this->belongsTo(Course::class, 'course_id');
    }

    public function presences()
    {
        $this->hasMany(Presence::class);
    }
}
