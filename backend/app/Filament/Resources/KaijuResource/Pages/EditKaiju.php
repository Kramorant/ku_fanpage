<?php

namespace App\Filament\Resources\KaijuResource\Pages;

use App\Filament\Resources\KaijuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKaiju extends EditRecord
{
    protected static string $resource = KaijuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
