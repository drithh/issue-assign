<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\IssueResolutionResource\Pages;
use App\Filament\App\Resources\IssueResolutionResource\RelationManagers;
use App\Models\IssueResolution;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IssueResolutionResource extends Resource
{
    protected static ?string $model = IssueResolution::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // select issue
                Forms\Components\Select::make('issue_id')
                    ->label('Issue')
                    ->required()
                    ->columnSpanFull()
                    ->options(
                        \App\Models\Issue::whereDoesntHave('issueResolution')->get()->pluck('findings', 'id')
                    ),
                Forms\Components\Select::make('resolved_by')
                    ->label('Resolved By')
                    ->options(
                        \App\Models\User::all()->pluck('email', 'id')
                    )
                    ->required()
                    ->hiddenOn([Pages\CreateIssueResolution::class, Pages\EditIssueResolution::class]),
                Forms\Components\DateTimePicker::make('resolved_at')
                    ->required()
                    ->hiddenOn([Pages\CreateIssueResolution::class, Pages\EditIssueResolution::class]),
                Forms\Components\Textarea::make('resolution_description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('file_url')
                    ->label('File Upload')
                    ->disk('public')
                    ->visibility('public')
                    ->required()
                    ->preserveFilenames()
                    ->multiple()
                    ->openable()
                    ->downloadable()
                    ->appendFiles()
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('issue.findings')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('resolver.email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('resolved_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListIssueResolutions::route('/'),
            'create' => Pages\CreateIssueResolution::route('/create'),
            'view' => Pages\ViewIssueResolution::route('/{record}'),
            'edit' => Pages\EditIssueResolution::route('/{record}/edit'),
        ];
    }
}
