<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class SupportType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'support_form_id'
    ];

    public function supportForm() : BelongsTo
    {
        return $this->belongsTo(SupportForm::class);
    }

    public function supports(): MorphToMany
    {
        return $this->morphToMany(Support::class, 'supportable');
    }
}
