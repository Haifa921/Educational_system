<?php
// app/Models/University.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use HasFactory;
    //SoftDeletes;

    protected $table = "universities";
    
    protected $fillable = [
        'name',
        'date_created',
        'date_modified)'
    ];

    // Fix: Add proper date casting
    protected $casts = [
        'date_created' => 'datetime',
        'date_modified)' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        
    ];
    
    // Alternative if above doesn't work, use this:
    // protected $dates = [
    //     'date_created',
    //     'date_modified)',
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    public function taughtCourses()
    {
        return $this->hasMany(Taught_Course::class);
    }
}