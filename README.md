# **Introduction**

```mygedung/menus``` is a laravel package which created to manage menus. It has a feature called presenters which enables easy styling and custom structure of menu rendering.

This package is a re-published, re-organised and maintained version of ```pingpong/menus```, which isn't maintained anymore. This package is used in ```myGedung```.

With one big added bonus that the original package didn't have: **tests**.

## **Quick Example**

``` bash
// Menu.php
Menu::create('navbar', function($menu) {
    $menu->url('/', 'Home', 1);
    $menu->route('/', 'About', ['user' => '1'], 2);
    $menu->dropdown('Settings', function ($sub) {
        $sub->header('ACCOUNT');
        $sub->url('/settings/design', 'Design');
        $sub->divider();
        $sub->url('logout', 'Logout');
    }, 3);
});

// main.blade.php
{!! Menu::get('navbar') !!}
```

# **Requirements**

The menu package requires **PHP 7.0** or higher. The Laravel package also requires **Laravel 5.5** or higher.

# **Installation and Setup**

## **Composer**

To install through composer, by run the following command:

```
composer require mygedung/menus
```

## **Add Service Provider**

Next add the following service provider in ```config/app.php```.

``` bash
'providers' => [
  myGedung\Menus\MenusServiceProvider::class,
],
```

Next, add the following aliases to ```aliases``` array in the same file.

``` bash
'aliases' => [
   'Menu' => myGedung\Menus\Facades\Menu::class,
],
```

Next publish the package's configuration file by running :

```
php artisan vendor:publish --provider="myGedung\Menus\MenusServiceProvider"
```

# **Creating a menu**

You can define your menus in your desired file / class, as long as it is autoload by composer.

To create a menu, simply call the ```create``` method from ```Menu``` facade. The first parameter is the menu name and the second parameter is callback for defining menu items.

``` bash
Menu::create('navbar', function($menu) {
    // define your menu items here
});
```

## **Menu Item**

As explained before, we can defining menu item in the callback by accessing $menu variable, which the variable is instance of ```myGedung\Menus\MenuBuilder``` class.

To defining a plain URL, you can use ```->url()``` method.

``` bash
Menu::create('navbar', function($menu) {
    // URL, Title, Attributes
    $menu->url('home', 'Home', ['target' => 'blank']);
});
```

If you have named route, you define the menu item by calling ```->route()``` method.

``` bash
Menu::create('navbar', function($menu) {
	$menu->route(
        'users.show', // route name
        'View Profile', // title
        ['id' => 1], // route parameters
        ['target' => 'blank'] // attributes
    );
});
```

You can also defining the menu item via array by calling -```>add()``` method.

``` bash
Menu::create('navbar', function($menu) {
    $menu->add([
        'url' => 'about',
        'title' => 'About',
        'attributes' => [
            'target' => '_blank'
        ]
    ]);

    $menu->add([
        'route' => ['profile', ['user' => 'mygedung']],
        'title' => 'Visit My Profile',
        'attributes' => [
            'target' => '_blank'
        ]
    ]);
});
```

## **Menu Dropdown**

To create a dropdown menu, you can call to ```->dropdown()``` method and passing the first parameter by title of dropdown and the second parameter by closure callback that retrieve $sub variable. The ```$sub``` variable is the the instance of ```myGedung\Menus\MenuItem``` class.

``` bash
Menu::create('navbar', function($menu) {
    $menu->url('/', 'Home');
    $menu->dropdown('Settings', function ($sub) {
        $sub->url('settings/account', 'Account');
        $sub->url('settings/password', 'Password');
        $sub->url('settings/design', 'Design');
    });
});
```

## **Menu Dropdown Multi Level**

You can also create a dropdown inside dropdown by using -```>dropdown()``` method. This will allow to to create a multilevel menu items.

``` bash
Menu::create('navbar', function($menu) {
    $menu->url('/', 'Home');
    $menu->dropdown('Account', function ($sub) {
        $sub->url('profile', 'Visit My Profile');
        $sub->dropdown('Settings', function ($sub) {
            $sub->url('settings/account', 'Account');
            $sub->url('settings/password', 'Password');
            $sub->url('settings/design', 'Design');
        });
        $sub->url('logout', 'Logout');
    });
});
```

## **Menu Divider**

You may also define a divider for each menu item. You can divide between menu item by using ```->divider()``` method.

``` bash
Menu::create('navbar', function($menu) {
    $menu->url('/', 'Home');
    $menu->divider();
    $menu->url('profile', 'Profile')
});
```

## **Dropdown Header**

You may also add a dropdown header for the specified menu item by using ```->header()``` method.

``` bash
Menu::create('navbar', function($menu) {
    $menu->url('/', 'Home')
    $menu->dropdown('Settings', function ($sub) {
        $sub->header('ACCOUNT');
        $sub->url('/settings/design', 'Design');
        $sub->divider();
        $sub->url('logout', 'Logout');
    });
});
```

## **Ordering Menu Item**

You may order the menu by specify ```order``` parameter.

``` bash
Menu::create('navbar', function($menu) {
    $menu->url('/', 'Home', 1);
    $menu->route('/', 'About', ['user' => '1'], 2);
    $menu->dropdown('Settings', function ($sub) {
        $sub->header('ACCOUNT');
        $sub->url('/settings/design', 'Design');
        $sub->divider();
        $sub->url('logout', 'Logout');
    }, 3);
});
```

You may also set the order value by calling ```->order``` method.

``` bash
Menu::create('navbar', function($menu) {
    $menu->url('/', 'Home', ['icon' => 'fa fa-dashboard'])->order(1);
    $menu->route('/', 'About', ['user' => '1'], ['icon' => 'fa fa-user'])->order(2);
    $menu->dropdown('Settings', function ($sub) {
        $sub->header('ACCOUNT');
        $sub->url('/settings/design', 'Design');
        $sub->divider();
        $sub->url('logout', 'Logout');
    })->order(3);
});
```

By default ordering feature is disabled. You can enable the ```ordering``` feature in your config file. Just update value of ```ordering``` config to ```true``` and now your menu will ```ordered``` by order key.

``` bash
return [
	'ordering' => true
];
```

You may also enable or disable menu ordering for each menu via ```->enableOrdering``` and ```->disableOrdering``` method.

``` bash
Menu::create('navbar', function($menu) {
    // disable menu ordering
    $menu->enableOrdering();

    // disable menu ordering
    $menu->disableOrdering();
});
```

## **Make multiple menus**

You can also create a set of menus with different name and menu items.

``` bash
Menu::create('menu1', function($menu) {
	$menu->route('home', 'Home');
    $menu->url('profile', 'Profile');
});

Menu::create('menu2', function($menu) {
    $menu->route('home', 'Home');
    $menu->url('profile', 'Profile');
});
```

# **Rendering menus**

To render the menu you can use ```render``` or ```get``` method.

``` bash
Menu::render('navbar');

Menu::get('navbar');
```

You can also set which style to present the menu in the second parameter.

```
Menu::render('navbar', 'navbar-right');
```

Or you may also set which view to present the menu.

```
Menu::render('navbar', 'menus::nav-tabs');
```

# **Configuration**
You can publish the package configuration using the following command:

``` bash
php artisan vendor:publish --provider="myGedung\Menus\MenusServiceProvider"
```

In the published configuration file you can configure the following things:

## **Styles**

These are available ready to use menu presenters.

Key: ```styles```

## **Ordering**

Enable or disable menu item ordering for all menus

Key: ```ordering```

Default: ```false```

# **Menu presenters**

This package includes some presenter classes that are used for converting menus to html. By default the generated menu style is ```bootstrap navbar```. But, there are also several different menu styles.

You can apply the menu style via ```->style()``` method.

``` bash
Menu::create('navbar', function($menu) {
    $menu->style('nav-pills');
});
```

Or you can set which presenter to present the menu style via ```->setPresenter()``` method.

``` bash
Menu::create('navbar', function($menu) {
    $menu->setPresenter(\myGedung\Menus\Presenters\Bootstrap\NavTabPresenter::class);
});
```

You can also set which style of presenter when you rendering a menu.

``` bash
Menu::render('navbar', 'navbar-right');

Menu::render('navbar', \myGedung\Menus\Presenters\Bootstrap\NavPillsPresenter::class);
```

### **The List of Available Menu Presenter Class**

Style name |	Presenter class
------ |	------
navbar |	myGedung\Menus\Presenters\Bootstrap\NavbarPresenter
navbar-right |	myGedung\Menus\Presenters\Bootstrap\NavbarRightPresenter
nav-pills |	myGedung\Menus\Presenters\Bootstrap\NavPillsPresenter
nav-tab |	myGedung\Menus\Presenters\Bootstrap\NavTabPresenter
sidebar |	myGedung\Menus\Presenters\Bootstrap\SidebarMenuPresenter
navmenu |	myGedung\Menus\Presenters\Bootstrap\NavMenuPresenter

### **Make A custom Presenter**

You can create your own presenter classes. Make sure your presenter extends the ```myGedung\Menus\Presenters\Presenter``` and ```implements``` the 'myGedung\Menus\Presenters\PresenterInterface' interface.

For example, this is ```zurb-top-bar``` presenter.

``` bash
use myGedung\Menus\Presenters\Presenter;

class ZurbTopBarPresenter extends Presenter
{
	/**
	 * {@inheritdoc }
	 */
	public function getOpenTagWrapper()
	{
		return  PHP_EOL . '<section class="top-bar-section">' . PHP_EOL;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getCloseTagWrapper()
	{
		return  PHP_EOL . '</section>' . PHP_EOL;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getMenuWithoutDropdownWrapper($item)
	{
		return '<li'.$this->getActiveState($item).'><a href="'. $item->getUrl() .'">'.$item->getIcon().' '.$item->title.'</a></li>';
	}

	/**
	 * {@inheritdoc }
	 */
	public function getActiveState($item)
	{
		return \Request::is($item->getRequest()) ? ' class="active"' : null;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getDividerWrapper()
	{
		return '<li class="divider"></li>';
	}

	/**
	 * {@inheritdoc }
	 */
	public function getMenuWithDropDownWrapper($item)
	{
		return '<li class="has-dropdown">
		        <a href="#">
		         '.$item->getIcon().' '.$item->title.'
		        </a>
		        <ul class="dropdown">
		          '.$this->getChildMenuItems($item).'
		        </ul>
		      </li>' . PHP_EOL;
		;
	}
}
```

To use this custom presenter, you can use the ```setPresenter``` method.

``` bash
Menu::create('zurb-top-bar', function($menu) {
    $menu->setPresenter('ZurbTopBarPresenter');
});
```

### **Register A New Menu Style**

Menu style is like an alias to a presenter. You can register your style from your costum presenter in the configuration file in ```config/menus.php```.

``` bash
return [
	'navbar' =>	'myGedung\Menus\Presenters\Bootstrap\NavbarPresenter',
	'navbar-right' => 'myGedung\Menus\Presenters\Bootstrap\NavbarRightPresenter',
	'nav-pills' => 'myGedung\Menus\Presenters\Bootstrap\NavPillsPresenter',
	'nav-tab' => 'myGedung\Menus\Presenters\Bootstrap\NavTabPresenter',

	'zurb-top-bar'	=>	'ZurbTopBarPresenter',
];
```

Now, you can use a style like this.

``` bash
Menu::create('zurb-top-bar', function($menu) {
    $menu->style('zurb-top-bar');
});
```

## **View Presenter**

If you don't like to use presenter classes, you use view presenters instead. We can set which view to present the menus by calling ```->setView()``` method.

``` bash
Menu::create('navbar', function($menu) {
    $menu->setView('menus::default');
});
```

### **The List of Available View Presenter**

View name |	Menu style
-------- |	--------
menus::default | 	Bootstrap Navbar (default)
menus::navbar-left | 	Bootstrap Navbar Left
menus::navbar-right |	Bootstrap Navbar Right
menus::nav-tabs |	Bootstrap Nav Tabs
menus::nav-tabs-justified |	Bootstrap Nav Tabs Justified
menus::nav-pills |	Bootstrap Nav Pills
menus::nav-pills-stacked |	Bootstrap Nav Pills Stacked
menus::nav-pills-justified |	Bootstrap Nav Pills Justified
menus::menu |	Plain Menu

# **The menu instance**

Sometimes, maybe we need to add a new additional menu from controller or other place. To get an instance of an existing menu, you can use the ```instance``` method.

``` bash
$menu = Menu::instance('zurb-top-bar');

// You can also make additions to the menu again

$menu->add(['title' => 'Settings', 'route' => 'settings']);

$menu->url('profile', 'Profile');

$menu->route('settings', 'Settings');
```

# **Finding a menu item**

To find menu item, you can use ```findBy``` method from ```myGedung\Menus\MenuBuilder``` class.

``` bash
$menu = Menu::instance('sidebar');

$menu->url('profile', 'Profile');

$menuItem = $menu->findBy('title', 'Profile');

// add child menu
$menuItem->url('foo', 'Foo');
```

You may also use ```whereTitle``` helper method to find a specific menu item. Also, you can add other child menu item in the callback that located in the second argument in ```whereTitle``` method.

``` bash
$menu = Menu::instance('sidebar');

$menu->url('profile', 'Profile');

$menu->whereTitle('Profile', function ($sub)
{
	$sub->url('foo', 'Foo');
});

// add childs menu
```

# **Modifying a menu**

After we create a menu, maybe we need to add other additional menus. You may modifying menu via ```->modify``` method.

``` bash
Menu::modify('navbar', function($menu)
{
	$menu->add([
		'title' => 'Foo',
		'url' => 'bar',
	]);
});
```
