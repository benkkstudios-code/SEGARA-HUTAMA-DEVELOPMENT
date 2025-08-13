<?php

namespace App\Filament\Admin\Pages;

use App\Config\constants;
use App\Models\AboutPages;
use App\Models\HomeSetting;
use App\Models\ServicesPages;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Textarea;

class ServicesPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?int $navigationSort = 12;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.setting';

    protected static ?string $title = constants::Services;

    public array $data = [];

    public $model = null;

    public function mount(): void
    {

        $this->model = ServicesPages::first();
        $this->form->fill($this->model->toArray());
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->required(),
                TextInput::make('description')
                    ->label('Deskripsi')
                    ->required(),
                Repeater::make('content')
                    ->label('Layanan')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Layanan')
                            ->required(),
                        TextInput::make('description')
                            ->label('Deskripsi Layanan')
                            ->required(),
                        FileUpload::make('image')
                            ->label('Gambar Layanan')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('upload')
                            ->visibility('public')
                            ->preserveFilenames()
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
