<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class CompanyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_type_id'
    ];

    public function ownerType() :BelongsTo
    {
        return $this->belongsTo(OwnerType::class);
    }

    public function supports() : HasMany
    {
        return $this->hasMany(Support::class);
    }
}
