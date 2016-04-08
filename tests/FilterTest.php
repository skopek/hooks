<?php

use Skopek\Hooks\Filter;

class FilterTest extends PHPUnit_Framework_TestCase
{
	public function testBasicFilter() {
		Filter::add("header_filter", function($value) {
			return $value . "Hello";
		});

		Filter::add("header_filter", function($value) {
			return $value . " World!";
		});

		$this->assertTrue( Filter::has("header_filter") );
		$this->assertEquals("Hello World!", Filter::apply("header_filter", ""));
	}

	public function testFilterPriority() {
		Filter::add("hello_filter", function($value) {
			return $value . " And more!";
		}, 2);

		Filter::add("hello_filter", function($value) {
			return $value . "Hello World!";
		}, 1);

		$this->assertTrue( Filter::has("hello_filter") );
		$this->assertEquals("Hello World! And more!", Filter::apply("hello_filter", ""));
	}
}