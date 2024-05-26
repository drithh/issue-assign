<?php

namespace App\Filament\App\Pages\Tenancy;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditDepartmentProfile extends EditTenantProfile
{
  public static function getLabel(): string
  {
    return 'Department profile';
  }

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        TextInput::make('name'),
        // ...
      ]);
  }
}
