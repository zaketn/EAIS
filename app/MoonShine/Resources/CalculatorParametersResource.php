<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\CalculatorParameters;

use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<CalculatorParameters>
 */
class CalculatorParametersResource extends ModelResource
{
    protected string $model = CalculatorParameters::class;

    protected string $title = 'Параметры калькулятора';

    protected string $column = 'name';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Название', 'name'),
                Number::make('Значение', 'value'),
                BelongsTo::make('Тип параметра', 'type', resource: new CalculatorParameterTypesResource())
                    ->hideOnIndex(),
//                BelongsTo::make('Пользователь', 'user_id')->nullable()
            ]),
        ];
    }

    /**
     * @param CalculatorParameters $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
