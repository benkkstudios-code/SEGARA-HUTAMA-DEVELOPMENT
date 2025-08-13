<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Admin\Pages\KontakDanSetting;
use App\Filament\Admin\Pages\Settings\Settings;
use App\Filament\Pages\App\Profile;
use App\Filament\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Minhk\FilamentLoginMultiAuth\LoginMultiAuthPlugin;
use Outerweb\FilamentSettings\Filament\Plugins\FilamentSettingsPlugin;
use Yebor974\Filament\RenewPassword\RenewPasswordPlugin;

class ManagementPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('management')
            ->path('management')
            ->login()
            ->favicon(asset('icon/fav.png'))
            ->breadcrumbs(false)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->userMenuItems([])
            ->discoverResources(in: app_path('Filament/Management/Resources'), for: 'App\\Filament\\Management\\Resources')
            ->discoverPages(in: app_path('Filament/Management//Pages'), for: 'App\\Filament\\Management\\Pages')
            ->pages([
                KontakDanSetting::class
            ])
            ->discoverWidgets(in: app_path('Filament/Management//Widgets'), for: 'App\\Filament\\Management\\Widgets')
            ->widgets([])
            ->plugins([
                FilamentApexChartsPlugin::make(),
                LoginMultiAuthPlugin::make()
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
