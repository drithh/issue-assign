<?php

namespace App\Filament\Resources\IssueResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;

class IssueHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'editHistory';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('field_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('old_value')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('new_value')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('issue_id')
            ->columns([
                Tables\Columns\TextColumn::make('field_name'),
                Tables\Columns\TextColumn::make('old_value')->formatStateUsing(function ($state) {
                    return Str::of($state)->limit(20);
                }),
                Tables\Columns\TextColumn::make('new_value')->formatStateUsing(function ($state) {
                    return Str::of($state)->limit(20);
                }),
                Tables\Columns\TextColumn::make('edited_by')->formatStateUsing(function ($state) {
                    return User::find($state)->email;
                }),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
