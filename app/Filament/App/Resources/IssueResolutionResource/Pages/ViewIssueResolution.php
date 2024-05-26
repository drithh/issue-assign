<?php

namespace App\Filament\App\Resources\IssueResolutionResource\Pages;

use App\Filament\App\Resources\IssueResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIssueResolution extends ViewRecord
{
    protected static string $resource = IssueResolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
