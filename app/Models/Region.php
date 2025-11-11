<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table = "region";
    protected $fillable = [
       'name','note','city_id'];
       public function employees()  // Change from Employees() to employees()
       {
           return $this->hasMany(Employee::class);
       }
    public function City()
    {
        return $this->belongsTo(City::class);
    }
}
