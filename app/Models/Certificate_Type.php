<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate_Type extends Model
{
    use HasFactory;
    protected $table = "certificate_type";
    protected $fillable = [
       'name','note'];
    public function Certificate()
    {
        return $this->hasMany(Certificate::class);
    }
}
