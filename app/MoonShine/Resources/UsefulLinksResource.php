<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\UsefulLinks;

use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Text;
use MoonShine\Fields\Url;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<UsefulLinks>
 */
class UsefulLinksResource extends ModelResource
{
    protected string $model = UsefulLinks::class;

    protected string $title = 'Полезные ссылки';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Название', 'name'),
                Text::make('Описание', 'description'),
                Url::make('Ссылка', 'url'),
                Checkbox::make('Черновик', 'draft')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
