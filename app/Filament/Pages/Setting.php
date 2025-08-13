<?php

namespace App\Filament\Pages;

use App\Models\Settings;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Actions\Action;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class Setting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.setting';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $title = 'Pengaturan Invoice';

    public array $data = [];

    public $model = null;

    public function mount(): void
    {

        $this->model = Settings::first();

        $this->data = $this->model->toArray();
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('penandatangan')->label('Penandatangan Invoice'),
                Forms\Components\TextInput::make('ppn')->numeric()->maxValue(100)->label('Persentase PPN')->prefix('%'),
                Forms\Components\TextInput::make('pph')->numeric()->maxValue(100)->label('Persentase PPH')->prefix('%'),

            ])
            ->statePath('data')
            ->model($this->model);
    }


    public function submit()
    {
        $user = Auth::user();

        if ($user->hasAccess()) {
            $update = $this->model->update($this->form->getState());
            if ($update) {
                \Filament\Notifications\Notification::make()
                    ->title('Setting update succesfully')
                    ->success()
                    ->send();
            } else {
                \Filament\Notifications\Notification::make()
                    ->title('Setting not updated')
                    ->danger()
                    ->send();
            }
        } else {
            \Filament\Notifications\Notification::make()
                ->title('Kamu tidak mempunyai akses untuk ini')
                ->danger()
                ->send();
        }
    }
}
