<?php

namespace App\Filament\App\Resources\IssueResolutionResource\Pages;

use App\Filament\App\Resources\IssueResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIssueResolution extends CreateRecord
{
    protected static string $resource = IssueResolutionResource::class;
    protected static bool $canCreateAnother = false;
}
