<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\Rules\Password;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
           // Actions\DeleteAction::make(),
    

    // protected function getHeaderActions(): array
    // {
    //     return [
           Action::make('ChangePassword')
            ->form([
            TextInput::make('new_password')
            ->password()
            ->label('New Password')
            ->required()
            ->rule(Password::default()),

           

            TextInput::make('new_password_confirmation')
            ->password()
            ->label('Confirm New Password')
            ->same('new_password')
            ->required()
            ->rule(Password::default())

            ])

            ->action(function (array $data){
                $this->record->update([
                    'password' => Hash::make($data['new_password'])
                ]);
                $this->notify('Success', 'Password Updated Successfully');
            })

        ];
    }
}
