<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueResource\Pages;
use App\Filament\Resources\IssueResource\RelationManagers;
use App\Filament\Resources\IssueResource\RelationManagers\ResolutionRelationManager;
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
                Forms\Components\Section::make('Issue Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'submitted' => 'Submitted',
                                'resolved' => 'Resolved',
                                'rejected' => 'Rejected',
                            ]),
                        Forms\Components\DateTimePicker::make('target_time')
                            ->required(),
                        Forms\Components\Textarea::make('comment')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2)->hiddenOn(['create']),
                Forms\Components\Section::make('Detail Issue')
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->required()
                            ->disabledOn(['edit'])
                            ->options(
                                \App\Models\Department::orderBy('name')->get()->pluck('name', 'id')
                            )->columnSpanFull(),
                        Forms\Components\TextInput::make('requirements')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('criteria')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('findings')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\Section::make('Issue Resolution')
                    ->schema([
                        Forms\Components\Select::make('submitted_by')
                            ->label('Submitted By')
                            ->options(
                                \App\Models\User::all()->pluck('email', 'id')
                            )
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('submitted_at')
                            ->disabled(),
                        Forms\Components\Textarea::make('resolution_description')
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('root_cause_analysis')
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('corrective_actions')
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('preventive_actions')
                            ->required()
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('file_url')
                            ->label('File Upload')
                            ->disabled()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('issue_resolutions')
                            ->multiple()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ])->columns(2)->hiddenOn(['create']),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('findings')
                    ->searchable(),
                Tables\Columns\TextColumn::make('criteria')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('requirements')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('root_cause_analysis')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('corrective_actions')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('target_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('submitted_at')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'submitted' => 'info',
                        'resolved' => 'success',
                        'rejected' => 'danger',
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
                    ->orderBy('submitted_at', 'desc')
                    ->orderBy('target_time', 'desc');
            });
    }


    public static function getRelations(): array
    {
        return [
            'editHistory' => RelationManagers\IssueHistoryRelationManager::class,
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
