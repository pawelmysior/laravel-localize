# Laravel localize

![laravel-localize](https://user-images.githubusercontent.com/11052725/54703745-ada4f980-4b39-11e9-9a04-aa85debfdd22.gif)

This package installs a global command that lets you easily install language files in your Laravel application.

The language files are downloaded from the awesome [caouecs/Laravel-lang](https://github.com/caouecs/Laravel-lang) repository.

## Installation

You can install the package globally via composer:

```bash
composer global require pawelmysior/laravel-localize
```

Make sure that the global composer's `vendor/bin` directory is in your system's `$PATH`.

## Usage

Cd into your Laravel application and run this command:

```bash
laravel-localize LANG
```

where LANG is the code of the language you want to install. For example, to install German language files, run:

```bash
laravel-localize de
```

The command will install the following files:

* `resources/lang/de/auth.php`
* `resources/lang/de/pagination.php`
* `resources/lang/de/passwords.php`
* `resources/lang/de/validation.php`
* `resources/lang/de.json`

Some other example languages:

```bash
# Install Dutch language files
laravel-localize nl

# Install Polish language files
laravel-localize pl

# Install Spanish language files
laravel-localize es
```

You can find the list of available languages [here](https://github.com/caouecs/Laravel-lang/tree/master/src).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
