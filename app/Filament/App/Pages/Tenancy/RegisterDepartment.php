<?php

namespace App\Filament\App\Pages\Tenancy;

use App\Models\Department;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterDepartment extends RegisterTenant
{
  public static function getLabel(): string
  {
    return 'Register department';
  }

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        TextInput::make('name'),
        TextInput::make('slug'),
      ]);
  }

  protected function handleRegistration(array $data): Department
  {
    // one department per tenant
    // if (auth()->user()->departments()->exists()) {
    //   abort(403, 'You can only register one department per tenant.');
    // }

    $department = Department::create($data);

    $department->members()->attach(auth()->user());

    return $department;
  }
}
