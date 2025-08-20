<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Hero Sections';

    protected static ?string $pluralModelLabel = 'Hero Sections';

    protected static ?string $modelLabel = 'Hero Section';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('محتوى الـ Hero Section')
                    ->description('قم بإدارة محتوى الـ Hero Section الخاص بالصفحة الرئيسية')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('العنوان')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('أدخل عنوان الـ Hero Section'),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('نشط')
                                    ->default(true)
                                    ->helperText('تفعيل أو إلغاء تفعيل هذا الـ Hero Section'),
                            ]),

                        Forms\Components\Textarea::make('description')
                            ->label('الوصف')
                            ->required()
                            ->rows(4)
                            ->placeholder('أدخل وصف الـ Hero Section')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('الصورة')
                            ->image()
                            ->directory('hero-sections')
                            ->disk('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(5120) // 5MB
                            ->helperText('الحد الأقصى: 5MB. الأبعاد المفضلة: 1920x1080px')
                            ->columnSpanFull(),
                    ]),

                Section::make('إعدادات إضافية')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('button_text')
                                    ->label('نص الزر')
                                    ->maxLength(255)
                                    ->placeholder('اقرأ المزيد'),

                                Forms\Components\TextInput::make('button_url')
                                    ->label('رابط الزر')
                                    ->url()
                                    ->placeholder('https://example.com'),
                            ]),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0)
                            ->helperText('الرقم الأصغر يظهر أولاً')
                            ->minValue(0),
                    ])
                    ->collapsed()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('description')
                    ->label('الوصف')
                    ->limit(100)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 100) {
                            return null;
                        }
                        return $state;
                    }),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('الحالة')
                    ->boolean()
                    ->trueLabel('نشط فقط')
                    ->falseLabel('غير نشط فقط')
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
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}
