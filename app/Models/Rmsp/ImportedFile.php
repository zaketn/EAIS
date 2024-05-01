<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImportedFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type'
    ];

    public function supports() : HasMany
    {
        return $this->hasMany(Support::class);
    }
}
