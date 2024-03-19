<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
