<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iust_Course extends Model
{
    use HasFactory;
    protected $table = "iust_courses";
    protected $fillable = [
        'name',
        'note',
       'date_created',
       'date_modified)'];
       public function iust_course_intitled()
    {
        return $this->hasMany(Iust_Course_Intitled::class, 'iust_course_id');
    }
}
