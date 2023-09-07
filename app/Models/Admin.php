<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
class Admin extends User
{
    use HasFactory , Notifiable  ;


    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'super_admin', 'status',
    ];
}
