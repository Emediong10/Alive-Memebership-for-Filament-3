<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Symfony\Component\VarDumper\Caster\DateCaster;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    Select::make('event_type_id')->relationship('event_type','name')->required()->preload()->searchable(),
                    TextInput::make('name')->required(),
                    DatePicker::make('start_date')->required(),
                    DatePicker::make('end_date')->required(),
                    TextInput::make('venue'),
                    Toggle::make('is_paid_event')->live(),
                    TextInput::make('event_fees')->visible(function(Get $get){
                         if($get('is_paid_event')==true)
                         {
                            return true;
                         }
                         return false;
                    })->numeric()->required(function(Get $get){
                        if($get('is_paid_event')==true)
                        {
                           return true;
                        }
                        return false;
                   }),
                   Select::make('event_fees_currency')->options([
                      'USD'=>'USD',
                      'NGN'=>'NGN'
                   ])->visible(function(Get $get){
                    if($get('is_paid_event')==true)
                    {
                       return true;
                    }
                    return false;
                    })->required(function(Get $get){
                        if($get('is_paid_event')==true)
                        {
                           return true;
                        }
                        return false;
                   }),
                   RichEditor::make('description'),
                   FileUpload::make('event_flyer')->image()->directory('images/event_flyer'),
                   Toggle::make('active'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event_type.name')->label('Event Type')->searchable()->sortable(),
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('start_date')->searchable(),
                TextColumn::make('end_date')->searchable(),
                TextColumn::make('venue')->searchable(),
                TextColumn::make('event_fees'),
                TextColumn::make('event_fees_currency'),
                ImageColumn::make('event_flyer')->width(50)->height(50),
                ToggleColumn::make('active')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
