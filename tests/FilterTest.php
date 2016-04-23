<?php

use Skopek\Hooks\Filter;

class FilterTest extends PHPUnit_Framework_TestCase
{
	protected $filter;

	public function setUp()
	{
		$this->filter = new Filter;
	}

	public function testBasicFilter() 
	{
		$this->filter->add("header", function($value) {
			return $value . "Hello";
		});

		$this->filter->add("header", function($value) {
			return $value . " World!";
		});

		$this->assertTrue( $this->filter->has("header") );
		$this->assertEquals("Hello World!", $this->filter->apply("header", ""));
	}

	public function testFilterPriority() {
		$this->filter->add("hello", function($value) 
		{
			return $value . " And more!";
		}, 2);

		$this->filter->add("hello", function($value) {
			return $value . "Hello World!";
		}, 1);

		$this->assertTrue( $this->filter->has("hello") );
		$this->assertEquals("Hello World! And more!", $this->filter->apply("hello", ""));
	}
}