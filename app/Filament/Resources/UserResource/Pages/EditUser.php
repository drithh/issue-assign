<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\UserUpdated;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            Mail::to("adrielalfeus@gmail.com")->send(new UserUpdated());
        } catch (\Exception $e) {
            // Log or dd() the exception to see the error message
            dd($e->getMessage());
        }

        return parent::handleRecordUpdate($record, $data);
    }
}
