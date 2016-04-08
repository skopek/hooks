<?php

use Skopek\Hooks\Action;

class ActionTest extends PHPUnit_Framework_TestCase
{
	public function testBasicAction() {
		Action::add("header_action", function() {
			print "Hello";
		});

		Action::add("header_action", function() {
			print " World!";
		});

		$this->assertTrue( Action::has("header_action") );
		$this->expectOutputString('Hello World!');

		Action::run("header_action");
	}

	public function testActionPriority() {
		Action::add("hello_action", function() {
			print " And more!";
		}, 2);

		Action::add("hello_action", function() {
			print "Hello World!";
		}, 1);

		$this->assertTrue( Action::has("hello_action") );
		$this->expectOutputString('Hello World! And more!');

		Action::run("hello_action");
	}
}