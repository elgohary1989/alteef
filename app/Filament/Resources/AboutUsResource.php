<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Filament\Resources\AboutUsResource\RelationManagers;
use App\Models\AboutUs;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AboutUsResource\RelationManagers\FeaturesRelationManager;
use App\Filament\Resources\AboutUsResource\RelationManagers\ValuesRelationManager;
use App\Filament\Resources\AboutUsResource\RelationManagers\TimelinesRelationManager;
class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $navigationLabel = 'عن الشركة';
    protected static ?string $modelLabel = 'عن الشركة';
    protected static ?string $pluralModelLabel = 'عن الشركة';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Hero Section')
                    ->schema([

                        FileUpload::make('hero_image')
                            ->image()
                            ->directory('aboutus')
                            ->imageEditor()
                            ->label('صورة الهيرو'),

                        Tabs::make('Hero Languages')
                            ->tabs([

                                Tabs\Tab::make('العربية')
                                    ->schema([

                                        TextInput::make('hero_title_ar')
                                            ->label('عنوان الهيرو'),

                                        RichEditor::make('hero_description_ar')
                                            ->label('وصف الهيرو'),

                                    ]),

                                Tabs\Tab::make('English')
                                    ->schema([

                                        TextInput::make('hero_title_en')
                                            ->label('Hero Title'),

                                        RichEditor::make('hero_description_en')
                                            ->label('Hero Description'),

                                    ]),

                            ]),

                    ]),

                Section::make('About Company')
                    ->schema([

                        FileUpload::make('image')
                            ->image()
                            ->directory('aboutus')
                            ->imageEditor()
                            ->label('صورة الشركة'),

                        Tabs::make('About Languages')
                            ->tabs([

                                Tabs\Tab::make('العربية')
                                    ->schema([

                                        TextInput::make('title_ar')
                                            ->label('عنوان الشركة'),

                                        RichEditor::make('description_ar')
                                            ->label('نبذة عن الشركة'),

                                    ]),

                                Tabs\Tab::make('English')
                                    ->schema([

                                        TextInput::make('title_en')
                                            ->label('Company Title'),

                                        RichEditor::make('description_en')
                                            ->label('About Company'),

                                    ]),

                            ])

                    ]),

                Section::make('Vision & Mission')
                    ->schema([

                        Tabs::make('Vision Mission')
                            ->tabs([

                                Tabs\Tab::make('العربية')
                                    ->schema([

                                        TextInput::make('vision_title_ar')
                                            ->label('عنوان الرؤية'),

                                        RichEditor::make('vision_ar')
                                            ->label('الرؤية'),

                                        TextInput::make('mission_title_ar')
                                            ->label('عنوان الرسالة'),

                                        RichEditor::make('mission_ar')
                                            ->label('الرسالة'),

                                    ]),

                                Tabs\Tab::make('English')
                                    ->schema([

                                        TextInput::make('vision_title_en')
                                            ->label('Vision Title'),

                                        RichEditor::make('vision_en')
                                            ->label('Vision'),

                                        TextInput::make('mission_title_en')
                                            ->label('Mission Title'),

                                        RichEditor::make('mission_en')
                                            ->label('Mission'),

                                    ]),

                            ]),

                    ]),
                Section::make('السيد المدير')
                    ->schema([

                        FileUpload::make('manager_image')
                            ->image()
                            ->directory('aboutus/manager')
                            ->imageEditor()
                            ->label('صورة السيد المدير'),

                        Tabs::make('Manager Languages')
                            ->tabs([

                                Tabs\Tab::make('العربية')
                                    ->schema([

                                        TextInput::make('manager_name_ar')
                                            ->label('اسم السيد المدير'),

                                        TextInput::make('manager_position_ar')
                                            ->label('المنصب'),

                                        RichEditor::make('manager_message_ar')
                                            ->label('كلمة السيد المدير'),

                                    ]),

                                Tabs\Tab::make('English')
                                    ->schema([

                                        TextInput::make('manager_name_en')
                                            ->label('Manager Name'),

                                        TextInput::make('manager_position_en')
                                            ->label('Position'),

                                        RichEditor::make('manager_message_en')
                                            ->label('Chairmans Message'),

                    ]),

            ]),

    ]),
                Section::make('Statistics')
                    ->schema([

                        TextInput::make('years_experience')
                            ->numeric()
                            ->required()
                            ->label('سنوات الخبرة'),

                        TextInput::make('projects_count')
                            ->numeric()
                            ->required()
                            ->label('عدد المشاريع'),

                        TextInput::make('clients_count')
                            ->numeric()
                            ->required()
                            ->label('عدد العملاء'),

                    ])
                    ->columns(3),

                Section::make('Call To Action')
                    ->schema([

                        Tabs::make('CTA')
                            ->tabs([

                                Tabs\Tab::make('العربية')
                                    ->schema([

                                        TextInput::make('cta_title_ar')
                                            ->label('عنوان CTA'),

                                        RichEditor::make('cta_description_ar')
                                            ->label('وصف CTA'),

                                        TextInput::make('cta_button_text_ar')
                                            ->label('نص الزر'),

                                    ]),

                                Tabs\Tab::make('English')
                                    ->schema([

                                        TextInput::make('cta_title_en')
                                            ->label('CTA Title'),

                                        RichEditor::make('cta_description_en')
                                            ->label('CTA Description'),

                                        TextInput::make('cta_button_text_en')
                                            ->label('Button Text'),

                                    ]),

                            ]),

                        TextInput::make('cta_button_link')
                            ->label('رابط الزر')
                            ->url(),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title_ar')
                    ->label('العنوان'),

                TextColumn::make('years_experience')
                    ->label('الخبرة'),

                TextColumn::make('projects_count')
                    ->label('المشاريع'),

                TextColumn::make('clients_count')
                    ->label('العملاء'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [

            FeaturesRelationManager::class,

            ValuesRelationManager::class,

            TimelinesRelationManager::class,

        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutUs::route('/'),
            'create' => Pages\CreateAboutUs::route('/create'),
            'edit' => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }
}
