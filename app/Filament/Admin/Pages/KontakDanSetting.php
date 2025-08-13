<?php

namespace App\Filament\Admin\Pages;

use App\Config\constants;
use App\Models\AboutPages;
use App\Models\HomeSetting;
use App\Models\Kontak;
use App\Models\Project;
use App\Models\ServicesPages;
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

class KontakDanSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.setting';


    protected static ?string $title = constants::Website;

    public array $data = [];

    public $model = null;

    public function mount(): void
    {

        $this->model = Kontak::first();
        $this->form->fill($this->model->toArray());
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Website')
                    ->required(),
                Textarea::make('kantor_operasional')
                    ->label('KANTOR OPERASIONAL')
                    ->autosize()
                    ->required(),
                Textarea::make('kantor_administrasi')
                    ->label('KANTOR ADMINISTRASI')
                    ->autosize()
                    ->required(),
                Section::make('Email')
                    ->schema([
                        Repeater::make('email')
                            ->schema([
                                TextInput::make('email')
                                    ->label('Email')
                                    ->required()
                                    ->email(),
                            ]),
                    ]),
                Section::make('phone')
                    ->schema([
                        Repeater::make('phone')
                            ->schema([
                                TextInput::make('phone')
                                    ->label('phone')
                                    ->required(),
                            ]),
                    ]),
                Section::make('sosial media')
                    ->schema([
                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->url()
                            ->required(),
                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->url()
                            ->required(),
                        TextInput::make('twiter')
                            ->label('Twitter')
                            ->url()
                            ->required(),
                        TextInput::make('linkedin')
                            ->label('linkedin')
                            ->url()
                            ->required(),
                    ]),
                FileUpload::make('header_image')
                    ->label('Gambar Halaman')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('upload')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])

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
