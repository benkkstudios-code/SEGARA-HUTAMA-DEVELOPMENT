<?php

namespace App\Filament\Admin\Pages;

use App\Config\constants;
use App\Models\AboutPages;
use App\Models\Carousels;
use App\Models\Direksis;
use App\Models\HomeSetting;
use App\Models\Kontak;
use App\Models\Project;
use App\Models\ServicesPages;
use COM;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Textarea;

class Direksi extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.setting';


    protected static ?string $title = constants::Direksi;

    public array $data = [];

    public $model = null;

    public function mount(): void
    {

        $this->model = Direksis::first();
        $this->form->fill($this->model->toArray());
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('content')
                    ->label('Direksi')
                    ->schema([
                        TextInput::make('nama')
                            ->required(),
                        TextInput::make('Jabatan')
                            ->required(),
                        TextInput::make('nik')
                            ->label('NI.Segara')
                            ->prefix('SHG-')
                            ->required(),
                        Textarea::make('portofolio')
                            ->autosize()
                            ->label('Portofolio'),
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('upload')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ]),
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
