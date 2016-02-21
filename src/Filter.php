<?php
	namespace Skopek\Hooks;

	class Filter
	{
		/**
		 * list of hooks
		 * @var array
		 */
		private static $filters = [];

		/**
		 * @param string $name
		 * @param callback $function
		 * @param integer $priority
		 */
		public static function add( $name, $function, $priority = 10 ) {
			static::$filters[ $name ][ $priority ][] = $function;
		}

		/**
		 * @param string $name
		 * @param mixed $value
		 * @return mixed
		 */
		public static function apply( $name, $value ) {
			$args = array_slice(func_get_args(), 2);

			if ( !isset( static::$filters[$name] ) ) {
				return $value;
			}

			ksort(static::$filters[ $name ]);

			foreach (static::$filters[$name] as $priority => $functions) {
				foreach ($functions as $function) {
					$all_args = array_merge( [$value], $args );

					$value = call_user_func_array( $function, $all_args );
				}
			}

			return $value;
		}
	}
?>