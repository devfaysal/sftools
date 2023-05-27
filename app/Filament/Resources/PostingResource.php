<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostingResource\Pages;
use App\Filament\Resources\PostingResource\RelationManagers;
use App\Models\Posting;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostingResource extends Resource
{
    protected static ?string $model = Posting::class;

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
                TextColumn::make('schedule'),
                TextColumn::make('amount'),
                TextColumn::make('postingtext'),
                TextColumn::make('postingaccount_debit'),
                TextColumn::make('postingaccount_credit'),
                TextColumn::make('vat'),
                TextColumn::make('status')
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
            'index' => Pages\ListPostings::route('/'),
            'create' => Pages\CreatePosting::route('/create'),
            'edit' => Pages\EditPosting::route('/{record}/edit'),
        ];
    }    
}
