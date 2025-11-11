<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate_Country extends Model
{
    use HasFactory;
    protected $table = "certificate_country";
    protected $fillable = [
       'name','note'];
    public function Certificate()
    {
        return $this->hasMany(Certificate::class);
    }
}
