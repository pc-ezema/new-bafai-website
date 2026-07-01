<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorshipApplication extends Model
{
    // Define which fields are mass assignable (if needed)
    protected $guarded = [];

    protected $casts = [
        'consent' => 'boolean',
        'student_count' => 'integer',
    ];
}
