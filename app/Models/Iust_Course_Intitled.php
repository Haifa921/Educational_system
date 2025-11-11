<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iust_Course_Intitled extends Model
{
    use HasFactory;

    protected $table = "iust_courses_intitled_to_teach";
    protected $fillable = [
        'employee_id',
            'iust_course_id',
           'ministerial_resolution_number',
            'being_taught_now',
            'note',
        'date_created',
            'release-date)'];
            public function iust_course()
            {
                return $this->belongsTo(Iust_Course::class, 'iust_course_id');
            }
        
            public function employee()
            {
                return $this->belongsTo(Employee::class, 'employee_id');
            }
}
