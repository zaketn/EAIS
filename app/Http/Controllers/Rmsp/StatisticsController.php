<?php

namespace App\Http\Controllers\Rmsp;

use App\Actions\Statistics\EntitySupportsCountAction;
use App\Http\Controllers\Controller;
use App\Models\Rmsp\CompanyType;
use App\Models\Rmsp\Region;
use App\Models\Rmsp\Support;
use App\Models\Rmsp\SupportUnitType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StatisticsController extends Controller
{
    public function getYears()
    {
        return Support::query()->select('date')
            ->distinct()
            ->get()
            ->pluck('date')
            ->map(fn(string $date) => Carbon::parse($date)->format('Y'))
            ->unique();
    }

    public function byRegions(Request $request, EntitySupportsCountAction $entitySupportsCountAction) : Collection
    {
        $request->validate([
            'year' => 'nullable|integer'
        ]);

        return $entitySupportsCountAction(Region::query(), $request->post('year'));
    }

    public function byCompanyType(Request $request, EntitySupportsCountAction $entitySupportsCountAction) : Collection
    {
        $request->validate([
            'year' => 'nullable|integer'
        ]);

        $companyTypes = CompanyType::query()->with('ownerType');

        $year = $request->post('year');

        if($year !== null) {
            $companyTypes = $companyTypes->withCount([
                'supports' => fn(Builder $query) => $query->whereYear('date', $year)
            ])->get();
        } else {
            $companyTypes = $companyTypes->withCount('supports')->get();
        }

        return $companyTypes->groupBy(fn($item) => $item->ownerType->name ?? 'Самозанятые');
    }

    public function bySupportType(Request $request) : array
    {
        $supports = SupportUnitType::query()
            ->where('id', '!=', 1);

        $year = $request->post('year');

        $companyTypes = [
            'Микропредприятия',
            'Малые предприятия',
            'Средние предприятия',
            'Самозанятые'
        ];

        $result = [];

        foreach($companyTypes as $companyType) {
            if($year !== null) {
                $result[$companyType] = $supports->withCount([
                    'supports' => function(Builder $query) use($companyType, $year) {
                        $query->whereYear('date', $year)
                            ->whereHas('companyType', fn(Builder $query) => $query->where('name', $companyType));
                    }
                ])->get();
            } else {
                $result[$companyType] = $supports->withCount([
                    'supports' => function(Builder $query) use($companyType, $year) {
                        $query->whereHas('companyType', fn(Builder $query) => $query->where('name', $companyType));
                    }
                ])->get();
            }
        }

        return $result;
    }
}
