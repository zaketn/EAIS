<?php

namespace App\Models\Tables;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'actuality',
    ];

    public function columns(): HasMany
    {
        return $this->hasMany(TableColumn::class);
    }

    public function rows(): HasMany
    {
        return $this->hasMany(TableRow::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(TableValue::class);
    }
}
