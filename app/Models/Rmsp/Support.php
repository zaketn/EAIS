<?php

namespace App\Models\Rmsp;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFiltered(Builder $query)
    {
        $query
            ->with(['companyType.ownerType', 'supportUnitType', 'supportTypes', 'regions.district'])
            ->when(request('year'), function (Builder $query, string $year) {
                return $query->whereYear('date', $year);
            })
            ->when(request('companyType'), function (Builder $query, array $companyType) {
                return $query->where('company_type_id', (int)$companyType['id']);
            })
            ->when(request('supportType'), function (Builder $query, array $supportType) {
                return $query->whereHas('supportTypes', function (Builder $query) use ($supportType) {
                    return $query->where('id', $supportType['id']);
                });
            })
            ->when(request('supportForm'), function (Builder $query, array $supportForm) {
                return $query->whereHas('supportTypes', function (Builder $query) use ($supportForm) {
                    return $query->where('support_form_id', $supportForm['id']);
                });
            })
            ->when(request('unitType'), function (Builder $query, array $unitType) {
                return $query->where('support_unit_type_id', $unitType['id']);
            })
            ->when(request('district'), function (Builder $query, array $district) {
                return $query->whereHas('regions', fn(Builder $query) => $query->where('district_id', $district['id'])
                    ->when(request('region'), fn(Builder $query, array $region) => $query->where('regions.id', $region['id']))
                );
            })
            ->when(request('region') && !request('district'), function (Builder $query) {
                return $query->whereHas('regions', function (Builder $query) {
                    $query->where('regions.id', request('region')['id']);
                });
            });
    }
}
