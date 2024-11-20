<?php

namespace App\Filament\Resources\CfeiResource\Pages;

use App\Filament\Resources\CfeiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCfeis extends ListRecords
{
    protected static string $resource = CfeiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
