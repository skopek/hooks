<?php
	namespace Skopek\Hooks;

	class Hook
	{
		/**
		 * list of hooks
		 * @var array
		 */
		protected static $hooks = [];

		/**
		 * @param string $name The name of the hook.
		 * @param callback $function
		 * @param integer $priority
		 */
		public static function add( $name, $function, $priority = 10 ) {
			static::$hooks[ $name ][ $priority ][] = $function;
		}

		/**
		 * @param string $name The name of the hook.
		 * @return boolean
		 */
		public static function has( $name ) {
			if( isset( static::$hooks[$name] ) && !empty( static::$hooks[$name] ) )
				return true;

			return false;
		}
	}
?>
