<?php

namespace myGedung\Menus\Tests;

use Collective\Html\HtmlServiceProvider;
use myGedung\Menus\MenusServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class BaseTestCase extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();

        // $this->setUpDatabase();
    }

    protected function getPackageProviders($app)
    {
        return [
            HtmlServiceProvider::class,
            MenusServiceProvider::class,
        ];
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('menus', [
            'styles' => [
                'navbar' => \myGedung\Menus\Presenters\Bootstrap\NavbarPresenter::class,
                'navbar-right' => \myGedung\Menus\Presenters\Bootstrap\NavbarRightPresenter::class,
                'nav-pills' => \myGedung\Menus\Presenters\Bootstrap\NavPillsPresenter::class,
                'nav-tab' => \myGedung\Menus\Presenters\Bootstrap\NavTabPresenter::class,
                'sidebar' => \myGedung\Menus\Presenters\Bootstrap\SidebarMenuPresenter::class,
                'navmenu' => \myGedung\Menus\Presenters\Bootstrap\NavMenuPresenter::class,
            ],

            'ordering' => false,
        ]);
    }
}
