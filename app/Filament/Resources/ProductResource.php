<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Size;
use Filament\Tables;
use App\Models\Color;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Product Manamgent';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('product_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('main_image')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('other_image')
                    ->multiple()
                    ->image(),
                Forms\Components\Repeater::make('colors')
                    ->schema([
                        Forms\Components\Select::make('colors')
                            ->label('Colors')
                            ->options(Color::all()->pluck('name', 'id'))
                            ->required(),
                    ]),
                Forms\Components\Repeater::make('sizes')
                    ->schema([
                        Forms\Components\Select::make('sizes')
                            ->label('Sizes')
                            ->options(Size::all()->pluck('name', 'id'))
                            ->required(),
                        Forms\Components\TextInput::make('quantity')
                            ->label('quantity')
                            ->required(),
                    ])
                    ->columns(2),
                // Forms\Components\TextInput::make('colors'),
                // Forms\Components\Select::make('sizes')
                //     ->label('Sizes')
                //     ->options(Size::all()->pluck('name', 'id'))
                //     ->searchable()
                //     ->multiple()
                //     ->required(),
                // Forms\Components\Select::make('colors')
                //     ->label('Colors')
                //     ->options(Color::all()->pluck('name', 'id'))
                //     ->searchable()
                //     ->multiple()
                //     ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₱'),
                Forms\Components\TextInput::make('stocks')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\Toggle::make('is_visible')
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('main_image'),
                Tables\Columns\ImageColumn::make('other_image'),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stocks')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
