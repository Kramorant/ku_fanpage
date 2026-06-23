<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaijuResource\Pages;
use App\Models\Kaiju;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KaijuResource extends Resource
{
    protected static ?string $model = Kaiju::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->unique(ignoreRecord: true),
            Forms\Components\FileUpload::make('image_path')->image()->disk('public')->directory('kaijus'),
            Forms\Components\FileUpload::make('thumbnail_path')->image()->disk('public')->directory('kaiju-thumbnails'),
            Forms\Components\Toggle::make('can_fly'),
            Forms\Components\Toggle::make('can_glide'),
            Forms\Components\Repeater::make('kaijuStatSteps')
                ->relationship()
                ->schema([
                    Forms\Components\Select::make('stat')->options([
                        'hp' => 'HP',
                        'speed' => 'Speed',
                        'regen' => 'Regen',
                    ])->required(),
                    Forms\Components\TextInput::make('sp_level')->numeric()->minValue(0)->maxValue(10)->required(),
                    Forms\Components\TextInput::make('value_min')->numeric()->required(),
                    Forms\Components\TextInput::make('value_max')->numeric()->required(),
                ]),
            Forms\Components\Repeater::make('moves')
                ->relationship()
                ->schema([
                    Forms\Components\TextInput::make('name')->required(),
                    Forms\Components\Textarea::make('description'),
                    Forms\Components\TextInput::make('cooldown')->numeric()->required(),
                    Forms\Components\TextInput::make('stamina_cost')->numeric()->required(),
                    Forms\Components\Repeater::make('moveDamageSteps')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('damage_sp_level')->numeric()->minValue(0)->maxValue(10)->required(),
                            Forms\Components\TextInput::make('damage_min')->numeric()->required(),
                            Forms\Components\TextInput::make('damage_max')->numeric()->required(),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('can_fly')->boolean(),
                Tables\Columns\IconColumn::make('can_glide')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKaijus::route('/'),
            'create' => Pages\CreateKaiju::route('/create'),
            'edit' => Pages\EditKaiju::route('/{record}/edit'),
        ];
    }
}
