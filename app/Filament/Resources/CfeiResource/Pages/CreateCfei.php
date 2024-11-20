<?php

namespace App\Filament\Resources\CfeiResource\Pages;

use App\Filament\Resources\CfeiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCfei extends CreateRecord
{
    protected static string $resource = CfeiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
