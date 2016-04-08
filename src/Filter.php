<?php
	namespace Skopek\Hooks;

	class Filter extends Hook
	{
		/**
		 * @param string $name The name of the hook.
		 * @param mixed $value
		 * @return mixed
		 */
		public static function apply( $name, $value ) {
			$args = array_slice(func_get_args(), 2);

			if ( !static::has( $name ) )
				return $value;

			ksort(static::$hooks[ $name ]);

			foreach (static::$hooks[$name] as $priority => $functions) {
				foreach ($functions as $function) {
					$all_args = array_merge( [$value], $args );

					$value = call_user_func_array( $function, $all_args );
				}
			}

			return $value;
		}
	}
?>