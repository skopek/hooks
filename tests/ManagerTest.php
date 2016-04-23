<?php

use Skopek\Hooks\Manager as Hooks;

class ManagerTest extends PHPUnit_Framework_TestCase
{
	protected $hooks;

	public function setUp()
	{
		$this->hooks = new Hooks();
	}

	public function testBasic()
	{
		$this->assertInstanceOf('Skopek\\Hooks\\Action', $this->hooks->action);
		$this->assertInstanceOf('Skopek\\Hooks\\Filter', $this->hooks->filter);
	}
}