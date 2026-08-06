<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $navigationLabel = 'آراء العملاء';
    protected static ?string $modelLabel = 'رأي عميل';
    protected static ?string $pluralModelLabel = 'آراء العملاء';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('client_name')->label('اسم العميل')->required(),
                Forms\Components\TextInput::make('client_company')->label('اسم الشركة'),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('client_position_ar')->label('المسمى الوظيفي (عربي)'),
                Forms\Components\TextInput::make('client_position_en')->label('المسمى الوظيفي (إنجليزي)'),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Textarea::make('content_ar')->label('الرأي (عربي)')->required(),
                Forms\Components\Textarea::make('content_en')->label('الرأي (إنجليزي)')->required(),
            ]),
            Forms\Components\FileUpload::make('avatar')->label('صورة العميل')->image()->directory('testimonials'),
            Forms\Components\Select::make('rating')->label('التقييم')
                ->options([1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->default(5),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('order')->numeric()->default(0)->label('الترتيب'),
                Forms\Components\Toggle::make('is_active')->label('مفعّل')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('avatar')->label('الصورة')->circular(),
            Tables\Columns\TextColumn::make('client_name')->label('العميل')->searchable(),
            Tables\Columns\TextColumn::make('client_company')->label('الشركة'),
            Tables\Columns\TextColumn::make('rating')->label('التقييم'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
