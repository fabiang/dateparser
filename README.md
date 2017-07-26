# fabiang/dateparser

Date parsing library supporting the full format RFC3339.

*Note:* The Api is considered unstable

[![Latest Stable Version](https://poser.pugx.org/fabiang/dateparser/version)](https://packagist.org/packages/fabiang/dateparser)
[![License](https://poser.pugx.org/fabiang/dateparser/license)](https://packagist.org/packages/fabiang/dateparser)
[![Build Status](https://travis-ci.org/fabiang/dateparser.svg?branch=master)](https://travis-ci.org/fabiang/dateparser)

## Installation

Run Composer with:

```
composer require fabiang/dateparser=@dev
```

## Usage

Parsing an RFC3339 datetime string:

```php
use Fabiang\Dateparser\RFC3339;

$parser = new RFC3339();
$datetime = $parser->parse('2017-07-25T18:37:40+02:00'); // DateTime object
```

The following formats are supported:

```
2017-07-25T18:37:40
2017-07-25T18:37:40.1234567890
2017-07-25T18:37:40.1234567890Z
2017-07-25T18:37:40Z
2017-07-25T18:37:40.1234567890+0200
2017-07-25T18:37:40+0200
2017-07-25T18:37:40.1234567890-0400
2017-07-25T18:37:40-0400
2017-07-25T18:37:40.1234567890+02:00
2017-07-25T18:37:40+02:00
2017-07-25T18:37:40.1234567890-04:00
```

*Note:* PHP only supports 6 digit microseconds. This library cut the last digits off

## Credits

Thanks to the Hoa Project for their nice [Hoa\Compiler package](https://github.com/hoaproject/Compiler).

## Licence

BSD-2-Clause. See the [LICENSE.md](LICENSE.md).
