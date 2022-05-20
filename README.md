# Time

This package aims to make working with times (as in date, ranges and/or duration) easier. It contains a time 
value-object, ranges, duration, rounding, etc.

## Requirements

This package requires PHP 8.0 or higher.

## Installation

You can install the package via composer:

`composer require vdhicts/time`

## Usage

This package aims to provide an easy usage, with some similarities with PHP's DateTime and Carbon. An example of that 
are the interfaces.

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

#### Difference

The time object can also be used to calculate the difference between time objects:

```php
$timeStart = new Time(10, 30);
$timeEnd = new Time(14);

$timeStart->diffInHours($timeEnd); // 3.5
$timeEnd->diffInHours($timeStart); // -3.5
```

The difference can be calculated in hours (`diffInHours`), minutes (`diffInMinutes`) and seconds (`diffInSeconds`).

#### Duration

A time can be part of a date, i.e. 2022-03-01 10:00:00 but can also be used for a duration, i.e. 
"It took me 1 hour and 46 minutes to get there.".

```php
$time = new Time(1, 46);

sprintf('It took me %s hours', $time->durationInHours());
sprintf('It took me %s minutes', $time->durationInMinutes());
sprintf('It took me %s seconds', $time->durationInSeconds());
```

Results in:

```
string(32) "It took me 1.7666666666667 hours"
string(22) "It took me 106 minutes"
string(23) "It took me 6360 seconds"
```

#### Rounding

Working with very specific times might not always be the result you want, for example for time tracking. This package 
allows you to round the time to your likings. By default, it rounds to 5 minutes:

```php
$time = new Time(2, 46, 23);

$time->roundNatural(); // 02:45:00
$time->roundUp(); // 02:50:00
$time->roundDown(); // 02:45:00
```

It's also possible to round the seconds and/or change the precision. For example, round to 15 seconds:

```php
$time = new Time(2, 21, 33);

$time->roundNatural(15, true); // 02:21:30
$time->roundUp(15, true); // 02:21:45
$time->roundDown(15, true); // 02:21:30
```

#### Presentation

The `Time` object can be presented as a string with the `toString` method or just casting the object to a
string `(string)$time`. This will output: `14:30:15`. You are also able to show the time without seconds when using the
`format` method.

There are also two other presentations available, the `numerical` and `readable`:

```php
$time = new Time(12, 30, 45);
$time->present()->asNumericalTime(); // 12:50
$time->present()->asNumericalTime(true); // 12:50:75

$time->present()->asReadableTime(); // 12:30
$time->present()->asReadableTime(); // 12:30:45
```

### Time collection

`Time` objects can be collected in a `TimeCollection`. The `TimeCollection` ca be initiated with:

```php
$timeCollection = new TimeCollection();
```

It's possible to provide an array of `Time` objects or to use the `add` and `set` methods on the collection. The 
`contains` method provides the ability to check if the collection contains a `Time` object. 

### Time range

A `TimeRange` object contains two `Time` objects, a start and end time. The `TimeRange` object can be initiated with:

```php
$timeRange = new TimeRange($time, $anotherTime);
```

To get the duration of the range, you can get the `Time` object as duration with:

```php
$timeRange->getRangeDuration();
```

#### Comparison

The `TimeRange` object makes it easy to compare to a single `Time` or another `TimeRange`. 

To determine if a `Time` is in a range:

```php
$time = new Time(14, 30, 15);
$timeRange->inRange($time);
```

To determine if another range overlaps the range:

```php
$anotherTimeRange = new TimeRange($time, $anotherTime);
$timeRange->isOverlapping($anotherTimeRange);
```

## Tests

Unit tests are available in the tests folder. Run with:

`composer test`

When you want a code coverage report which will be generated in the build/report folder. Run with:

`composer test-coverage`

## Contribution

Any contribution is welcome, but it should meet the PSR-12 standard and please create one pull request per feature/bug. 
In exchange, you will be credited as contributor on this page.

## Security

If you discover any security related issues in this or other packages of Vdhicts, please email security@vdhicts.nl 
instead of using the issue tracker.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## About vdhicts

[Vdhicts](https://www.vdhicts.nl) is the name of my personal company. Vdhicts develops and implements IT solutions for
businesses and educational institutions.
