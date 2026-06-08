<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'mdlhpdl_course_categories';

    public $timestamps = false;

    protected $guarded = [];

    public function courses()
    {
        return $this->hasMany(Course::class, 'category', 'id');
    }
}
