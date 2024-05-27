<?php

namespace App\Filament\Resources\IssueResource\Pages;

use App\Filament\Resources\IssueResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListIssues extends ListRecords
{
    protected static string $resource = IssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'pending' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),
            'submitted' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'submitted')),
            'rejected' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected')),
            'solved' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'resolved')),
        ];
    }
}
