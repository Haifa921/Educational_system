<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Statu extends Model
{
    use HasFactory;
    protected $table = "employee_status";
    protected $fillable = [
        'name','date_created', 'date_modified)' ];

    public function Employees()
    {
        return $this->hasMany(Employee::class,'status_id');
    }
}
