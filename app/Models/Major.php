<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $table = "major";
    protected $fillable = [
       'name','note','faculty_id'];
    public function Employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function Faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
