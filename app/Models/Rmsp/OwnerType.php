<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OwnerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function companies() :HasMany
    {
        return $this->hasMany(OwnerType::class);
    }
}
