<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\PostCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationLabel = 'المقالات';

    protected static ?string $modelLabel = 'مقال';

    protected static ?string $pluralModelLabel = 'المقالات';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('بيانات المقال الأساسية')
                    ->schema([

                        Forms\Components\Select::make('post_category_id')
                            ->label('التصنيف')
                            ->options(PostCategory::query()->orderBy('order')->pluck('name_ar', 'id'))
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Forms\Components\TextInput::make('title_ar')
                            ->label('عنوان المقال بالعربي')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if (! empty($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('title_en')
                            ->label('عنوان المقال بالإنجليزي')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('slug')
                            ->label('رابط المقال Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('مثال: web-design-company-in-egypt'),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('ملخص المقال')
                    ->schema([

                        Forms\Components\Textarea::make('excerpt_ar')
                            ->label('ملخص المقال بالعربي')
                            ->rows(4)
                            ->maxLength(500)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('excerpt_en')
                            ->label('ملخص المقال بالإنجليزي')
                            ->rows(4)
                            ->maxLength(500)
                            ->columnSpanFull(),

                    ]),

                Forms\Components\Section::make('محتوى المقال')
                    ->schema([

                        Forms\Components\RichEditor::make('content_ar')
                            ->label('محتوى المقال بالعربي')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content_en')
                            ->label('محتوى المقال بالإنجليزي')
                            ->columnSpanFull(),

                    ]),

                Forms\Components\Section::make('صورة المقال')
                    ->schema([

                        Forms\Components\FileUpload::make('featured_image')
                            ->label('الصورة الرئيسية')
                            ->image()
                            ->directory('posts')
                            ->imageEditor()
                            ->disk('public')
                            ->visibility('public')
                            ->columnSpanFull(),

                    ]),

                Forms\Components\Section::make('إعدادات SEO')
                    ->schema([

                        Forms\Components\TextInput::make('meta_title')
                            ->label('SEO Title')
                            ->maxLength(255)
                            ->helperText('الأفضل من 50 إلى 60 حرف'),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(170)
                            ->helperText('الأفضل من 140 إلى 160 حرف'),

                        Forms\Components\TagsInput::make('keywords')
                            ->label('Keywords')
                            ->separator(',')
                            ->placeholder('SEO, Laravel, تصميم مواقع'),

                    ])
                    ->columns(1),


                Forms\Components\Section::make('النشر')
                    ->schema([

                        Forms\Components\Toggle::make('published')
                            ->label('منشور؟')
                            ->default(true),

                    ])
                    ->columns(1),

                Forms\Components\Section::make('المصدر والتاريخ')
                    ->schema([

                        Forms\Components\TextInput::make('source_name_ar')
                            ->label('اسم المصدر بالعربي')
                            ->placeholder('مثال: فريق الشركة')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('source_name_en')
                            ->label('اسم المصدر بالإنجليزي')
                            ->placeholder('Example: Company Team')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('source_url')
                            ->label('رابط المصدر')
                            ->url()
                            ->placeholder('https://example.com')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('reading_time')
                            ->label('مدة القراءة بالدقائق')
                            ->numeric()
                            ->default(5)
                            ->minValue(1)
                            ->maxValue(60),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('تاريخ المقال')
                            ->seconds(false)
                            ->default(now()),

                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('الصورة')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('title_ar')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('category.name_ar')
                    ->label('التصنيف')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\IconColumn::make('published')
                    ->label('منشور')
                    ->boolean(),

                Tables\Columns\TextColumn::make('views')
                    ->label('المشاهدات')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('تاريخ النشر')
                    ->dateTime('Y-m-d')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('source_name_ar')
                    ->label('المصدر')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('reading_time')
                    ->label('مدة القراءة')
                    ->suffix(' د. قراءة')
                    ->sortable(),



            ])
            ->filters([

                Tables\Filters\SelectFilter::make('post_category_id')
                    ->label('التصنيف')
                    ->options(PostCategory::query()->pluck('name_ar', 'id')),

                Tables\Filters\TernaryFilter::make('published')
                    ->label('حالة النشر')
                    ->trueLabel('منشور')
                    ->falseLabel('غير منشور')
                    ->native(false),

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('تعديل'),

                Tables\Actions\DeleteAction::make()
                    ->label('حذف'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('حذف المحدد'),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
