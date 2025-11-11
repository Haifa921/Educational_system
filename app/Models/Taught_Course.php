<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taught_Course extends Model
{
    use HasFactory;
    protected $table = "taught_courses";
    protected $fillable = [
        'employee_id',
     'course_id',
     'university_id',
            'note',
        'date_created',
            'date_modified)'];
            public function employee()
            {
                return $this->belongsTo(Employee::class, 'employee_id');
            }
        
            public function course()
            {
                return $this->belongsTo(Course::class, 'course_id');
            }
        
            public function university()
            {
                return $this->belongsTo(University::class, 'university_id');
            }
}
