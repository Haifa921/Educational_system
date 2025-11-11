<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = "city";
    protected $fillable = [
       'name','note'];
       public function regions()  // Change from Region() to regions()
       {
           return $this->hasMany(Region::class);
       }
}
