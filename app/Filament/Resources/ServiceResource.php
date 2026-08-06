<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use App\Models\ServiceCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $navigationLabel = 'الخدمات';
    protected static ?string $modelLabel = 'خدمة';
    protected static ?string $pluralModelLabel = 'الخدمات';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Grid::make(2)
                ->schema([

                    Forms\Components\Section::make('عربي')
                        ->schema([

                            Forms\Components\Select::make('service_category_id')
                                ->label('التصنيف')
                                ->relationship('category', 'name_ar')
                                ->searchable()
                                ->preload()
                                ->required(),

                            Forms\Components\TextInput::make('title_ar')
                                ->label('العنوان')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(
                                    fn($state, callable $set)
                                    => $set('slug', Str::slug($state))
                                ),

                            Forms\Components\Textarea::make('summary_ar')
                                ->label('ملخص قصير'),

                            Forms\Components\RichEditor::make('content_ar')
                                ->label('المحتوى الكامل'),

                            Forms\Components\TextInput::make('hero_title_ar')
                                ->label('عنوان الهيرو'),

                            Forms\Components\Textarea::make('hero_desc_ar')
                                ->label('وصف الهيرو'),

                            Forms\Components\TextInput::make('cta_text_ar')
                                ->label('نص الزر'),

                        ]),

                    Forms\Components\Section::make('English')
                        ->schema([

                            Forms\Components\TextInput::make('title_en')
                                ->label('Title')
                                ->required(),

                            Forms\Components\Textarea::make('summary_en')
                                ->label('Short Summary'),

                            Forms\Components\RichEditor::make('content_en')
                                ->label('Full Content'),

                            Forms\Components\TextInput::make('hero_title_en')
                                ->label('Hero Title'),

                            Forms\Components\Textarea::make('hero_desc_en')
                                ->label('Hero Description'),

                            Forms\Components\TextInput::make('cta_text_en')
                                ->label('Button Text'),

                        ]),

                ]),

            Forms\Components\Section::make('الإعدادات')
                ->schema([

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('cta_link')
                        ->label('رابط الزر'),

                    Forms\Components\TextInput::make('icon')
                        ->label('الأيقونة'),

                    Forms\Components\TextInput::make('order')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')
                        ->default(true),

                ]),

            Forms\Components\Section::make('الصور')
                ->schema([

                    Forms\Components\FileUpload::make('image')
                        ->label('الصورة الرئيسية')
                        ->image()
                        ->directory('services'),

                    Forms\Components\FileUpload::make('hero_image')
                        ->label('صورة الهيرو')
                        ->image()
                        ->directory('services'),

                    Forms\Components\FileUpload::make('gallery')
                        ->label('معرض الصور')
                        ->multiple()
                        ->image()
                        ->directory('services/gallery'),

                ]),

            Forms\Components\Section::make('المميزات Features')
                ->schema([

                    Forms\Components\Repeater::make('features_ar')
                        ->label('المميزات عربي')
                        ->schema([

                            Forms\Components\TextInput::make('title')
                                ->required(),

                            Forms\Components\Textarea::make('description'),

                            Forms\Components\TextInput::make('icon'),

                        ])
                        ->columns(3),

                    Forms\Components\Repeater::make('features_en')
                        ->label('Features English')
                        ->schema([

                            Forms\Components\TextInput::make('title'),

                            Forms\Components\Textarea::make('description'),

                            Forms\Components\TextInput::make('icon'),

                        ])
                        ->columns(3),

                ]),

            Forms\Components\Section::make('Benefits')
                ->schema([

                    Forms\Components\Repeater::make('benefits_ar')
                        ->label('الفوائد عربي')
                        ->schema([

                            Forms\Components\TextInput::make('title'),

                            Forms\Components\Textarea::make('description'),

                        ]),

                    Forms\Components\Repeater::make('benefits_en')
                        ->label('Benefits English')
                        ->schema([

                            Forms\Components\TextInput::make('title'),

                            Forms\Components\Textarea::make('description'),

                        ]),

                ]),

            Forms\Components\Section::make('FAQ')
                ->schema([

                    Forms\Components\Repeater::make('faqs_ar')
                        ->label('الأسئلة الشائعة')
                        ->schema([

                            Forms\Components\TextInput::make('question'),

                            Forms\Components\Textarea::make('answer'),

                        ]),

                    Forms\Components\Repeater::make('faqs_en')
                        ->label('FAQ English')
                        ->schema([

                            Forms\Components\TextInput::make('question'),

                            Forms\Components\Textarea::make('answer'),

                        ]),

                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('category.name_ar')
                    ->label('التصنيف')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('title_ar')
                    ->label('العنوان (عربي)')
                    ->searchable(),

                Tables\Columns\TextColumn::make('title_en')
                    ->label('العنوان (English)')
                    ->searchable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('الترتيب')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('مفعلة')
                    ->boolean(),

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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
