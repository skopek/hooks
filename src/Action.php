<?php
	namespace Skopek\Hooks;

	class Action extends Hook
	{
		/**
		 * @param string $name The name of the hook.
		 * @return boolean
		 */
		public static function run( $name ) {
			$args = array_slice(func_get_args(), 1);

			if ( !static::has( $name ) )
				return false;

			ksort(static::$hooks[ $name ]);

			foreach (static::$hooks[$name] as $priority => $functions) {
				foreach ($functions as $function) {
					call_user_func_array( $function, $args );
				}
			}
			return true;
		}
	}
?>
