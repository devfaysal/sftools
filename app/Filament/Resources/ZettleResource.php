<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZettleResource\Pages;
use App\Filament\Resources\ZettleResource\RelationManagers;
use App\Models\Zettle;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ZettleResource extends Resource
{
    protected static ?string $model = Zettle::class;

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
                TextColumn::make('amount')->getStateUsing(function (Zettle $record) {
                    return '€' . $record->amount/100;
                }),
                TextColumn::make('originatorTransactionType')->label('Transaction Type'),
                TextColumn::make('originatingTransactionUuid')->label('Transaction Uuid'),
                TextColumn::make('timestamp')->dateTime('Y-m-d h:i:s a'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListZettles::route('/'),
            'create' => Pages\CreateZettle::route('/create'),
            'edit' => Pages\EditZettle::route('/{record}/edit'),
        ];
    }    
}
