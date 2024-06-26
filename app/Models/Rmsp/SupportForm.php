<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function supportTypes() : HasMany
    {
        return $this->hasMany(SupportType::class);
    }
}
