<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalculatorParameters extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'calculator_parameter_types_id',
        'user_id'
    ];

    public function type() : BelongsTo
    {
        return $this->belongsTo(CalculatorParameterTypes::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
