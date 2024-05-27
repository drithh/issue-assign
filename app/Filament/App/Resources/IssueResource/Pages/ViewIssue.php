<?php

namespace App\Filament\App\Resources\IssueResource\Pages;

use App\Filament\App\Resources\IssueResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewIssue extends ViewRecord
{
    protected static string $resource = IssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Resolve Issue')
                ->hidden(
                    fn ($record) => $record->status === 'resolved'
                )
        ];
    }
}
