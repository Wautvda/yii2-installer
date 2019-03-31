<?php
namespace weblogic\installer\helpers;

use Exception;
use Yii;

class InstallerHelper{
	/**
	 * Checks if database connections works
	 *
	 * @return boolean
	 */
	public static function validDbConnection() : bool
	{
		try {
			Yii::$app->db->isActive;

			return true;
		} catch (Exception $e) {
			print_r($e->getMessage());
		}

		return false;
	}

	/**
	 * Returns the dynamic file as array
	 *
	 * @param string $paramName
	 * @return array Configuration file
	 */
	public static function get(string $paramName) : array
	{
		$file = Yii::$app->params[$paramName];
		$array = require($file);

		return is_array($array) ? $array : [];
	}

	/**
	 * Sets configuration into the file
	 *
	 * @param string $paramName
	 * @param array $config
	 */
	public static function set(string $paramName, array $config = [])
	{
		$file = Yii::$app->params[$paramName];

		$content = "<" . "?php return ";
		$content .= var_export($config, true);
		$content .= "; ?" . ">";

		file_put_contents($file, $content);

		if (function_exists('opcache_reset')) {
			opcache_invalidate($file);
		}
	}
}
