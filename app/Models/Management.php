<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Management extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'managements'; // Specify the table name for your admins
    protected $primaryKey = 'id'; // Specify the primary key for your admins table

    protected $fillable = [
        'email',
        'password',
    ];
}
