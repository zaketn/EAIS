<?php

namespace App\Models\Tables;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TableValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'table_id',
        'table_column_id',
        'table_row_id'
    ];

    public function table() : BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function row() : BelongsTo
    {
        return $this->belongsTo(TableRow::class);
    }

    public function column() : BelongsTo
    {
        return $this->belongsTo(TableColumn::class);
    }
}
