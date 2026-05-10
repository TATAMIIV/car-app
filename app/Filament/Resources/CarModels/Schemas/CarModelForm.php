<?php

namespace App\Filament\Resources\CarModels\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class CarModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('code')
                ->label('รหัสสินค้า')
                ->required()
                ->unique(ignoreRecord: true)
                ->regex('/^CM-\d{4}$/')
                ->placeholder('CM-0001'),

            Forms\Components\Select::make('brand')
                ->label('ยี่ห้อ')
                ->options([
                    'Toyota' => 'Toyota',
                    'Honda' => 'Honda',
                    'Ford' => 'Ford',
                ])->required(),

            Forms\Components\TextInput::make('name')
                ->label('ชื่อรุ่น')
                ->required(),

            Forms\Components\TextInput::make('year')
                ->label('ปี (ค.ศ.)')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('body_type')
                ->label('ประเภทตัวถัง')
                ->options([
                    'Sedan' => 'Sedan',
                    'SUV' => 'SUV',
                    'Pickup' => 'Pickup',
                    'Hatchback' => 'Hatchback',
                    'Van' => 'Van',
                ])->required(),

            Forms\Components\TextInput::make('base_price')
                ->label('ราคา')
                ->numeric()
                ->prefix('฿')
                ->required(),

            Forms\Components\Toggle::make('is_active')
                ->label('สถานะ')
                ->default(true),
        ]);
    }
}