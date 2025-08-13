<?php

namespace App\Filament\Premi\Pages;

use App\Models\DataClients;
use App\Models\Premis;
use App\Models\SalesGroups;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\HtmlString;

class DetailDataClient extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.premi.pages.detail-data-client';

    protected static bool $shouldRegisterNavigation = false;

    public array $data = [];

    public $model = null;
    public static function getSlug(): string
    {
        return 'detail-data-client/{id}';
    }

    public function mount($id): void
    {


        $this->model = DataClients::findOrFail($id);

        $this->model->premis = Premis::where('nomor', $this->model->nomor)->get()->toArray();
        $this->model->info = [
            'NOMOR TRANSAKSI' => $this->model->nomor,
            'JENIS TRANSAKSI' =>  $this->model->premis[0]['type'],
            'TANGGAL' => Carbon::parse(DateTime::createFromFormat('Y-m-d', $this->model->tanggal))->translatedFormat('l, d M Y'),
            'SALES' => User::find($this->model->user)->name,
            'GROUP' =>  SalesGroups::find(User::find($this->model->user)->group)->name,

        ];
        $this->form->fill($this->model->toArray());
    }





    public function form(Form $form): Form
    {
        return $form
            ->schema([
                KeyValue::make('info')
                    ->addable(false)
                    ->deletable(false)
                    ->editableKeys(false)
                    ->editableValues(false)
                    ->valueLabel('')
                    ->keyLabel(''),

                Repeater::make('premis')
                    ->label('Premi')
                    ->grid(1)
                    ->columnSpanFull()
                    ->reorderable(false)
                    ->addable(false)
                    ->deletable(false)

                    ->schema([
                        TextInput::make('user')
                            ->label('Nama Sales')
                            ->readOnly()
                            ->reactive()
                            ->afterStateHydrated(function (TextInput $component, $state) {
                                $component->state(ucwords(User::find($state)->name));
                            }),
                        TextInput::make('premi')
                            ->prefix('Rp.')
                            ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                            ->required(),
                        Actions::make([
                            Action::make('nbayar')
                                ->label('BAYAR PREMI')
                                ->color('danger')
                                ->action(function (array $record) {
                                    if ($record['status'] == 'Belum Dibayar') {
                                        Redirect('Belum Dibayar');
                                    } else {
                                        Redirect('Sudah Dibayar');
                                    }
                                }),

                        ])->alignEnd(),
                    ])
            ])
            ->statePath('data')
            ->model($this->model);
    }
}
