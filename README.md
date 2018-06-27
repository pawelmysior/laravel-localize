# Laravel localize

This package installs a command that lets you install language files in your Laravel application with a single command.

The language files are downloaded from the [caouecs/Laravel-lang](https://github.com/caouecs/Laravel-lang) repository.

## Installation

You can install the package via composer:

```bash
composer global require pawelmysior/laravel-localize
```

Make sure that the global composer's `vendor/bin` directory is in your system's `$PATH`.

## Usage

Cd into your Laravel application and run this command:

```bash
laravel-localize LANG
```

where LANG is the code of the language you want to install. For example:

```bash
# Install Spanish language files
laravel-localize es

# Install German language files
laravel-localize de
``` 

You can find the list of available languages [here](https://github.com/caouecs/Laravel-lang/tree/master/src).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
