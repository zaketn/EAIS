<?php

namespace App\Models;

use App\Casts\JsonWithoutSlashes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $fillable = [
        'user_id',
        'variables'
    ];
    protected $casts = [
        'variables' => JsonWithoutSlashes::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
