<?php

namespace App\Filament\Resources;

use App\Models\Product;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'المنتجات';

    protected static ?string $modelLabel = 'منتج';

    protected static ?string $pluralModelLabel = 'المنتجات';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('بيانات المنتج')
                ->schema([

                    TextInput::make('name_ar')
                        ->label('اسم المنتج عربي')
                        ->required()
                        ->live(),

                    TextInput::make('name_en')
                        ->label('اسم المنتج انجليزي')
                        ->required(),

                    TextInput::make('slug')
                        ->required()
                        ->default(fn ($get) => Str::slug($get('name_en'))),

                    Toggle::make('is_active')
                        ->label('نشط')
                        ->default(true),

                ])->columns(2),

            Section::make('الصورة الرئيسية')
                ->schema([
                    FileUpload::make('featured_image')
                        ->image()
                        ->directory('products')
                        ->imageEditor(),
                ]),

            Section::make('التفاصيل')
                ->schema([

                    RichEditor::make('description_ar')
                        ->label('الوصف عربي')
                        ->columnSpanFull(),

                    RichEditor::make('description_en')
                        ->label('الوصف انجليزي')
                        ->columnSpanFull(),
                ]),

            Section::make('SEO')
                ->schema([

                    TextInput::make('meta_title'),

                    TextInput::make('meta_description'),

                ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('الصورة'),

                Tables\Columns\TextColumn::make('name_ar')
                    ->label('اسم المنتج')
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ImagesRelationManager::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
