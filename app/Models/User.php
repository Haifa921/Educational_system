<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  //  use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    protected $fillable = [
        'name', 'email', 'password', 'role_name'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

protected $casts = [
    'email_verified_at' => 'datetime',
    'role_name' => 'string'
];
public function isProfessor(): bool
{
    return $this->role_name === 'professor';
}

public function isAdmin(): bool
{
    return $this->role_name === 'admin';
}

public function isDepartmentHead(): bool
{
    return $this->role_name === 'department_head';
}
}
