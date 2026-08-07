<?php

namespace App\Filament\Resources\AboutUsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TimelinesRelationManager extends RelationManager
{
    protected static string $relationship = 'timelines';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('year')
                    ->required()
                    ->label('السنة'),

                Forms\Components\TextInput::make('title_ar')
                    ->required()
                    ->label('العنوان عربي'),

                Forms\Components\TextInput::make('title_en')
                    ->required()
                    ->label('Title English'),

                Forms\Components\Textarea::make('description_ar')
                    ->rows(4)
                    ->label('الوصف عربي'),

                Forms\Components\Textarea::make('description_en')
                    ->rows(4)
                    ->label('Description English'),

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

                Tables\Columns\TextColumn::make('year')
                    ->label('السنة'),

                Tables\Columns\TextColumn::make('title_ar')
                    ->label('العنوان'),

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
