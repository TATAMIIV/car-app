<?php

namespace App\Filament\Resources\CarModels\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Notifications\Notification;
use App\Models\CarModel;

class CarModelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("code")->label("รหัสสินค้า")->searchable()->sortable(),
                TextColumn::make("brand")->label("ยี่ห้อ")->searchable(),
                TextColumn::make("name")->label("ชื่อรุ่น")->searchable(),
                TextColumn::make("year")->label("ปี"),
                TextColumn::make("body_type")->label("ประเภทตัวถัง"),
                TextColumn::make("base_price")->label("ราคา")->money('THB'),
                IconColumn::make("is_active")->label("สถานะ")->boolean(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),

                \Filament\Actions\DeleteAction::make('customDelete')
                    ->label('ลบ')
                    ->modalHeading('ระบุเหตุผลการลบ')
                    ->form([
                        \Filament\Forms\Components\Select::make('deletion_reason')
                            ->label('เหตุผล')
                            ->options([
                                'ยกเลิกการผลิต' => 'ยกเลิกการผลิต',
                                'ข้อมูลซ้ำ' => 'ข้อมูลซ้ำ',
                                'ข้อมูลไม่ถูกต้อง' => 'ข้อมูลไม่ถูกต้อง',
                                'อื่นๆ' => 'อื่นๆ',
                            ])
                            ->required()
                            ->live(),
                        \Filament\Forms\Components\Textarea::make('deletion_detail')
                            ->label('รายละเอียด')
                            ->required(fn(\Filament\Schemas\Components\Utilities\Get $get) => $get('deletion_reason') === 'อื่นๆ'),
                    ])
                    ->requiresConfirmation()
                    ->modalDescription(fn(CarModel $record) => "คุณต้องการลบรุ่น {$record->brand} {$record->name} ({$record->code}) ใช่หรือไม่?")
                    ->action(function (CarModel $record, array $data) {
                        $userName = auth()->user()->name;
                        $carInfo = "{$record->brand} {$record->name} ({$record->code})";

                        $record->update([
                            'deletion_reason' => $data['deletion_reason'],
                            'deletion_detail' => $data['deletion_detail'],
                        ]);
                        $record->delete();

                        event(new \App\Events\CarModelDeletedEvent($userName, $carInfo));

                        Notification::make()
                            ->title('ลบข้อมูลเรียบร้อย')
                            ->success()
                            ->send();
                    })
                    ->color('danger'),
            ]);
    }
}