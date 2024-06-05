<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsefulLinks extends Model
{
    use HasFactory;

    protected $table = 'useful_links';

    protected $fillable = [
        'name',
        'description',
        'url',
        'draft'
    ];

    protected $casts = [
        'draft' => 'boolean'
    ];
}
