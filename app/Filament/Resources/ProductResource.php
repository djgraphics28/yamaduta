<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Product Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Main Product Details')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('sku')
                            ->label('SKU')
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
                    ])->columns(2),
                Forms\Components\Section::make('Add Child Product')
                    ->schema([
                        Forms\Components\Repeater::make('child_products')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('parent_sku')
                                ->label('Parent Sku')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('child_sku')
                                ->label('Child Sku')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('name')
                                ->label('Child Product Name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('size')
                                ->label('Size')
                                ->required(),
                            Forms\Components\TextInput::make('color')
                                ->label('Color'),
                            Forms\Components\TextInput::make('price')
                                ->label('Price')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('stocks')
                                ->label('Stocks')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->columns(7),
                    ]),
                Forms\Components\Section::make('Other Data')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('₱'),
                        Forms\Components\TextInput::make('old_price')
                            ->numeric()
                            ->prefix('₱'),
                        Forms\Components\TextInput::make('total_stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                        Forms\Components\Toggle::make('is_visible')
                            ->required(),
                        Forms\Components\Toggle::make('is_featured')
                            ->required(),
                    ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('main_image'),
                Tables\Columns\TextColumn::make('price')
                    ->money('php')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_stock')
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
