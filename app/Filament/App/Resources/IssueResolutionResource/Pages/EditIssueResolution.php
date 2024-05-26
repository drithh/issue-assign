<?php

namespace App\Filament\App\Resources\IssueResolutionResource\Pages;

use App\Filament\App\Resources\IssueResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIssueResolution extends EditRecord
{
    protected static string $resource = IssueResolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
