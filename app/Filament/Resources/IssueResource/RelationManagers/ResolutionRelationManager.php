<?php

namespace App\Filament\Resources\IssueResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;

class ResolutionRelationManager extends RelationManager
{

    protected static string $relationship = 'issueResolution';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('issue_id')
                    ->label('Issue')
                    ->required()
                    ->columnSpanFull()
                    ->options(
                        \App\Models\Issue::all()->pluck('findings', 'id')
                    ),
                Forms\Components\Select::make('resolved_by')
                    ->label('Resolved By')
                    ->options(
                        \App\Models\User::all()->pluck('email', 'id')
                    )
                    ->required(),
                Forms\Components\DateTimePicker::make('resolved_at')
                    ->required(),
                Forms\Components\Textarea::make('resolution_description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('file_url')
                    ->label('File Upload')
                    ->disk('public')
                    ->visibility('public')
                    ->multiple()
                    ->openable()
                    ->downloadable()
                    ->disabled()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('issue_id')
            ->columns([
                Tables\Columns\TextColumn::make('resolution_description'),
                Tables\Columns\TextColumn::make('resolver.email'),
                Tables\Columns\TextColumn::make('resolved_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\Action::make('view')
                //     ->label('View')
                //     ->icon('heroicon-o-eye')
                //     ->url(fn ($record) => route('filament.admin.resources.issue-resolutions.view', $record))
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
