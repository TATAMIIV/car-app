<?php

namespace App\Filament\Resources\CarModels\Pages;

use App\Filament\Resources\CarModels\CarModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

class ListCarModels extends ListRecords
{
    protected static string $resource = CarModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getListeners(): array
    {
        return [
            "echo:car-monitoring,.App\Events\CarModelDeletedEvent" => 'notifyCarDeleted',
        ];
    }

    public function notifyCarDeleted($data): void
    {
        \Illuminate\Support\Facades\Log::info("Received CarModelDeletedEvent in notifyCarDeleted", $data);
        Notification::make()
            ->title('ตรวจพบการลบข้อมูล!')
            ->body("คุณ {$data['userName']} ได้ลบข้อมูลรถยนต์: {$data['carInfo']}")
            ->danger()
            ->persistent()
            ->send();

        $this->dispatch('refreshTable');
    }

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];
}