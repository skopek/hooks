<?php
	namespace Skopek\Hooks;

	class Action
	{
		/**
		 * list of hooks
		 * @var array
		 */
		private static $actions = [];

		/**
		 * @param string $name The name of the action.
		 * @param callback $function
		 * @param integer $priority
		 */
		public static function add( $name, $function, $priority = 10 ) {
			static::$actions[ $name ][ $priority ][] = $function;
		}

		/**
		 * @param string $name The name of the action.
		 * @return boolean
		 */
		public static function run( $name ) {
			$args = array_slice(func_get_args(), 1);

			if ( !static::has( $name ) )
				return false;

			ksort(static::$actions[ $name ]);

			foreach (static::$actions[$name] as $priority => $functions) {
				foreach ($functions as $function) {
					call_user_func_array( $function, $args );
				}
			}
			return true;
		}

		/**
		 * @param string $name The name of the action.
		 * @return boolean
		 */
		public static function has( $name ) {
			if( isset( static::$actions[$name] ) && !empty( static::$actions[$name] ) )
				return true;

			return false;
		}
	}
?>
