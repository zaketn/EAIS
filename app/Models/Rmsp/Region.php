<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'district_id'
    ];

    public function district() : BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function supports(): MorphToMany
    {
        return $this->morphToMany(Support::class, 'supportable');
    }

    public function scopeFiltered(Builder $query)
    {
        return $query->when(
            request('district'),
            fn(Builder $query, array $district) => $query->where('district_id', $district['id'])
        );
    }
}
