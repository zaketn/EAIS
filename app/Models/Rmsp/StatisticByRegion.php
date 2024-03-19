<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticByRegion extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'company_type_id',
        'date_of_support',
        'amount'
    ];
}
