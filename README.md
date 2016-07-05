# PHP Strong Types

[![Source](http://img.shields.io/badge/source-skyzyx/php%E2%80%93strong%E2%80%93types-blue.svg?style=flat-square)](https://github.com/skyzyx/php-strong–types)
[![Latest Stable Version](http://img.shields.io/packagist/v/skyzyx/strong-types.svg?style=flat-square)](https://packagist.org/packages/skyzyx/strong-types)
[![Total Downloads](http://img.shields.io/packagist/dt/skyzyx/strong-types.svg?style=flat-square)](https://packagist.org/packages/skyzyx/strong-types)
[![Open Issues](http://img.shields.io/github/issues/skyzyx/php-strong-types.svg?style=flat-square)](https://github.com/skyzyx/php-strong-types/issues)
[![Build Status](http://img.shields.io/travis/skyzyx/php-strong-types/master.svg?style=flat-square)](https://travis-ci.org/skyzyx/php-strong-types)
[![Coverage Status](http://img.shields.io/coveralls/skyzyx/strong-types/master.svg?style=flat-square)](https://coveralls.io/r/skyzyx/php-strong-types?branch=master)
[![Code Climate](http://img.shields.io/codeclimate/github/skyzyx/strong-types.svg?style=flat-square)](https://codeclimate.com/github/skyzyx/php-strong-types)
[![Code Quality](http://img.shields.io/scrutinizer/g/skyzyx/strong-types.svg?style=flat-square)](https://scrutinizer-ci.com/g/skyzyx/php-strong-types/)
[![Dependency Status](https://www.versioneye.com/user/projects/546b0069950825193d0000ec/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/546b0069950825193d0000ec)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/975b0606-a624-4e1f-b3c0-385a1f06e66f/mini.png)](https://insight.sensiolabs.com/projects/975b0606-a624-4e1f-b3c0-385a1f06e66f)
[![HHVM Support](http://img.shields.io/hhvm/skyzyx/strong-types.svg?style=flat-square)](https://hhvm.com)
[![Documentation Status](https://readthedocs.org/projects/skyzyx-strong-types/badge/?version=master&style=flat-square)](https://readthedocs.org/projects/shared-utilities/?badge=master)
[![License](http://img.shields.io/packagist/l/skyzyx/strong-types-blue.svg?style=flat-square)](https://packagist.org/packages/skyzyx/strong-types)
[![Author](http://img.shields.io/badge/author-@skyzyx-blue.svg?style=flat-square)](https://twitter.com/skyzyx)

Enables strong types for PHP. This allows for tighter validation, especially when accepting input from users.

**Why would anyone do this?** This can be useful when developing APIs, and you want to require strict types. By defining those types/shapes ahead of time as classes, you can enforce incoming/outgoing data types, but also access the native values after the vaidation step has occurred.

It intentionally rejects and avoid any kind of "type massaging". If you pass an `integer` to `StringType`, you will get an exception. All errors are thrown as Exceptions with useful error messages.

## Features

* BooleanType
* Collection (ArrayAccess)
* Enum
* FloatType
* IntegerType
* StringType (incl. Utf8String)

`DateTime` is already strongly typed, so use that class for strong date/time types.


## Examples

We can do simple validation enforcement, which can be valuable in PHP 5.x. (Use strict types instead in PHP 7.)

```php
use Skyzyx\StrongTypes\StringType;

$abc = new StringType('abc');

$v123 = new StringType(123);
#=> UnexpectedValueException:
#=> The Skyzyx\StrongTypes\StringType class expects a value of type string. 
#=> Received a value of type integer instead.

$abc->getValue();
#=> 'abc'
```

You can also extend the base types to create more specific _data types_ (aka, _data shapes_).

```php
use Skyzyx\StrongTypes\StringType;

class FiveChars extends StringType
{
    public function __construct($s)
    {
        $this->setExactLength(5);
        parent::__construct($s);
    }
}

$abcde = new FiveChars('abcde');

$abc = new FiveChars('abc');
#=> Exception

$v12345 = new FiveChars(12345);
#=> Exception
```


## Installation

Using [Composer]:
```bash
composer require skyzyx/strong-types=~2.0
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

* Copyright (c) 2014–2016 [Ryan Parman](http://ryanparman.com).

See also the list of [contributors](/skyzyx/strong-types/contributors) who participated in this project.

Licensed for use under the terms of the [MIT] license.


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
