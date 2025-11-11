<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = "contact";
    protected $fillable = [
       'employee_id','contact_type_id','contact_value','note'];
    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function Contact_Type()
    {
        return $this->belongsTo(Contact_Type::class,'id');
    }
}
