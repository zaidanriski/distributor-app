<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObatResource\Pages;
use App\Filament\Resources\ObatResource\RelationManagers;
use App\Models\Obat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ObatResource extends Resource
{
    protected static ?string $model = Obat::class;

    protected static ?string $navigationIcon = 'heroicon-m-inbox-stack';

    protected static ?string $navigationLabel = 'Obat';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_obat')
                    ->label('Kode Obat')
                    ->default(fn () => 'DB' . str_pad((Obat::max('id') + 1) ?? 1, 5, '0', STR_PAD_LEFT))
                    ->rules(function ($livewire) {
                        // Hanya berlaku unique saat create
                        return $livewire instanceof \Filament\Resources\Pages\CreateRecord
                            ? ['unique:obats,kode_obat']
                            : [];
                    })
                    ->required()
                    ->minValue(5)
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_obat')
                    ->label('Nama Obat')
                    ->required()
                    ->minValue(4)
                    ->maxLength(255),
                Forms\Components\TextInput::make('zat_aktif')
                    ->label('Zat Aktif'),
                Forms\Components\TextInput::make('bentuk_dan_kekuatan')
                    ->label('Bentuk dan kekuatan'),
                Forms\Components\TextInput::make('satuan')
                    ->required()
                    ->label('Satuan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_obat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_obat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('zat_aktif')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bentuk_dan_kekuatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObats::route('/'),
            'create' => Pages\CreateObat::route('/create'),
            'edit' => Pages\EditObat::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return Auth::user()->role == 'admin' ? true : false;
    }
}
