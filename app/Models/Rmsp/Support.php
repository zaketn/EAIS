<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_unit_type_id',
        'company_type_id',
        'date',
        'amount',
        'imported_file_id'
    ];

    public function companyType(): BelongsTo
    {
        return $this->belongsTo(CompanyType::class);
    }

    public function supportUnitType(): BelongsTo
    {
        return $this->belongsTo(SupportUnitType::class);
    }

    public function regions(): MorphToMany
    {
        return $this->morphedByMany(Region::class, 'supportable');
    }

    public function supportTypes(): MorphToMany
    {
        return $this->morphedByMany(SupportType::class, 'supportable');
    }

    public function importedFile(): BelongsTo
    {
        return $this->belongsTo(ImportedFile::class);
    }
}
