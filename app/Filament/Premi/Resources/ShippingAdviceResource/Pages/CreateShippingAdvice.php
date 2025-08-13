<?php

namespace App\Filament\Premi\Resources\ShippingAdviceResource\Pages;

use App\Filament\Premi\Resources\ShippingAdviceResource;
use App\Models\Premis;
use App\Models\SalesGroups;
use App\Models\User;
use App\Traits\ResourceTrait;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShippingAdvice extends CreateRecord
{
    use ResourceTrait;
    protected static string $resource = ShippingAdviceResource::class;
    protected function afterCreate(): void
    {
        $record = $this->record;

        $group = SalesGroups::where("name", operator: $record->group)->first();
        $users = User::where("group", $group->id)->get();
        $no_tanggal_peb = explode("-", $record->no_tanggal_peb);
        foreach ($users as $user) {
            $premi = 200000;
            if ($user->level == SalesGroups::LEADER) {
                $premi = $premi * 3;
            }
            $data = [
                "user" => $user->id,
                "group" => $group->id,
                "tanggal" => $no_tanggal_peb[1],
                "premi" => $premi,
                "nomor" => $no_tanggal_peb[0],
                "type" => 'SHIPPING ADVICE',
            ];
            Premis::create($data);
        }
    }
}
