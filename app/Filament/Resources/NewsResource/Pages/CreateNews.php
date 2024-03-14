<?php

namespace App\Filament\Resources\NewsResource\Pages;

use Filament\Actions;
use App\Filament\Resources\NewsResource;
use App\Models\News;
use App\Models\NewsRecipient;
use Exception;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('News Created')
        ->body(' News created successfully.');
}
protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}


protected function getFormActions(): array
{
    return [
        //$this->getCreateFormAction(),
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
        $news_data=[
            'title'=>$this->data['title'],
            'content'=>$this->data['content'],
            'slug'=>$this->data['slug'],
            'active'=>$this->data['active']
        ];
        DB::beginTransaction();
        $news=News::create($news_data);
        if($this->data['recipient_type']==1)
        {
            foreach($this->data['recipients'] as $recipient)
            {
               NewsRecipient::create(
                [
                    'news_id'=>$news->id,
                    'is_group'=>false,
                    'member_types_id'=>null,
                    'read'=>false,
                    'user_id'=>$recipient
                ]);
            }
        }
        elseif($this->data['recipient_type']==2)
        {
            foreach($this->data['recipients'] as $recipient)
            {
               NewsRecipient::create(
                [
                    'news_id'=>$news->id,
                    'is_group'=>true,
                    'member_types_id'=>$recipient,
                    'read'=>false,
                    'user_id'=>null
                ]);
            }
        }
        elseif($this->data['recipient_type']==3)
        {
            NewsRecipient::create(
                [
                    'news_id'=>$news->id,
                    'is_group'=>true,
                    'member_types_id'=>"*",
                    'read'=>false,
                    'user_id'=>null
                ]);
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
