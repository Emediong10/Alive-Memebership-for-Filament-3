<?php
namespace App\Filament\Resources\EventApplicantsResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Models\EventApplicants;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\EventApplicantsResource;
use App\Models\Payment; // Assuming you have a Payment model

class ViewEventApplicants extends ViewRecord
{
    protected static string $resource = EventApplicantsResource::class;

    // Get the header actions
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            // Action to approve attendance
            Action::make('approve_application')
                ->icon('heroicon-o-check-circle')
                ->label('Approve Application')
                ->requiresConfirmation()
                ->modalIcon('heroicon-s-check-circle')
                ->modalHeading('Approve membership attendance')
                ->modalSubheading('Are you sure you want to approve this member\'s attendance?')
                ->action(function (EventApplicants $record, array $data) {
                    // Update approval status to 'approved' (assuming 1 is approved)
                    $record->update([
                        'approval_status' => 1,
                        // 'approved_by' => auth()->user()->id
                         // You can log the admin who approves it
                    ]);

                    Notification::make()
                        ->title('Application Approved')
                        ->body('The application has been successfully approved!')
                        ->success()
                        ->send();

                    return redirect(EventApplicantsResource::getUrl('index'));
                }),

            // Action to decline attendance with a reason
            Action::make('decline_application')
            ->icon('heroicon-o-x-circle')
            ->color('warning')
            ->label('Decline Application')
            ->requiresConfirmation()
            ->modalIcon('heroicon-s-x-circle')
            ->modalHeading('Decline membership attendance')
            ->modalSubheading('Are you sure you want to decline this member\'s attendance?')
            ->form([
                Textarea::make('decline_reason')
                    ->label('Reason for Declining')
                    ->placeholder('Enter a reason for declining')
                    ->required(),
            ])
            ->action(function (array $data) {
                // Access the current record and update it
                $this->record->update([
                    'approval_status' => 2, // Declined
                    'decline_reason' => $data['decline_reason'] ?? 'No reason provided',
                ]);
        
                Notification::make()
                    ->title('Application Declined')
                    ->body('The application has been successfully declined.')
                    ->warning()
                    ->send();
        
                return redirect(EventApplicantsResource::getUrl('index'));
            })
        
        ];
    }

    // Define the view content
    protected function getContent(): string
    {
        $record = $this->getRecord();

        // Fetch the user details
        $user = $record->user; // Assuming you have a user relationship

        // Fetch payment details
        $payment = $record->payment; // Assuming you have a relationship with Payment model

        return view('filament.resources.event-applicants.view', [
            'record' => $record,
            'user' => $user,
            'payment' => $payment,
        ]);
    }

    // Optional: Customize the breadcrumb
    // protected function getBreadcrumbs(): array
    // {
    //     return [
    //         'Event Applicants' => EventApplicantsResource::getUrl('index'),
    //         'View Applicant' => '#',
    //     ];
    // }
}
