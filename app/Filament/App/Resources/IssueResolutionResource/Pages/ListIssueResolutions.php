<?php

namespace App\Filament\App\Resources\IssueResolutionResource\Pages;

use App\Filament\App\Resources\IssueResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIssueResolutions extends ListRecords
{
    protected static string $resource = IssueResolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
