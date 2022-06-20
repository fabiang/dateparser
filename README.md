# fabiang/dateparser

Date parsing library supporting the full format RFC3339. The following formats are supported:

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

**Note:** PHP only supports 6 digit microseconds. This library cut the last digits off.

[![PHP Version Require](http://poser.pugx.org/fabiang/dateparser/require/php)](https://packagist.org/packages/fabiang/dateparser)
[![Latest Stable Version](http://poser.pugx.org/fabiang/dateparser/v)](https://packagist.org/packages/fabiang/dateparser)
[![License](http://poser.pugx.org/fabiang/dateparser/license)](https://packagist.org/packages/fabiang/dateparser)  
[![Unit Tests](https://github.com/fabiang/dateparser/actions/workflows/unit.yml/badge.svg)](https://github.com/fabiang/dateparser/actions/workflows/unit.yml)
[![Static Code Analysis](https://github.com/fabiang/dateparser/actions/workflows/static.yml/badge.svg)](https://github.com/fabiang/dateparser/actions/workflows/static.yml)

## Installation

Run Composer with:

```
composer require fabiang/dateparser
```

## Usage

Parsing an RFC3339 datetime string:

```php
use Fabiang\Dateparser\RFC3339;

$parser = new RFC3339();
$datetime = $parser->parse('2017-07-25T18:37:40+02:00'); // DateTime object
```

## Licence

BSD-2-Clause. See the [LICENSE.md](LICENSE.md).
