<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmsResource\Pages;
use App\Filament\Resources\SmsResource\RelationManagers;
use App\Models\Sms;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SmsResource extends Resource
{
    protected static ?string $model = Sms::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('message')
                    ->hint(fn ($state, $component) => 'left: ' . $component->getMaxLength() - strlen($state) . ' characters')
                    ->maxlength(10)
                    ->lazy()
                    ->required(), //or: reactive() for instant update, but less efficient
                Textarea::make('recipients')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('message'),
                TextColumn::make('recipients')->getStateUsing( function (Sms $record){
                    return $record->recipients()->pluck('phone')->implode(',');
                })
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
            'index' => Pages\ListSms::route('/'),
            'create' => Pages\CreateSms::route('/create'),
            'edit' => Pages\EditSms::route('/{record}/edit'),
        ];
    }    
}
