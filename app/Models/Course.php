<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = "courses";
    protected $fillable = [
            'name',
        'date_created',
            'date_modified)'];
            public function taught_courses()
            {
                return $this->hasMany(Taught_Course::class, 'course_id');
            }
}
