<?php

namespace App\Filament\Resources\CfeiResource\Pages;

use App\Filament\Resources\CfeiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCfei extends EditRecord
{
    protected static string $resource = CfeiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
