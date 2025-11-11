<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Life_Event extends Model
{
    use HasFactory;
    protected $table = "life_events";
    protected $fillable = [
        'date', 'employee_id','event_id','description','note' ];

    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
    
    public function Event()
    {
        return $this->belongsTo(Event::class);
    }
}
