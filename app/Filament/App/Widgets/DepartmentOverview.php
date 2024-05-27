<?php

namespace App\Filament\App\Widgets;

use App\Models\Department;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DepartmentOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Department', Department::where('id', Auth::user()->department_id)->first()->name)
                ->icon('heroicon-o-building-office')
                ->color('blue'),

            Stat::make('Department Member', User::where('department_id', Auth::user()->department_id)->count())
                ->icon('heroicon-o-users')
                ->color('purple')

        ];
    }
}
