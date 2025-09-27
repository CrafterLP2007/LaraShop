<?php

namespace App\Providers\Filament;

use App\Admin\Pages\DashboardPage;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->spa()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Admin/Resources'), for: 'App\Admin\Resources')
            ->discoverResources(in: extensions_path(), for: 'App\\Extensions\\')
            ->discoverPages(in: app_path('Admin/Pages'), for: 'App\Admin\Pages')
            ->discoverPages(in: extensions_path(), for: 'App\\Extensions\\')
            ->pages([
                DashboardPage::class,
            ])
            ->userMenuItems([
                'exit' => MenuItem::make()
                    ->label('Exit Admin')
                    ->url('/')
                    ->icon('heroicon-o-arrow-uturn-left')
            ])
            ->navigationGroups([
                'Shop',
                'Configurations',
                'System',
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css', 'default')
            ->renderHook(
                PanelsRenderHook::SIDEBAR_FOOTER,
                function () {
                    return view('admin.navigation.sidebar-footer');
                }
            )
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
