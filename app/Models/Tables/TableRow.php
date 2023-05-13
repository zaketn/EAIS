<?php

namespace App\Models\Tables;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TableRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'parent_row_id',
        'table_id',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function parentRow(): BelongsTo
    {
        return $this->belongsTo(TableRow::class, 'parent_row_id', 'id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(TableValue::class);
    }
}
