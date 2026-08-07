<?php

namespace App\Filament\Resources\AboutUsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'values';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title_ar')
                    ->required()
                    ->label('العنوان عربي'),

                Forms\Components\TextInput::make('title_en')
                    ->required()
                    ->label('Title English'),

                Forms\Components\TextInput::make('icon')
                    ->label('Icon')
                    ->helperText('مثال: fa-award'),

                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->label('الترتيب'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title_ar')
            ->columns([

                Tables\Columns\TextColumn::make('title_ar')
                    ->label('العنوان'),

                Tables\Columns\TextColumn::make('icon')
                    ->label('الأيقونة'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable()
                    ->label('الترتيب'),

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
