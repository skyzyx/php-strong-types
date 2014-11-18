# PHP Strong Types

[![Source](http://img.shields.io/badge/source-skyzyx/strong-types-blue.svg?style=flat-square)](https://github.com/skyzyx/strong–types)
[![Latest Stable Version](http://img.shields.io/packagist/v/skyzyx/strong-types.svg?style=flat-square)](https://packagist.org/packages/skyzyx/strong-types)
[![Total Downloads](http://img.shields.io/packagist/dt/skyzyx/strong-types.svg?style=flat-square)](https://packagist.org/packages/skyzyx/strong-types)
[![Open Issues](http://img.shields.io/github/issues/skyzyx/strong-types.svg?style=flat-square)](https://github.com/skyzyx/strong-types/issues)
[![Build Status](http://img.shields.io/travis/skyzyx/strong-types/master.svg?style=flat-square)](https://travis-ci.org/skyzyx/strong-types)
[![Coverage Status](http://img.shields.io/coveralls/skyzyx/strong-types/master.svg?style=flat-square)](https://coveralls.io/r/skyzyx/strong-types?branch=master)
[![Code Climate](http://img.shields.io/codeclimate/github/skyzyx/strong-types.svg?style=flat-square)](https://codeclimate.com/github/skyzyx/strong-types)
[![Code Quality](http://img.shields.io/scrutinizer/g/skyzyx/strong-types.svg?style=flat-square)](https://scrutinizer-ci.com/g/skyzyx/strong-types)
[![Dependency Status](https://www.versioneye.com/user/projects/!!!!!!!/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/!!!!!!!)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/!!!!!!!/mini.png)](https://insight.sensiolabs.com/projects/!!!!!!!)
[![HHVM Support](http://img.shields.io/hhvm/skyzyx/strong-types.svg?style=flat-square)](https://hhvm.com)
[![Documentation Status](https://readthedocs.org/projects/skyzyx-strong-types/badge/?version=master&style=flat-square)](https://readthedocs.org/projects/shared-utilities/?badge=master)
[![License](http://img.shields.io/packagist/l/skyzyx/strong-types-blue.svg?style=flat-square)](https://packagist.org/packages/skyzyx/strong-types)
[![Author](http://img.shields.io/badge/author-@skyzyx-blue.svg?style=flat-square)](https://twitter.com/skyzyx)

Enables strong types for PHP. This allows for tighter validation, especially when accepting input from users.


## Examples

{Fill-in: Example usage of this code.}


## Features

* Boolean
* Collection (ArrayAccess)
* Enum
* Float
* Integer
* String (incl. Multibyte)

`DateTime` is already strongly typed, so use that class for strong date/time types.


## Installation

Using [Composer]:
```bash
composer require skyzyx/strong-types=~1.0
```

And include it in your scripts:

```php
require_once 'vendor/autoload.php';
```


## Testing

Firstly, run `composer install -o` to download and install the dependencies.

You can run the tests as follows:
```bash
bin/phpunit
```


## Contributing
Here's the process for contributing:

1. Fork PHP Strong Types to your GitHub account.
2. Clone your GitHub copy of the repository into your local workspace.
3. Write code, fix bugs, and add tests with 100% code coverage.
4. Commit your changes to your local workspace and push them up to your GitHub copy.
5. You submit a GitHub pull request with a description of what the change is.
6. The contribution is reviewed. Maybe there will be some banter back-and-forth in the comments.
7. If all goes well, your pull request will be accepted and your changes are merged in.


## Authors, Copyright & Licensing

* Copyright (c) 2014 [Ryan Parman](http://ryanparman.com).

See also the list of [contributors](/skyzyx/strong-types/contributors) who participated in this project.

Licensed for use under the terms of the [MIT] license.

  [PHP]: http://php.net
  [Composer]: https://getcomposer.org
  [MIT]: http://www.opensource.org/licenses/mit-license.php
  [Apache 2.0]: http://opensource.org/licenses/Apache-2.0


## Coding Standards

PSR-0/1/2 are a solid foundation, but are not an entire coding style by themselves. I have taken the time to document
all of the nitpicky patterns and nuances of my personal coding style. It goes well-beyond brace placement and tabs vs.
spaces to cover topics such as docblock annotations, ternary operations and which variation of English to use. It aims
for thoroughness and pedanticism over hoping that we can all get along.

<https://github.com/skyzyx/php-coding-standards>

  [PHP]: http://php.net
  [Composer]: https://getcomposer.org
  [MIT]: http://www.opensource.org/licenses/mit-license.php
  [Apache 2.0]: http://opensource.org/licenses/Apache-2.0