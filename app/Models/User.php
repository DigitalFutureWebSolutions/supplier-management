<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Optional: Override the method to use username for authentication
    public function username()
    {
        return 'username'; // Use 'email' if you prefer email for login
    }
}
