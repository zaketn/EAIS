<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'district_id'
    ];

    public function supports(): MorphToMany
    {
        return $this->morphToMany(Support::class, 'supportable');
    }
}
