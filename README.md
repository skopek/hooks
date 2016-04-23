# hooks
PHP Hooks System
## Installing
Install using Composer.
```sh
$ composer require skopek/hooks
```
## Usage Action
```php
$hooks = new Skopek\Hooks\Manager;

$hooks->action->add("header", function() {
	echo "Hello!";
});

$hooks->action->run("header");
```
## Usage Filter
```php
$hooks = new Skopek\Hooks\Manager;

$hooks->filter->add("header", function($value) {
	return $value . " World!";
});

echo $hooks->filter->apply("header", "Hello");
```
