<?php

namespace App\Filament\Resources\HolidayPackageResource\Pages;

use App\Filament\Resources\HolidayPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHolidayPackage extends CreateRecord
{
    protected static string $resource = HolidayPackageResource::class;

    // protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    // {
    //     $record = static::getModel()::create($data);
    // }
}
