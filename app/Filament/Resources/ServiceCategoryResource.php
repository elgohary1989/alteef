<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceCategoryResource\Pages;
use App\Filament\Resources\ServiceCategoryResource\RelationManagers;
use App\Models\ServiceCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;
    protected static ?string $navigationLabel = 'تصنيفات الخدمات';

    protected static ?string $modelLabel = 'تصنيف خدمة';

    protected static ?string $pluralModelLabel = 'تصنيفات الخدمات';

    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Grid::make(2)
                ->schema([

                    Forms\Components\Section::make('العربية')
                        ->schema([

                            Forms\Components\TextInput::make('name_ar')
                                ->required()
                                ->live(onBlur:true)
                                ->afterStateUpdated(function($state, callable $set){

                                    $set('slug', \Illuminate\Support\Str::slug($state));

                                }),

                            Forms\Components\Textarea::make('description_ar'),

                        ]),

                    Forms\Components\Section::make('English')
                        ->schema([

                            Forms\Components\TextInput::make('name_en')
                                ->required(),

                            Forms\Components\Textarea::make('description_en'),

                        ])

                ]),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord:true),

            Forms\Components\FileUpload::make('image')
                ->directory('service-categories')
                ->image(),

            Forms\Components\TextInput::make('icon')
                ->helperText('heroicon-o-cog'),

            Forms\Components\TextInput::make('order')
                ->numeric()
                ->default(0),

            Forms\Components\Toggle::make('is_active')
                ->default(true)

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([

                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة'),

                Tables\Columns\TextColumn::make('name_ar')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name_en')
                    ->searchable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

            ])

            ->defaultSort('order')

            ->reorderable('order')

            ->actions([

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make(),

            ])

            ->bulkActions([

                Tables\Actions\DeleteBulkAction::make()

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
            'index' => Pages\ListServiceCategories::route('/'),
            'create' => Pages\CreateServiceCategory::route('/create'),
            'edit' => Pages\EditServiceCategory::route('/{record}/edit'),
        ];
    }
}
