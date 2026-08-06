<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationGroup = 'محتوى الموقع';
    protected static ?string $navigationLabel = 'معرض الأعمال';
    protected static ?string $modelLabel = 'مشروع';
    protected static ?string $pluralModelLabel = 'المشاريع';


    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Tabs::make('بيانات المشروع')
                    ->columnSpanFull()
                    ->tabs([

                        Forms\Components\Tabs\Tab::make('البيانات الاساسية')
                            ->schema([

                                Forms\Components\Grid::make(2)
                                    ->schema([

                                        Forms\Components\TextInput::make('title_ar')
                                            ->label('عنوان المشروع بالعربية')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                if ($state) {
                                                    $set('slug', Str::slug($state));
                                                }
                                            }),

                                        Forms\Components\TextInput::make('title_en')
                                            ->label('عنوان المشروع بالانجليزية')
                                            ->required()
                                            ->maxLength(255),

                                    ]),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(
                                        table: Project::class,
                                        column: 'slug',
                                        ignoreRecord: true
                                    )
                                    ->maxLength(255)
                                    ->helperText('Example: ecommerce-website'),

                                Forms\Components\Grid::make(2)
                                    ->schema([

                                        Forms\Components\Select::make('sector_id')
                                            ->label('Sector')
                                            ->relationship(
                                                name: 'sector',
                                                titleAttribute: 'title_ar'
                                            )
                                            ->getOptionLabelFromRecordUsing(function (Sector $record) {
                                                return $record->title_ar ?? $record->title_en;
                                            })
                                            ->searchable()
                                            ->preload()
                                            ->nullable(),

                                        Forms\Components\TextInput::make('client_name')
                                            ->label('اسم العميل')
                                            ->maxLength(255)
                                            ->nullable(),

                                    ]),

                                Forms\Components\Grid::make(2)
                                    ->schema([

                                        Forms\Components\TextInput::make('project_type')
                                            ->label('Project Type')
                                            ->placeholder('Website, Ecommerce, ERP, Mobile App')
                                            ->maxLength(255)
                                            ->nullable(),

                                        Forms\Components\TextInput::make('project_year')
                                            ->label('Project Year')
                                            ->numeric()
                                            ->minValue(2000)
                                            ->maxValue(2100)
                                            ->nullable(),

                                    ]),

                                Forms\Components\TextInput::make('project_url')
                                    ->label('Project URL')
                                    ->url()
                                    ->maxLength(255)
                                    ->nullable()
                                    ->placeholder('https://example.com'),

                                Forms\Components\TextInput::make('technologies')
                                    ->label('Technologies')
                                    ->placeholder('Laravel, Filament, Tailwind, Livewire')
                                    ->maxLength(255)
                                    ->nullable(),

                            ]),

                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([

                                Forms\Components\Textarea::make('summary_ar')
                                    ->label('Summary Arabic')
                                    ->rows(4)
                                    ->nullable()
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('summary_en')
                                    ->label('Summary English')
                                    ->rows(4)
                                    ->nullable()
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('content_ar')
                                    ->label('Content Arabic')
                                    ->nullable()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'bulletList',
                                        'orderedList',
                                        'h2',
                                        'h3',
                                        'blockquote',
                                        'link',
                                        'undo',
                                        'redo',
                                    ])
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('content_en')
                                    ->label('Content English')
                                    ->nullable()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'bulletList',
                                        'orderedList',
                                        'h2',
                                        'h3',
                                        'blockquote',
                                        'link',
                                        'undo',
                                        'redo',
                                    ])
                                    ->columnSpanFull(),

                            ]),

                        Forms\Components\Tabs\Tab::make('Images')
                            ->schema([

                                Forms\Components\FileUpload::make('cover_image')
                                    ->label('Cover Image')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('projects/covers')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(4096)
                                    ->nullable()
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('thumbnail_image')
                                    ->label('Thumbnail Image')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('projects/thumbnails')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(4096)
                                    ->nullable()
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('gallery')
                                    ->label('Project Gallery')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->imageEditor()
                                    ->directory('projects/gallery')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(4096)
                                    ->nullable()
                                    ->columnSpanFull(),

                            ]),

                        Forms\Components\Tabs\Tab::make('Settings')
                            ->schema([

                                Forms\Components\Grid::make(3)
                                    ->schema([

                                        Forms\Components\TextInput::make('order')
                                            ->label('Order')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        Forms\Components\TextInput::make('color')
                                            ->label('Card Color')
                                            ->placeholder('#0f172a')
                                            ->maxLength(255)
                                            ->nullable(),

                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->default(true),

                                    ]),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Featured Project')
                                    ->default(false),

                            ]),
                        Forms\Components\Tabs\Tab::make('Modules')
                            ->schema([

                                Forms\Components\Repeater::make('modules')
                                    ->label('وحدات المشروع')
                                    ->schema([

                                        Forms\Components\Grid::make(2)
                                            ->schema([

                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('العنوان بالعربية')
                                                    ->required(),

                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('العنوان بالإنجليزية')
                                                    ->required(),

                                            ]),

                                        Forms\Components\Textarea::make('description_ar')
                                            ->label('الوصف بالعربية')
                                            ->rows(3),

                                        Forms\Components\Textarea::make('description_en')
                                            ->label('الوصف بالإنجليزية')
                                            ->rows(3),

                                        Forms\Components\FileUpload::make('icon')
                                            ->label('أيقونة')
                                            ->image()
                                            ->directory('projects/modules')
                                            ->disk('public')
                                            ->visibility('public')
                                            ->imageEditor(),

                                        Forms\Components\ColorPicker::make('color')
                                            ->label('لون الأيقونة')
                                            ->default('#2563eb'),

                                    ])
                                    ->columns(1)
                                    ->defaultItems(0)
                                    ->addActionLabel('إضافة Module')
                                    ->reorderable()
                                    ->collapsible()
                                    ->cloneable(),

                            ]),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order')
            ->columns([

                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Image')
                    ->disk('public')
                    ->square()
                    ->defaultImageUrl(asset('images/default-project.png')),

                Tables\Columns\TextColumn::make('title_ar')
                    ->label('Arabic Title')
                    ->searchable()
                    ->sortable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('title_en')
                    ->label('English Title')
                    ->searchable()
                    ->sortable()
                    ->limit(35),


                Tables\Columns\TextColumn::make('sector.title_ar')
                    ->label('القطاع')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('project_type')
                    ->label('Type')
                    ->badge()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('project_year')
                    ->label('Year')
                    ->sortable()
                    ->placeholder('-'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([


                Tables\Filters\SelectFilter::make('sector_id')
                    ->relationship('sector', 'title_ar')
                    ->label('القطاع')
                    ->searchable()
                    ->preload()
                ,

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),

            ])
            ->actions([

                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([

                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\DeleteBulkAction::make(),

                ]),

            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('sector');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
