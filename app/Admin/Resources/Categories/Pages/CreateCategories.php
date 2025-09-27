<?php

namespace App\Admin\Resources\Categories\Pages;

use App\Admin\Resources\Categories\CategoriesResource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CreateCategories extends CreateRecord
{
    protected static string $resource = CategoriesResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->label('Category Title')
                ->helperText('Enter the title for this category')
                ->required()
                ->unique()
                ->columnSpanFull()
                ->reactive()
                ->debounce(500)
                ->afterStateUpdated(function ($state, callable $set) {
                    if (!empty($state)) {
                        $set('slug', Str::slug($state));
                    } else {
                        $set('slug', '');
                    }
                }),

            Textarea::make('description')
                ->label('Category Description')
                ->helperText('Enter a description for this category')
                ->rows(3)
                ->columnSpanFull(),

            Grid::make(3)
                ->columnSpanFull()
                ->schema([
                    Select::make('parent_id')
                        ->label('Parent Category')
                        ->helperText('Select a parent category if applicable')
                        ->options(function () {
                            return CategoriesResource::getModel()::pluck('title', 'id');
                        })
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->columnSpan(1)
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $parent = CategoriesResource::getModel()::where('id', $state)->first();
                            if ($parent) {
                                $childrenCount = $parent->children()->count();
                                $set('order', $childrenCount + 1);
                            } else {
                                $set('order', 1);
                            }
                        }),

                    TextInput::make('order')
                        ->label('Order')
                        ->helperText('Set the display order for this category')
                        ->numeric()
                        ->required()
                        ->default(1),

                    TextInput::make('slug')
                        ->label('Category Slug')
                        ->helperText('Enter a URL-friendly slug for this category')
                        ->required()
                        ->unique()
                        ->columnSpan(1)
                        ->regex('/^[a-zA-Z0-9\-_.]+$/'),

                    Checkbox::make('active')
                        ->label('Active')
                        ->default(true)
                        ->columnSpan(1),
                ]),
        ]);
    }
}
