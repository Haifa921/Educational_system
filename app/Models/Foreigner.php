<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foreigner extends Model
{
    use HasFactory;
    protected $table = "foreigners";
    protected $fillable = [
            'passport_number'
            ,'passport_release_date',
            'passport_valid_date',
           'security_approval_number',
            'security_approval_date',
           'security_approval_image',
           'work_approval_number',
            'work_approval_date',
            'work_approval_image',
           'employee_id',
            
           'date_created',
           'date_modified)' ];

    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
