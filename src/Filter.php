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
		 * @param string $name The name of the filter.
		 * @param callback $function
		 * @param integer $priority
		 */
		public static function add( $name, $function, $priority = 10 ) {
			static::$filters[ $name ][ $priority ][] = $function;
		}

		/**
		 * @param string $name The name of the filter.
		 * @param mixed $value
		 * @return mixed
		 */
		public static function apply( $name, $value ) {
			$args = array_slice(func_get_args(), 2);

			if ( !static::has( $name ) )
				return $value;

			ksort(static::$filters[ $name ]);

			foreach (static::$filters[$name] as $priority => $functions) {
				foreach ($functions as $function) {
					$all_args = array_merge( [$value], $args );

					$value = call_user_func_array( $function, $all_args );
				}
			}

			return $value;
		}

		/**
		 * @param string $name The name of the filter.
		 * @return boolean
		 */
		public static function has( $name ) {
			if( isset( static::$filters[$name] ) && !empty( static::$filters[$name] ) )
				return true;

			return false;
		}
	}
?>