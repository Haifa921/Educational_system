<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palastinians extends Model
{
    use HasFactory;
    protected $table = "palestinians";
    protected $fillable = [
      'family_card_number',
           'origin_place',
            'date_created',
            'date_modified)',
            'employee_id',
];
public function employee()
{
    return $this->belongsTo(Employee::class, 'employee_id');
}

   
}
