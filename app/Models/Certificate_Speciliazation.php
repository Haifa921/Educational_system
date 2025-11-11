<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate_Speciliazation extends Model
{
    use HasFactory;
    protected $table = "certificate_specialization";
    protected $fillable = [
       'name','date_created','date_modified)'];
    public function Certificate()
    {
        return $this->hasMany(Certificate::class);
    }
}
