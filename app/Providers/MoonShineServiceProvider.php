<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CalculatorParametersResource;
use App\MoonShine\Resources\CalculatorParameterTypesResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make('Калькулятор', [
                MenuItem::make('Параметры калькулятора', new CalculatorParametersResource()),
                MenuItem::make('Типы параметров калькулятора', new CalculatorParameterTypesResource())
            ])->icon('heroicons.calculator'),

            MenuItem::make(
                'Пользователи',
                new MoonShineUserResource()
            ),
            MenuItem::make(
                static fn() => __('moonshine::ui.resource.role_title'),
                new MoonShineUserRoleResource()
            ),

            MenuItem::make('Документация', 'https://moonshine-laravel.com', blank: true),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
