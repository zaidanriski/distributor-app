<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistributorResource\Pages;
use App\Filament\Resources\DistributorResource\RelationManagers;
use App\Models\Distributor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DistributorResource extends Resource
{
    protected static ?string $model = Distributor::class;

    protected static ?string $navigationIcon = 'heroicon-c-shopping-cart';

    protected static ?string $navigationLabel = 'Distributor';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_distributor')
                    ->label('Kode Distributor')
                    ->default(fn () => 'DB' . str_pad((Distributor::max('id') + 1) ?? 1, 5, '0', STR_PAD_LEFT))
                    ->rules(function ($livewire) {
                        // Hanya berlaku unique saat create
                        return $livewire instanceof \Filament\Resources\Pages\CreateRecord
                            ? ['unique:distributors,kode_distributor']
                            : [];
                    })
                    ->required()
                    ->minValue(5)
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_indsutri')
                    ->label('Nama Industri')
                    ->required()
                    ->minValue(4)
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat'),
                Forms\Components\TextInput::make('telepon')
                    ->label('Telepon')
                    ->tel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_distributor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_indsutri')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDistributors::route('/'),
            'create' => Pages\CreateDistributor::route('/create'),
            'edit' => Pages\EditDistributor::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return Auth::user()->role == 'admin' ? true : false;
    }
}
