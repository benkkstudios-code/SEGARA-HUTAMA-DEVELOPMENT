<?php

namespace App\Filament\Premi\Resources\DataClientResource\Pages;

use App\Filament\Premi\Resources\DataClientResource;
use App\Models\Premis;
use App\Models\SalesGroups;
use App\Models\User;
use App\Traits\ResourceTrait;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDataClient extends CreateRecord
{
    use ResourceTrait;
    protected static string $resource = DataClientResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;

        $group = SalesGroups::where("name", operator: $record->group)->first();
        $users = User::where("group", $group->id)->get();
        foreach ($users as $user) {
            $premi = 200000;
            if ($user->level == SalesGroups::LEADER) {
                $premi = $premi * 3;
            }
            $data = [
                "user" => $user->id,
                "group" => $group->id,
                "tanggal" => $record->tanggal,
                "premi" => $premi,
                "nomor" => $record->nomor,
                "type" => 'NORMAL',
            ];
            Premis::create($data);
        }
    }
}
