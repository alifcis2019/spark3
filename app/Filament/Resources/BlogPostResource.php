<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'المدونة';
    protected static ?string $navigationGroup = 'إدارة المحتوى';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Language Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('العربية')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('العنوان (عربي)')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('المقتطف (عربي)')
                                    ->required()
                                    ->rows(3),

                                Forms\Components\RichEditor::make('content')
                                    ->label('المحتوى (عربي)')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Title (English)')
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('excerpt_en')
                                    ->label('Excerpt (English)')
                                    ->rows(3),

                                Forms\Components\RichEditor::make('content_en')
                                    ->label('Content (English)')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('slug')
                    ->label('الرابط')
                    ->required()
                    ->maxLength(255)
                    ->unique(BlogPost::class, 'slug', ignoreRecord: true),

                Forms\Components\FileUpload::make('featured_image')
                    ->label('الصورة المميزة')
                    ->image()
                    ->directory('blog'),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label('تاريخ النشر')
                    ->default(now()),

                Forms\Components\TextInput::make('meta_title')
                    ->label('عنوان SEO')
                    ->maxLength(255),

                Forms\Components\Textarea::make('meta_description')
                    ->label('وصف SEO')
                    ->maxLength(160)
                    ->rows(3),

                Forms\Components\Toggle::make('is_published')
                    ->label('منشور')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('الصورة'),

                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('منشور')
                    ->boolean(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('تاريخ النشر')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('منشور'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
