<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Order Details')
                        ->schema([
                            Forms\Components\TextInput::make('or_number')
                                ->label('OR #')
                                ->default('OR-' . random_int(100000, 9999999))
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                            Forms\Components\Select::make('customer_id')
                                ->relationship('customer', 'first_name')
                                ->searchable()
                                ->required(),
                            Forms\Components\Select::make('payment_method')
                                ->label('Payment Method')
                                ->default('Cash')
                                ->options([
                                    'Cash' => 'Cash',
                                    'E-Wallet' => 'E-Wallet',
                                    'Bank Transfer' => 'Bank Transfer',
                                    'Cash on Delivery' => 'Cash on Delivery',
                                ])
                                ->required(),
                            Forms\Components\Select::make('payment_status')
                                ->label('Payment Status')
                                ->default('unpaid')
                                ->options([
                                    'unpaid' => 'Unpaid',
                                    'paid' => 'Paid',
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('delivery_address')
                                ->maxLength(255),
                            Forms\Components\TextInput::make('contact_number')
                                ->maxLength(255),
                            Forms\Components\Toggle::make('is_deliverable'),
                        ])->columns(2),
                    Forms\Components\Wizard\Step::make('Order Items')
                        ->schema([

                        ]),
                ])->columnSpanFull()


                // Forms\Components\Section::make('Insert Products')
                //     ->schema([
                //         Forms\Components\Repeater::make('order_items')
                //         ->relationship()
                //         ->schema([
                //             Forms\Components\Select::make('order_items.product_id')
                //                 // ->relationship()
                //                 ->label('Select Product')
                //                 ->required(),

                //         ])
                //         ->columns(7),
                //     ]),
                // Forms\Components\Select::make('customer_id')
                //     ->relationship('customer', 'id')
                //     ->required(),
                // Forms\Components\TextInput::make('payment_method')
                //     ->required()
                //     ->maxLength(255)
                //     ->default('Cash'),
                // Forms\Components\Toggle::make('is_deliverable')
                //     ->required(),
                // Forms\Components\TextInput::make('payment_status')
                //     ->required()
                //     ->maxLength(255)
                //     ->default('unpaid'),
                // Forms\Components\TextInput::make('delivery_address')
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('contact_number')
                //     ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_deliverable')
                    ->boolean(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('delivery_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_number')
                    ->searchable(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
