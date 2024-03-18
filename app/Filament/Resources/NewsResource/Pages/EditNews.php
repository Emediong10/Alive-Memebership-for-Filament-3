<?php

namespace App\Filament\Resources\NewsResource\Pages;

use Filament\Actions;
use App\Filament\Resources\NewsResource;
use App\Models\News;
use App\Models\NewsRecipient;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getSaveNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('News update')
        ->body('The News has been successfully updated.');
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
    return [
        $this->getSaveFormAction(),
        
        Action::make('Send')
        ->icon('heroicon-o-paper-airplane')
        ->action('send')
        ->color('success'),
        // Action::make('draft')
        //   ->label('Save as Draft')
        //   ->action('draft')
    ];
}

function send()
{
    $this->validate();
    try{
        
        DB::beginTransaction();
        
        if($this->data['recipient_type']==1)
        {
            $recipient_exists=NewsRecipient::where('news_id',$this->record->id)->whereNotNull('user_id')->get()->pluck('user_id');
            foreach($this->data['recipients'] as $recipient)
            {
                if( !in_array($recipient,$recipient_exists))
                {
                    NewsRecipient::create(
                        [
                            'news_id'=>$this->record->id,
                            'is_group'=>false,
                            'member_types_id'=>null,
                            'read'=>false,
                            'user_id'=>$recipient
                        ]);
                }
               
            }
        }
        elseif($this->data['recipient_type']==2)
        {
            $recipient_exists=NewsRecipient::where('news_id',$this->record->id)->whereNotNull('member_types_id')->get()->pluck('member_types_id');

            foreach($this->data['recipients'] as $recipient)
            {
                if( !in_array($recipient,$recipient_exists))
                {
                    NewsRecipient::create(
                        [
                            'news_id'=>$this->record->id,
                            'is_group'=>true,
                            'member_types_id'=>$recipient,
                            'read'=>false,
                            'user_id'=>null
                        ]);
                }
               
            }
        }
        elseif($this->data['recipient_type']==3)
        {
            $recipient_exists=NewsRecipient::where('news_id',$this->record->id)->where('member_types_id',10)->first();
            if(! $recipient_exists)
            {
                NewsRecipient::create(
                    [
                        'news_id'=>$this->record->id,
                        'is_group'=>true,
                        'member_types_id'=>10,
                        'read'=>false,
                        'user_id'=>null
                    ]);
            }
           
        }
        DB::commit();
        Notification::make()->title('News Sent out successfully')->success()->send();
        return redirect(static::getResource()::getUrl('index'));
    }
    catch(Exception $e)
    {
        DB::rollBack();
        Notification::make()->title('Error Sending Message ...'.$e->getMessage())->danger()->send();
    }
    //dd($this->data);
   
}
}
