<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability_type extends Model
{
    use HasFactory;
    protected $table = "availability_type";
    protected $fillable = [
        'name', 'hours_count','date_created','date_modified' ];

    public function Employees()
    {
        return $this->hasMany(Employee::class);
    }
}
