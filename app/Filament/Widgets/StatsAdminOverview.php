<?php

namespace App\Filament\Widgets;

use App\Models\Issue;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Issue', Issue::where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->color('blue'),
            Stat::make('Submitted Issue', Issue::where('status', 'submitted')->count())
                ->icon('heroicon-o-arrow-path')
                ->color('blue'),
            Stat::make('Solved Issue', Issue::where('status', 'resolved')->count())
                ->icon('heroicon-o-check-badge')
                ->color('blue'),
            Stat::make('Rejected Issue', Issue::where('status', 'rejected')->count())
                ->icon('heroicon-o-x-mark')
                ->color('blue'),
            


        ];
    }
}
