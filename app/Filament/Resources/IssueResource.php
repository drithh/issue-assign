<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueResource\Pages;
use App\Filament\Resources\IssueResource\RelationManagers;
use App\Models\Issue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('department_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('findings')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('criteria')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('requirements')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('root_cause_analysis')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('corrective_actions')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('target_time')
                    ->required(),
                Forms\Components\Toggle::make('is_accepted')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('findings')
                    ->searchable(),
                Tables\Columns\TextColumn::make('criteria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('requirements')
                    ->searchable(),
                Tables\Columns\TextColumn::make('root_cause_analysis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('corrective_actions')
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_accepted')
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListIssues::route('/'),
            'create' => Pages\CreateIssue::route('/create'),
            'view' => Pages\ViewIssue::route('/{record}'),
            'edit' => Pages\EditIssue::route('/{record}/edit'),
        ];
    }
}
