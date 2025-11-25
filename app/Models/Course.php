<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_id';
    protected $fillable = [
        'title',
        'description',
        'section_id',
        'user_id',
        'prerequisite_id',
    ];

    //Relaciones
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'section_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prerequisite()
    {
        return $this->belongsTo(Course::class, 'prerequisite_id', 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'course_id');
    }

}


