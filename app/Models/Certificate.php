<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $table = "certificate";
    protected $fillable = [
       'name','certificate_type_id',
       'employee_id','specializaion_id',
       'country_id','thesis_title',
       'certificate_file','release-date',
       'description','company','date_created','date_modified)'];
    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function Certificate_Type()
    {
        return $this->belongsTo(Certificate_Type::class,'id');
    }
    public function Certificate_Speciliazation()
    {
        return $this->belongsTo(Certificate_Speciliazation::class,'id');
    }
    public function Certificate_Country()
    {
        return $this->belongsTo(Certificate_Country::class,'id');
    }
}
