<?php

namespace App\Actions\Statistics;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EntitySupportsCountAction
{
    public function __invoke(Builder $model, ?string $year) : Collection
    {
        if($year !== null) {
            $model->withCount([
                'supports' => fn(Builder $query) => $query->whereYear('date', $year)
            ]);
        } else {
            $model = $model->withCount('supports');
        }

        return $model->get();
    }
}
