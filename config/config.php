<?php

return [

    'styles' => [
        'navbar' => \myGedung\Menus\Presenters\Bootstrap\NavbarPresenter::class,
        'navbar-right' => \myGedung\Menus\Presenters\Bootstrap\NavbarRightPresenter::class,
        'nav-pills' => \myGedung\Menus\Presenters\Bootstrap\NavPillsPresenter::class,
        'nav-tab' => \myGedung\Menus\Presenters\Bootstrap\NavTabPresenter::class,
        'sidebar' => \myGedung\Menus\Presenters\Bootstrap\SidebarMenuPresenter::class,
        'navmenu' => \myGedung\Menus\Presenters\Bootstrap\NavMenuPresenter::class,
        'adminlte' => \myGedung\Menus\Presenters\Admin\AdminltePresenter::class,
        'zurbmenu' => \myGedung\Menus\Presenters\Foundation\ZurbMenuPresenter::class,
    ],

    'ordering' => false,

];
