<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\IssueResource\Pages;
use App\Filament\App\Resources\IssueResource\RelationManagers;
use App\Filament\App\Resources\IssueResource\RelationManagers\ResolutionRelationManager;
use App\Models\Issue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('department_id')
                    ->label('Department')
                    ->required()
                    ->options(
                        \App\Models\Department::all()->pluck('name', 'id')
                    ),
                Forms\Components\DateTimePicker::make('target_time')
                    ->required(),
                Forms\Components\TextInput::make('findings')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('criteria')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('requirements')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('root_cause_analysis')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('corrective_actions')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'submitted' => 'Submitted',
                        'resolved' => 'Resolved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('target_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('findings')
                    ->searchable(),
                Tables\Columns\TextColumn::make('criteria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('requirements')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('root_cause_analysis')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('corrective_actions')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('issueResolution.submitted_at')
                    ->label('Resolved At')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'submitted' => 'blue',
                        'resolved' => 'green',
                        'rejected' => 'red',
                    }),
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
            ])->defaultSort(function (Builder $query): Builder {
                return $query
                    ->select('issues.*')
                    ->leftJoin('issue_resolutions', 'issues.id', '=', 'issue_resolutions.issue_id')
                    ->orderBy('issue_resolutions.submitted_at', 'desc')
                    ->orderBy('target_time', 'desc');
            });
    }



    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            ResolutionRelationManager::class,
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
