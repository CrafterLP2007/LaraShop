<?php

namespace App\Admin\Resources\Products\Pages;

use App\Admin\Resources\Products\ProductResource;
use App\Models\Category;
use App\Models\Extension;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Tabs::make('ProductTabs')
                ->columnSpanFull()
                ->tabs([
                    Tab::make('Configuration')
                        ->schema(components: [
                            TextInput::make('name')
                                ->required()
                                ->maxLength(50)
                                ->unique()
                                ->columnSpan('full'),
                            RichEditor::make('description')
                                ->extraAttributes(['style' => 'min-height: 200px;'])
                                ->columnSpan('full'),
                            Grid::make(2)
                                ->columnSpanFull()
                                ->schema([
                                    Grid::make(3)
                                        ->columnSpanFull()
                                        ->schema([
                                            Select::make('category_id')
                                                ->label('Category')
                                                ->options(function () {
                                                    return Category::all()->pluck('title', 'id')->filter();
                                                })
                                                ->searchable()
                                                ->nullable(),
                                            TextInput::make('order')
                                                ->required()
                                                ->numeric()
                                                ->minValue(0)
                                                ->step(1),
                                            TextInput::make('quantity')
                                                ->required()
                                                ->numeric()
                                                ->minValue(0)
                                                ->step(1),
                                        ]),
                                    Checkbox::make('active')
                                        ->label('Active')
                                        ->helperText('Uncheck to disable the product')
                                        ->default(true),
                                ]),
                        ]),
                    Tab::make('Extension')
                        ->schema([
                            Select::make('extension')
                                ->options(function () {
                                    return Extension::all()->pluck('name', 'name')->filter();
                                })
                                ->nullable()
                                ->searchable()
                                ->placeholder('None'),
                        ]),
                    Tab::make('Media')
                        ->schema([
                            Repeater::make('media')
                                ->maxItems(10)
                                ->label('Media Files')
                                ->schema([
                                    FileUpload::make('file')
                                        ->label('File')
                                        ->required(),
                                ])
                                ->columnSpan('full')
                                ->addActionLabel('Add Media File')
                        ]),
                    Tab::make('Pricing')
                        ->schema([
                            Repeater::make('pricing')
                                ->label('Pricing Tiers')
                                ->reorderable(false)
                                ->schema([
                                    // Replace with own currencies
                                    Select::make('currency')
                                        ->label('Currency')
                                        ->options([
                                            'USD' => 'USD',
                                            'EUR' => 'EUR',
                                            'GBP' => 'GBP',
                                        ])
                                        ->required()
                                        ->native(false),
                                    TextInput::make('quantity')
                                        ->label('Quantity')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->step(0.01),
                                    Select::make('user_id')
                                        ->label('User')
                                        ->nullable()
                                        ->multiple()
                                        ->placeholder('All Users')
                                        ->options(function () {
                                            return User::all()->pluck('email', 'id')->filter();
                                        })
                                        ->native(false),
                                    TextInput::make('price')
                                        ->label('Price')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->step(0.01),
                                ])
                                ->columnSpan('full')
                                ->addActionLabel('Add Pricing Tier')
                        ])
                ]),
        ]);
    }
}
