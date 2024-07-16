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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
                            ])
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('target_time')
                            ->required(),
                        Forms\Components\Textarea::make('comment')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(2)->hiddenOn(['create']),
                Forms\Components\Section::make('Detail Issue')
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->required()
                            ->disabledOn(['edit'])
                            ->options(
                                \App\Models\Department::orderBy('name')->get()->pluck('name', 'id')
                            ),
                        Forms\Components\Select::make('criteria')
                            ->label('Criteria')
                            ->options([
                                'critical' => 'Critical',
                                'mayor' => 'Mayor',
                                'minor' => 'Minor'
                            ])
                            ->required()
                            ->disabledOn(['edit']),
                        Forms\Components\Textarea::make('findings')
                            ->required()
                            ->readOnly()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->disabledOn(['edit']),

                        Forms\Components\Textarea::make('additonal_data')
                            ->required()
                            ->maxLength(255)
                            ->readOnly()
                            ->disabledOn(['edit'])
                            ->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\Section::make('Issue Resolution')
                    ->schema([
                        Forms\Components\Select::make('submitted_by')
                            ->label('Submitted By')
                            ->options(
                                \App\Models\User::all()->pluck('email', 'id')
                            )
                            ->hiddenOn(['edit']),
                        Forms\Components\DateTimePicker::make('submitted_at')
                            ->readOnly()
                            ->hiddenOn(['edit']),
                        Forms\Components\Textarea::make('resolution_description')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('root_cause_analysis')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('corrective_actions')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('preventive_actions')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('file_url')
                            ->label('File Upload')
                            ->disk('public')
                            ->visibility('public')
                            ->directory('issue_resolutions')
                            ->required()
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend((string) now()->timestamp . '_')
                            )
                            ->multiple()
                            ->deletable()
                            ->reorderable()
                            ->openable()
                            ->downloadable()
                            ->appendFiles()
                            ->columnSpanFull(),
                    ])->columns(2)->hiddenOn(['create']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('findings')
                    ->searchable(),
                Tables\Columns\TextColumn::make('criteria')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('additonal_data')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('root_cause_analysis')
                //     ->searchable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('corrective_actions')
                //     ->searchable()
                //     ->toggleable(isToggledHiddenByDefault: true),
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
                    ->orderBy('submitted_at', 'desc')
                    ->orderBy('target_time', 'desc');
            });
    }



    public static function canCreate(): bool
    {
        return false;
    }

    // public static function canEdit(Model $record): bool
    // {
    //     return false;
    // }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [];
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
