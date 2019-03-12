# Post Duplicator Polylang Addon

[![Latest Version on Packagist][ico-version]](link-packagist)
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]](link-downloads)

There is a problem when using the post duplicator plugin in combination with the polylang multilingual package.

On duplications the related posts are getting copied aswell.

**Example:** You copy `post #1` which is translated in another language `post #2`. The duplicated `post #3` is now linked to the same `post #2` translation entry.

This addon clears this link after duplication. This leads to `post #3` having no translations which is the prefferd behaviour.

## Install

Via Composer

```bash
composer require mindtwo/post-duplicator-polylang
```

Via WordPress Plugin Manager
Search `Post Duplicator Polylang` in the official WordPress Plugin and install it.

## Usage

You have to only install and activate this plugin.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [mindtwo GmbH][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/mindtwo/post-duplicator-polylang.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/mindtwo/post-duplicator-polylang.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/mindtwo/post-duplicator-polylang
[link-downloads]: https://packagist.org/packages/mindtwo/post-duplicator-polylang
[link-author]: https://github.com/mindtwo
[link-contributors]: ../../contributors