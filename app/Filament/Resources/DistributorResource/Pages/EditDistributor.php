<?php

namespace App\Filament\Resources\DistributorResource\Pages;

use App\Filament\Resources\DistributorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributor extends EditRecord
{
    protected static string $resource = DistributorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Ubah URL redirect sesuai kebutuhan Anda
        return static::$resource::getUrl('index'); // Redirect ke halaman index
    }
}
