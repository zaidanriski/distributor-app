<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Report extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.report';

    protected static ?string $navigationGroup = 'Report';

    public static function canAccess(): bool
    {
        return Auth::user()->role == 'pemimpin' ? true : false;
    }
}
