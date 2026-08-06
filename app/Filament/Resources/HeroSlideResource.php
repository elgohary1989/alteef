<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroSlideResource extends Resource
{
    protected static ?string $model = HeroSlide::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'محتوى الصفحة الرئيسية';

    protected static ?string $navigationLabel = 'شرائح الهيرو';

    protected static ?string $modelLabel = 'شريحة';

    protected static ?string $pluralModelLabel = 'شرائح الهيرو';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Grid::make(2)
                ->schema([

                    Forms\Components\Section::make('عربي')
                        ->schema([

                            Forms\Components\TextInput::make('eyebrow_ar')
                                ->label('النص العلوي'),

                            Forms\Components\TextInput::make('title_ar')
                                ->label('العنوان')
                                ->required(),

                            Forms\Components\TextInput::make('highlight_word_ar')
                                ->label('الكلمة المميزة باللون الأزرق'),

                            Forms\Components\Textarea::make('subtitle_ar')
                                ->label('الوصف'),

                            Forms\Components\TextInput::make('button_text_ar')
                                ->label('نص الزر الأساسي'),

                            Forms\Components\TextInput::make('secondary_button_text_ar')
                                ->label('نص الزر الثاني'),

                        ]),

                    Forms\Components\Section::make('English')
                        ->schema([

                            Forms\Components\TextInput::make('eyebrow_en')
                                ->label('Eyebrow'),

                            Forms\Components\TextInput::make('title_en')
                                ->label('Title')
                                ->required(),

                            Forms\Components\TextInput::make('highlight_word_en')
                                ->label('Highlight Word'),

                            Forms\Components\Textarea::make('subtitle_en')
                                ->label('Subtitle'),

                            Forms\Components\TextInput::make('button_text_en')
                                ->label('Primary Button'),

                            Forms\Components\TextInput::make('secondary_button_text_en')
                                ->label('Secondary Button'),

                        ]),

                ]),

            Forms\Components\Section::make('الأزرار')
                ->schema([

                    Forms\Components\TextInput::make('button_link')
                        ->label('رابط الزر الأساسي')
                        ->url(),

                    Forms\Components\TextInput::make('secondary_button_link')
                        ->label('رابط الزر الثاني')
                        ->url(),

                ]),

            Forms\Components\FileUpload::make('image')
                ->label('صورة الخلفية')
                ->image()
                ->directory('hero'),

            Forms\Components\TextInput::make('order')
                ->label('الترتيب')
                ->numeric()
                ->default(0),

            Forms\Components\Toggle::make('is_active')
                ->label('مفعل')
                ->default(true),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة'),

                Tables\Columns\TextColumn::make('title_ar')
                    ->label('العنوان العربي')
                    ->searchable(),

                Tables\Columns\TextColumn::make('title_en')
                    ->label('العنوان الإنجليزي')
                    ->searchable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('الترتيب')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('مفعل'),

            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSlides::route('/'),
            'create' => Pages\CreateHeroSlide::route('/create'),
            'edit' => Pages\EditHeroSlide::route('/{record}/edit'),
        ];
    }
}
