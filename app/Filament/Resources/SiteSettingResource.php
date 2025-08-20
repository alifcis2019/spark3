<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'إعدادات الموقع';
    protected static ?string $navigationGroup = 'إعدادات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->label('المفتاح')
                    ->required()
                    ->maxLength(255)
                    ->unique(SiteSetting::class, 'key', ignoreRecord: true),

                Forms\Components\Select::make('type')
                    ->label('النوع')
                    ->options([
                        'text' => 'نص',
                        'textarea' => 'نص طويل',
                        'image' => 'صورة',
                        'url' => 'رابط',
                        'email' => 'بريد إلكتروني',
                    ])
                    ->default('text')
                    ->required()
                    ->live(),

                Forms\Components\Select::make('group')
                    ->label('المجموعة')
                    ->options([
                        'general' => 'عام',
                        'contact' => 'معلومات التواصل',
                        'social' => 'وسائل التواصل الاجتماعي',
                        'seo' => 'تحسين محركات البحث',
                    ])
                    ->default('general')
                    ->required(),

                Forms\Components\TextInput::make('value')
                    ->label('القيمة')
                    ->visible(fn(Forms\Get $get) => in_array($get('type'), ['text', 'url', 'email']))
                    ->required(),

                Forms\Components\Textarea::make('value')
                    ->label('القيمة')
                    ->visible(fn(Forms\Get $get) => $get('type') === 'textarea')
                    ->rows(4)
                    ->required(),

                Forms\Components\FileUpload::make('value')
                    ->label('الصورة')
                    ->visible(fn(Forms\Get $get) => $get('type') === 'image')
                    ->image()
                    ->directory('settings')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('المفتاح')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('group')
                    ->label('المجموعة')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'general' => 'primary',
                        'contact' => 'success',
                        'social' => 'info',
                        'seo' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('type')
                    ->label('النوع')
                    ->badge(),

                Tables\Columns\TextColumn::make('value')
                    ->label('القيمة')
                    ->limit(50)
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->type === 'image') {
                            return $state ? 'صورة مرفوعة' : 'لا توجد صورة';
                        }
                        return $state;
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('المجموعة')
                    ->options([
                        'general' => 'عام',
                        'contact' => 'معلومات التواصل',
                        'social' => 'وسائل التواصل الاجتماعي',
                        'seo' => 'تحسين محركات البحث',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
