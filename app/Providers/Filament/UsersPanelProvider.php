<?php

namespace App\Providers\Filament;

use Filament\Pages;
//use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
//use Filament\Pages\Dashboard;
//use App\Filament\Users\Pages\Profile;
use App\Filament\Pages\Testing;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\MyDetails;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use App\Filament\Pages\ProfileUpdate;
use Filament\Navigation\NavigationItem;
use App\Filament\Users\Pages\EditProfile;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\Resources\NewsRecipientResource;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
//use App\Filament\Users\Pages\MyDetails;

class UsersPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('users')
            ->path('users')

            ->login()
            ->passwordReset()
             ->emailVerification()
            ->colors([
                'primary' => Color::Green,
            ])  ->favicon(asset('assets/images/Aliveng.png'))
            ->brandLogo(asset('assets/images/Aliveng.png'))
            // ->colors([
            //     'primary' => Color::Blue,
            // ])
            ->plugins([
                FilamentBackgroundsPlugin::make()
                ->showAttribution(false),
            ])



            ->discoverResources(in: app_path('Filament/Users/Resources'), for: 'App\\Filament\\Users\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Users\\Pages')
            ->pages([
              // pages\Dashboard::class,
               ProfileUpdate::class,
              Dashboard::class,
               MyDetails::class
            ])
            ->discoverWidgets(in: app_path('Filament/Users/Widgets'), for: 'App\\Filament\\Users\\Widgets')
            ->widgets([
                //Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->resources([
                NewsRecipientResource::class
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
