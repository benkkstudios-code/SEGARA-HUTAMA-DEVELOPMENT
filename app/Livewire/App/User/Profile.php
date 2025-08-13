<?php

namespace App\Livewire\App\User;

use App\Filament\Pages\App\Profile as AppProfile;
use App\Filament\Pages\User\Profile as ProfilePage;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    public ?array $state = [];

    public $photo;

    /** @var \App\Model\User */
    public $user;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->state = $this->user?->withoutRelations()->toArray();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('username')
                ->label('Username')
                ->regex('/^[a-z0-9_-]{3,15}$/i')
                ->unique(User::class, 'username', modifyRuleUsing: function (Unique $rule) {
                    return $rule->whereNot('id', auth()->user()->id);
                })
                ->required()
                ->disabledOn('edit'),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->unique(User::class, 'email', modifyRuleUsing: function (Unique $rule) {
                    return $rule->whereNot('id', auth()->user()->id);
                })
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('name')
                ->label('Nama Panjang')
                ->required()
                ->maxLength(255),
        ])->statePath('state');
    }

    public function save(): void
    {
        $this->resetErrorBag();
        $this->validate();

        if (isset($this->photo)) {
            $this->user->updateAvatar($this->photo);
        }

        $this->user->forceFill([
            'username' => $this->state['username'],
            'email' => $this->state['email'],
            'name' => $this->state['name'],
        ])->save();

        if (isset($this->photo)) {
            redirect(AppProfile::getUrl());
        }

        Notification::make()->success()->title('Profile berhasil diperbarui.')->send();
    }

    public function deleteAvatar(): void
    {
        $this->user?->deleteAvatar();
        redirect(AppProfile::getUrl());
    }

    public function getUserProperty(): ?Authenticatable
    {
        return Auth::user();
    }

    public function render()
    {
        return view('livewire.app.user.profile');
    }
}
