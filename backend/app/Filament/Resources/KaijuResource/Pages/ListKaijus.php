<?php

namespace App\Filament\Resources\KaijuResource\Pages;

use App\Filament\Resources\KaijuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKaijus extends ListRecords
{
    protected static string $resource = KaijuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
