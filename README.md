# Laravel-Shortcodes

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![StyleCI](https://styleci.io/repos/59507292/shield)](https://styleci.io/repos/59507292)

WordPress like shortcodes for Laravel 5.x based on webwizo/laravel-shortcodes see:https://github.com/webwizo/laravel-shortcodes

```php
[b class="bold"]Bold text.[/b]

[tabs]
  [tab]Tab 1[/tab]
  [tab]Tab 2[/tab]
[/tabs]

[user id="1" display="name"]
```

## Install

Via Composer

``` bash
$ composer require "uzwebline/laravel_shortcodes:1.0.*"
```

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

## Usage

```php
Uzwebline\Shortcodes\ShortcodesServiceProvider::class,
```

You can use the facade for shorter code. Add this to your aliases:

```php
'Shortcode' => Uzwebline\Shortcodes\Facades\Shortcode::class,
```

The class is bound to the ioC as `shortcode`

```php
$shortcode = app('shortcode');
```

# Usage

### withShortcodes()

To enable the view compiling features:

```php
return view('view')->withShortcodes();
```

This will enable shortcode rendering for that view only.

### Enable through class

```php
Shortcode::enable();
```

### Disable through class

```php
Shortcode::disable();
```

### Disabling some views from shortcode compiling

With the config set to true, you can disable the compiling per view.

```php
return view('view')->withoutShortcodes();
```

## Default compiling

To use default compiling:

```php
Shortcode::compile($contents);
```

### Strip shortcodes from rendered view.

```php
return view('view')->withStripShortcodes();
```

## Strip shortcode through class

```php
Shortcode::strip($contents);
```

## Registering new shortcodes

Create a new ServiceProvider where you can register all the shortcodes.

``` bash
php artisan make:provider ShortcodesServiceProvider
```

After defining shortcodes, add the ServiceProvider to the providers array in `config/app.php`

## Usage

```php
App\Providers\ShortcodesServiceProvider::class,
```

### Callback

Shortcodes can be registered within ShortcodesServiceProvider with a callback:

```bash
php artisan make:provider ShortcodesServiceProvider
```

ShortcodesServiceProvider.php Class File
```php
<?php namespace App\Providers;

use App\Shortcodes\BoldShortcode;
use Illuminate\Support\ServiceProvider;
use Shortcode;

class ShortcodesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Shortcode::register('b', BoldShortcode::class);
        Shortcode::register('i', 'App\Shortcodes\ItalicShortcode@custom');
    }
}
```

### Default class for BoldShortcode

You can store each shortcode within their class `app/Shortcodes/BoldShortcode.php`
```php
namespace App\Shortcodes;

class BoldShortcode {

  public function register($shortcode, $content, $compiler, $name, $viewData)
  {
    return sprintf('<strong class="%s">%s</strong>', $shortcode->class, $content);
  }
  
}
```

### Class with custom method

You can store each shortcode within their class `app/Shortcodes/ItalicShortcode.php`
```php
namespace App\Shortcodes;

class ItalicShortcode {

  public function custom($shortcode, $content, $compiler, $name, $viewData)
  {
    return sprintf('<i class="%s">%s</i>', $shortcode->class, $content);
  }
  
}
```

### Register helpers

If you only want to show the html attribute when the attribute is provided in the shortcode, you can use `$shortcode->get($attributeKey, $fallbackValue = null)`

```php
class BoldShortcode {

  public function register($shortcode, $content, $compiler, $name, $viewData)
  {
    return '<strong '. $shortcode->get('class', 'default') .'>' . $content . '</strong>';
  }
  
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email umidjonsmail@gmail.com instead of using the issue tracker.

## Credits

- [Umid Bazarov][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/uzwebline/laravel_shortcodes.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/uzwebline/laravel_shortcodes/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/uzwebline/laravel_shortcodes.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/uzwebline/laravel_shortcodes.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/uzwebline/laravel_shortcodes.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/uzwebline/laravel_shortcodes
[link-travis]: https://travis-ci.org/uzwebline/laravel_shortcodes
[link-scrutinizer]: https://scrutinizer-ci.com/g/uzwebline/laravel_shortcodes/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/uzwebline/laravel_shortcodes
[link-downloads]: https://packagist.org/packages/uzwebline/laravel_shortcodes
[link-author]: https://github.com/uzwebline
[link-contributors]: ../../contributors
