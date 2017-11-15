# items

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

# Laravel packages

https://laravel.com/docs/5.5/packages

3 passos instal·lació paquet laravel:

1) Require
2) Install ServiceProvider
3) Install Facades (optional)

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```

## Install

Via Composer

``` bash
$ composer require baucells/items
```

## Usage

``` php
$skeleton = new Baucells\Items();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email sergibacells@iesebre.com instead of using the issue tracker.

## Credits

- [Sergi Baucells Rodriguez][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/baucells/items.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/baucells/items/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/baucells/items.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/baucells/items.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/baucells/items.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/baucells/items
[link-travis]: https://travis-ci.org/baucells/items
[link-scrutinizer]: https://scrutinizer-ci.com/g/baucells/items/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/baucells/items
[link-downloads]: https://packagist.org/packages/baucells/items
[link-author]: https://github.com/baucells
[link-contributors]: ../../contributors
