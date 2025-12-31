<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Schemas\Schema;


class HeroSlideForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Content')
                    ->schema([
                        TextInput::make('title')
                            ->label('Slide Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter slide title'),

                        TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter subtitle'),

                        Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->rows(4)
                            ->placeholder('Enter slide description'),
                    ])
                    ->columns(1),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Slide Image')
                            ->required()
                            ->image()
                            ->directory('hero-slides')
                            ->maxSize(2048) // 2MB
                            ->helperText('Upload the main slide image (max: 2MB)')
                            ->previewable()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080'),

                        FileUpload::make('icon')
                            ->label('Icon (Optional)')
                            ->image()
                            ->directory('hero-icons')
                            ->maxSize(512) // 512KB
                            ->helperText('Upload an optional icon (max: 512KB)')
                            ->previewable()
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make('Settings')
                    ->schema([
                        TextInput::make('order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->step(1)
                            ->helperText('Lower numbers appear first'),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Show this slide on the website'),
                    ])
                    ->columns(2),
            ]);
    }
}