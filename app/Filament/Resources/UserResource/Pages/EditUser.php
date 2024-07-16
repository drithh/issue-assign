<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Mail\UserUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        Log::info("email sent to {$record->email}");
        try {
            Mail::to($record->email)->send(new UserUpdated());
        } catch (\Exception $e) {
            // Log or dd() the exception to see the error message
            dd($e->getMessage());
        }

        return parent::handleRecordUpdate($record, $data);
    }
}
