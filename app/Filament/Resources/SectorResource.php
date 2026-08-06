<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectorResource\Pages;
use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SectorResource extends Resource
{
    protected static ?string $model = Sector::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $navigationLabel = 'القطاعات';
    protected static ?string $modelLabel = 'قطاع';
    protected static ?string $pluralModelLabel = 'القطاعات';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('title_ar')->label('الاسم (عربي)')->required(),
                Forms\Components\TextInput::make('title_en')->label('Name (English)')->required(),
            ]),
            Forms\Components\TextInput::make('icon')->label('اسم الأيقونة (heroicon)'),
            Forms\Components\TextInput::make('order')->numeric()->default(0)->label('الترتيب'),
            Forms\Components\Toggle::make('is_active')->label('مفعّل')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title_ar')->label('الاسم (عربي)'),
            Tables\Columns\TextColumn::make('title_en')->label('الاسم (إنجليزي)'),
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
            'index' => Pages\ListSectors::route('/'),
            'create' => Pages\CreateSector::route('/create'),
            'edit' => Pages\EditSector::route('/{record}/edit'),
        ];
    }
}
