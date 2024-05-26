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
            Actions\EditAction::make(),
            Action::make('Open Resolution Issue')
                ->url(function ($record) {
                    // Check if a resolution record already exists for the issue
                    $resolutionExists = $record->issueResolution()->exists();

                    // Route to the appropriate route based on the existence of the record
                    if ($resolutionExists) {
                        return route('filament.app.resources.issue-resolutions.view', $record);
                    } else {
                        return route('filament.app.resources.issue-resolutions.create', $record);
                    }
                })
        ];
    }
}
