<?php

namespace Skopek\Hooks;

class Action extends Hook
{
	/**
	 * @param string $name The name of the hook.
	 * @return boolean
	 */
	public function run($name) 
	{
		$args = array_slice(func_get_args(), 1);

		if (!$this->has($name))
		{
			return false;
		}

		ksort($this->hooks[ $name ]);

		foreach ($this->hooks[$name] as $priority => $functions) {
			foreach ($functions as $function) {
				call_user_func_array( $function, $args );
			}
		}
		return true;
	}
}