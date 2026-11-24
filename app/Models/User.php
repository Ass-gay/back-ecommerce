<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <-- 1. VÉRIFIEZ CET IMPORT

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // <-- 2. VÉRIFIEZ QUE HASAPITOKENS EST BIEN ICI

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <-- AJOUTEZ CETTE LIGNE : Autorise Laravel à écrire le rôle
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
