<?php

namespace App\Filament\Resources\ObatResource\Pages;

use App\Filament\Resources\ObatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateObat extends CreateRecord
{
    protected static string $resource = ObatResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        // Ubah URL redirect sesuai kebutuhan Anda
        return static::$resource::getUrl('index'); // Redirect ke halaman index
    }
}
