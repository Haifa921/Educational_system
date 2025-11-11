<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_Type extends Model
{
    use HasFactory;
    protected $table = "contact_type";
    protected $fillable = [
            'type_value',
        'note'];
    public function Contact()
    {
        return $this->hasMany(Contact::class,'contact_type_id');
    }
}
