<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class Itenerary extends Component
{
    protected string $view = 'forms.components.itenerary';

    public static function make(): static
    {
        return app(static::class);
    }
}
