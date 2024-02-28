<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

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
            Section::make('Users details')
            ->schema([
                TextInput::make('firstname'),
                TextInput::make('middlename'),
                TextInput::make('lastname'),
                TextInput::make('email'),
                TextInput::make('phone')
            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname')->searchable(),
                TextColumn::make('middlename')->searchable(),
                TextColumn::make('lastname')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('gender')->searchable(),
                TextColumn::make('chapter.name')->sortable()->searchable(),
                TextColumn::make('member_type.type')->sortable()->searchable(),
                TextColumn::make('created_at')->sortable()->searchable(),
                TextColumn::make('course_of_study')->searchable(),
                TextColumn::make('degree')->searchable(),
                TextColumn::make('occupation')->searchable(),
                TextColumn::make('professional_abilities')->searchable(),
                TextColumn::make('missions')->searchable(),
                TextColumn::make('area_interest')->searchable(),
                TextColumn::make('spiritual_gift')->searchable(),
                TextColumn::make('skills')->searchable(),
                
                ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
           // 'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
