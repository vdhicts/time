# Time

This package contains a time value-object and a range helper which can be used when working with times (no dates 
required) in PHP.

## Requirements

This package requires PHP 7.4+.

## Installation

You can install the package via composer:

`composer require vdhicts/time`

## Usage

### Time

The `Time` object can be initiated with:

```php
$time = new Time(14, 30, 15);
```

#### Comparison

The `Time` object makes it easy to compare to other `Time` objects. It offers the following methods:

```php
$time->isEqualTo(Time $anotherTime);
$time->isBefore(Time $anotherTime);
$time->isBeforeOrEqualTo(Time $anotherTime);
$time->isAfter(Time $anotherTime);
$time->isAfterOrEqualTo(Time $anotherTime);
```

#### Conversion

The `Time` object can be converted to a string with the `toString` method or just casting the object to a 
string `(string)$time`. This will output: `14:30:15`.

### Time collection

`Time` objects can be collected in a `TimeCollection`. The `TimeCollection` ca be initiated with:

```php
$timeCollection = new TimeCollection();
```

It's possible to provided an array of `Time` objects or to use the `add` and `set` methods on the collection. The 
`contains` method provides the ability to check if the collection contains a `Time` object. 

### Time range

A `TimeRange` object contains two `Time` objects, a start and end time. The `TimeRange` object can be initiated with:

```php
$timeRange = new TimeRange($time, $anotherTime);
```

#### Comparison

The `TimeRange` object makes it easy to compare to a single `Time` or another `TimeRange`. 

To determine if a `Time` is in a range:

```php
$time = new Time(14, 30, 15);
$timeRange->isTimeInRange($time);
```

To determine if another range overlaps the range:

```php
$anotherTimeRange = new TimeRange($time, $anotherTime);
$timeRange->isTimeRangeOverlapping($anotherTimeRange);
```

## Tests

Full code coverage unit tests are available in the tests folder. Run via phpunit:

`vendor\bin\phpunit` or `composer test`

By default a coverage report will be generated in the build/coverage folder.

## Contribution

Any contribution is welcome, but it should be fully tested, meet the PSR-2 standard and please create one pull request 
per feature. In exchange you will be credited as contributor on this page.

## Security

If you discover any security related issues in this or other packages of Vdhicts, please email security@vdhicts.nl 
instead of using the issue tracker.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## About vdhicts

[Vdhicts](https://www.vdhicts.nl) is the name of my personal company. Vdhicts develops and implements IT solutions for
businesses and educational institutions.
