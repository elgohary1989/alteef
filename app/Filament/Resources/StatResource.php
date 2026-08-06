<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatResource\Pages;
use App\Models\Stat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StatResource extends Resource
{
    protected static ?string $model = Stat::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $navigationLabel = 'الإحصائيات';
    protected static ?string $modelLabel = 'إحصائية';
    protected static ?string $pluralModelLabel = 'الإحصائيات';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('number')->label('الرقم')->numeric()->required(),
                Forms\Components\TextInput::make('suffix')->label('لاحقة (مثال: + أو %)'),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('label_ar')->label('الوصف (عربي)')->required(),
                Forms\Components\TextInput::make('label_en')->label('الوصف (إنجليزي)')->required(),
            ]),
            Forms\Components\TextInput::make('order')->numeric()->default(0)->label('الترتيب'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('number')->label('الرقم'),
            Tables\Columns\TextColumn::make('label_ar')->label('الوصف (عربي)'),
            Tables\Columns\TextColumn::make('label_en')->label('الوصف (إنجليزي)'),
            Tables\Columns\TextColumn::make('order')->sortable()->label('الترتيب'),
        ])
        ->defaultSort('order')
        ->reorderable('order')
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStats::route('/'),
            'create' => Pages\CreateStat::route('/create'),
            'edit' => Pages\EditStat::route('/{record}/edit'),
        ];
    }
}
