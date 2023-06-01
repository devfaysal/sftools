<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlentyMarketProductResource\Pages;
use App\Filament\Resources\PlentyMarketProductResource\RelationManagers;
use App\Models\PlentyMarketProduct;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlentyMarketProductResource extends Resource
{
    protected static ?string $model = PlentyMarketProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('product_name')->wrap(),
            TextColumn::make('mu_varient'),
            TextColumn::make('ms_varient'),
            TextColumn::make('on_varient'),
            TextColumn::make('stock'),
            TextColumn::make('minimum_stock'),
            IconColumn::make('status')->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPlentyMarketProducts::route('/'),
            'create' => Pages\CreatePlentyMarketProduct::route('/create'),
            'edit' => Pages\EditPlentyMarketProduct::route('/{record}/edit'),
        ];
    }    
}
