# hooks
PHP Hooks System
## Installing
Install using Composer.
```sh
$ composer require skopek/hooks
```
## Usage Action
```php
<?php
	use Skopek\Hooks\Action;
	
	Action::add("header", function() {
		echo "Hello!";
	});
	
	Action::run("header");
?>
```
## Usage Filter
```php
<?php
	use Skopek\Hooks\Filter;
	
	Filter::add("header", function($value) {
		return $value . " World!";
	});
	
	echo Filter::apply("header", "Hello");
?>
```
