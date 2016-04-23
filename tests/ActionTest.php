<?php

use Skopek\Hooks\Action;

class ActionTest extends PHPUnit_Framework_TestCase
{
	protected $action;

	public function setUp()
	{
		$this->action = new Action;
	}

	public function testBasicAction()
	{
		$this->action->add("header", function() {
			print "Hello";
		});

		$this->action->add("header", function() {
			print " World!";
		});

		$this->assertTrue( $this->action->has("header") );
		$this->expectOutputString('Hello World!');

		$this->action->run("header");
	}

	public function testActionPriority() 
	{
		$this->action->add("hello", function() {
			print " And more!";
		}, 2);

		$this->action->add("hello", function() {
			print "Hello World!";
		}, 1);

		$this->assertTrue( $this->action->has("hello") );
		$this->expectOutputString('Hello World! And more!');

		$this->action->run("hello");
	}
}