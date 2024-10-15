<?php

namespace App\Filament\Resources\EventApplicantsResource\Pages;

use Filament\Actions;
use App\Models\EventApplicants;
use Filament\Pages\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\EventApplicantsResource;

class EditEventApplicants extends EditRecord
{
    protected static string $resource = EventApplicantsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            Action::make('confirm_attendance')
    // ->icon('heroicon-o-check-circle')
    // ->label('Approve')
    // ->requiresConfirmation()
    // ->modalIcon('heroicon-s-user-group')
    // ->modalHeading('Approve membership attendance')
    // ->modalSubheading('Are you sure you want to approve this member attendance?')
    // ->action(function (EventApplicants $record, array $data) {
    //     $record->user_id = auth()->user()->id;
    //     $record->confirm_attendance = true;
    //     $record->update();

    //     Notification::make()
    //     ->title('Membership attendances')
    //     ->body('This memeber attendance has been successfully approved')
    //     ->success()
    //     ->send();
    // redirect(EventApplicantsResource::getUrl('index'));
// })


        // Additional logic can go here if needed


        ];
    }
}
