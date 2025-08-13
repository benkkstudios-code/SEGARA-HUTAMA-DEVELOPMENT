<?php

namespace App\Filament\Premi\Resources\SurveyorResource\Pages;

use App\Filament\Premi\Resources\SurveyorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSurveyor extends EditRecord
{
    protected static string $resource = SurveyorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
