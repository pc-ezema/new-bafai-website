<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    // Specify the correct table name
    protected $table = 'mdlhpdl_course';
    
    // Disable Laravel's default timestamps (your table uses timecreated/timemodified)
    public $timestamps = false;
    
    // Define which fields are mass assignable (if needed)
    protected $guarded = [];
    
    // Cast dates to Carbon instances
    protected $casts = [
        'startdate' => 'datetime',
        'enddate' => 'datetime',
        'timecreated' => 'datetime',
        'timemodified' => 'datetime',
    ];
    
    // Scope for visible courses
    public function scopeVisible($query)
    {
        return $query->where('mdlhpdl_course.visible', 1);
    }
    
    // Relationship to course category (optional – you can also use joins)
    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category', 'id');
    }
    
    // Accessor to get the category name (uses a join or the eager loaded relation)
    // This is only useful if you eager load ->with('category')
    public function getCategoryNameAttribute()
    {
        return $this->category->name ?? 'Uncategorized';
    }
    
    // Accessor to get the course image URL from Moodle files
    // This assumes you have a 'course_image' property set from a join
    public function getImageUrlAttribute()
    {
        if (isset($this->image_hash) && isset($this->image_filename)) {
            // Route to serve Moodle files
            return route('moodle.file', [
                'hash' => $this->image_hash,
                'filename' => $this->image_filename
            ]);
        }
        // Default placeholder image
        return asset('assets/img/course-placeholder.jpg');
    }
}
