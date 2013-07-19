<?php
//! do not modify, change settings.php instead
class SPUserSettings
{
	protected static $settings;

	protected static function init()
	{
		$settings = array();
		require_once("settings.php");
		self::$settings = $settings;
	}

	public static function get_settings($key)
	{
		if (!self::$settings)
		{
			self::init();
		}

		return isset(self::$settings[$key]) ? self::$settings[$key] : null;
	}
}

?>