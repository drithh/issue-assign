<?php

namespace App\Filament\App\Resources\IssueResource\RelationManagers;

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
                Forms\Components\TextInput::make('comment')
                    ->required()
                    ->readOnly()
                    ->maxLength(255),
                Forms\Components\Textarea::make('status')
                    ->required()
                    ->readOnly()
                    ->maxLength(255),
                Forms\Components\TextInput::make('edited_by')->formatStateUsing(function ($state) {
                    $user = User::find($state);
                    return $user ? $user->email : null;
                })
                    ->readOnly()
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('issue_id')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('comment')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('edited_by')->formatStateUsing(function ($state) {
                    return User::find($state)->email;
                }),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()

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
