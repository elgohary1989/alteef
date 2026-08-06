<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'رسائل التواصل';
    protected static ?string $navigationLabel = 'الرسائل الواردة';
    protected static ?string $modelLabel = 'رسالة';
    protected static ?string $pluralModelLabel = 'الرسائل الواردة';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('الاسم')->disabled(),
            Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->disabled(),
            Forms\Components\TextInput::make('phone')->label('الهاتف')->disabled(),
            Forms\Components\TextInput::make('subject')->label('الموضوع')->disabled(),
            Forms\Components\Textarea::make('message')->label('الرسالة')->disabled()->columnSpanFull(),
            Forms\Components\Toggle::make('is_read')->label('تمت القراءة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\IconColumn::make('is_read')->boolean()->label('مقروءة'),
            Tables\Columns\TextColumn::make('name')->label('الاسم')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('البريد الإلكتروني')->searchable(),
            Tables\Columns\TextColumn::make('phone')->label('الهاتف'),
            Tables\Columns\TextColumn::make('subject')->label('الموضوع'),
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->dateTime('Y-m-d H:i')->sortable(),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
