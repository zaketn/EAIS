<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function calculatorParameters() : HasMany
    {
        return $this->hasMany(CalculatorParameters::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }

    public function suggestedLinks()
    {
        return $this->hasMany(SuggestedLink::class);
    }
}
