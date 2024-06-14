<?php

namespace App\Filament\App\Resources\IssueResource\Pages;

use App\Filament\App\Resources\IssueResource;
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
                        ->badge(\App\Models\Issue::where('status', 'pending')->count())
                        ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),
            'submitted' => Tab::make()
                        ->badge(\App\Models\Issue::where('status', 'submitted')->count())
                        ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'submitted')),
            'rejected' => Tab::make()
                        ->badge(\App\Models\Issue::where('status', 'rejected')->count())
                        ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected')),
            'solved' => Tab::make()
                        ->badge(\App\Models\Issue::where('status', 'resolved')->count())
                        ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'resolved')),
        ];
    }
}
