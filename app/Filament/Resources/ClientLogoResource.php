<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientLogoResource\Pages;
use App\Models\ClientLogo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClientLogoResource extends Resource
{
    protected static ?string $model = ClientLogo::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $navigationLabel = 'شعارات العملاء';
    protected static ?string $modelLabel = 'شعار عميل';
    protected static ?string $pluralModelLabel = 'شعارات العملاء';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('اسم العميل')->required(),
            Forms\Components\FileUpload::make('logo')->label('الشعار')->image()->directory('clients')->required(),
            Forms\Components\TextInput::make('url')->label('رابط موقع العميل (اختياري)')->url(),
            Forms\Components\TextInput::make('order')->numeric()->default(0)->label('الترتيب'),
            Forms\Components\Toggle::make('is_active')->label('مفعّل')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('logo')->label('الشعار'),
            Tables\Columns\TextColumn::make('name')->label('الاسم')->searchable(),
            Tables\Columns\TextColumn::make('order')->sortable()->label('الترتيب'),
            Tables\Columns\IconColumn::make('is_active')->boolean()->label('مفعّل'),
        ])
        ->defaultSort('order')
        ->reorderable('order')
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientLogos::route('/'),
            'create' => Pages\CreateClientLogo::route('/create'),
            'edit' => Pages\EditClientLogo::route('/{record}/edit'),
        ];
    }
}
