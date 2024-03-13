<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Application;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Users Interface';

    public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}



public static function form(Form $form): Form
{
    return $form
        ->schema([
            Section::make('View Application')->schema([
               
               
               //Select::make('member_type_id')->relationship('member_type','type')->required(),
               // Toggle::make('status')->label('Review Completed'),
                Repeater::make('answers')->schema([
                    TextInput::make('monthly_outreach')->label('I personally do active outreach monthly (not just church work):')->disabledOn('edit'),
                    
                    TextInput::make('professional')->label('I am a professional or graduate:')->disabledOn('edit'),
                    TextInput::make('christian_standard')->label('I strive to live out our high Christian standard as taught by the Bible and SOP')->disabledOn('edit'),
                    TextInput::make('will_support')->label('I desire to support ALIVE-Nigeria ministry with at least monthly:')->disabledOn('edit'),
                    TextInput::make('monthly_support')->label('Do you intend to support the ministry of ALIVE Nigeria on a monthly basis?')->disabledOn('edit'),
                    TextInput::make('monthly_amount')->label('Specify Amount you intend to Support Alive Nigeria with')->disabledOn('edit'),
                    TextInput::make('currency')->label('Specify the currency')->disabledOn('edit'),
                ])->columnSpan(2)->columns(2)->disableItemCreation()
                ->disableItemDeletion()
                ->disableItemMovement()->label('Answers to Questions'),
            ])->columns(2)

        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
                TextColumn::make('user.firstname')->label('Firstname')->searchable(),
                TextColumn::make('user.middlename')->label('Middlename')->searchable(),
                TextColumn::make('user.lastname')->label('Lastname')->searchable(),
                TextColumn::make('user.dob')->label('Date of Birth')->searchable(),
                TextColumn::make('user.email')->label('Email')->searchable(),
                 TextColumn::make('user.phone')->label('phone')->searchable(),
                TextColumn::make('user.gender')->label('Gender')->searchable(),
                TextColumn::make('user.chapter.name')->sortable()->searchable(),
                TextColumn::make('user.member_type.type')->sortable()->searchable(),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
               // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListApplications::route('/'),
           // 'create' => Pages\CreateApplication::route('/create'),
            'view' => Pages\ViewApplication::route('/{record}'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
