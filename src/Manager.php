<?php

namespace Skopek\Hooks;

class Manager
{
	/**
	 * list of instances
	 * @var array
	 */
	protected $instances = array();

	/**
	 * constructor
	 */
	public function __construct()
	{
		$this->add('action', new Action);
		$this->add('filter', new Filter);
	}

	/**
	 * @param string $key
	 * @param object $value
	 */
	public function add($key, $value)
	{
		$this->instances[$key] = $value;
	}

	/**
	 * @param  string $key
	 * @return object
	 */
	public function get($key)
	{
		if (isset($this->instances[$key])) {
			return $this->instances[$key];
		}

		return null;
	}

	/**
	 * @param  string $key
	 * @return object
	 */
	public function __get($key)
	{
		return $this->get($key);
	}
}