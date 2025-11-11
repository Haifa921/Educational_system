<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $fillable = [ 
    'first_name',
    'last_name',
    'mother_name',
    'father_name',
    'national_number',
    'nationality',
    'birth_date',
    'birth_place',
    'personal_image',
    'id_image',
    'gender',
    'general_specialization',
    'detailed_specialization', 
    'scientific_rank',
    'scientific_rank_obtaining_date',
   'affiliated_government_agency',
   'is_contracted',
   'availability_days_count',
    'availability_hours_count',
    'work_id',
    'region_id',
    
    'major_id',
    'position_id',
    'status_id',
];
    public function Position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function life_event()
    {
        return $this->hasMany(Life_Event::class);
    }
    public function Status()
    {
        return $this->belongsTo(Employee_Statu::class,'employee_statu_id');
    }
    public function Availability_type()
    {
        return $this->belongsTo(Availability_type::class);
    }
    
    public function Region()
    {
        return $this->belongsTo(Region::class);
    }
    public function Foreigner()
    {
        return $this->hasOne(Foreigner::class);
    }
    public function Iust_Course_Intitled()
    {
        return $this->hasMany(Iust_Course_Intitled::class);
    }
    public function Taught_Course()
    {
        return $this->hasMany(Taught_Course::class);
    }
    
    public function Contact()
    {
        return $this->hasMany(Contact::class);
    }
    
    public function Certificate()
    {
        return $this->hasMany(Certificate::class);
    }
    public function Palastinians()
    {
        return $this->hasMany(Palastinians::class);
    }
    public function Major()
    {
        return $this->belongsTo(Major::class);
    }
  

}
