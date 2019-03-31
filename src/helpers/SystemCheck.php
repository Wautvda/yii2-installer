<?php

namespace weblogic\installer\helpers;

use Yii;
use YiiRequirementChecker;

class SystemCheck
{

	/**
	 * Checks the basic requirements of the application
	 */
	public static function getResults() : array
	{
		require_once dirname(__FILE__) . '/../../vendor/yiisoft/yii2/requirements/YiiRequirementChecker.php';
		$requirementsChecker = new YiiRequirementChecker();

		$requirements = array(
			array(
				'name' => 'PHP version',
				'mandatory' => true,
				'condition' => version_compare(phpversion(), '7.1', '>='),
				'by' => 'PHP version',
				'memo' =>  Yii::t('installerSystemCheck','PHP version 7.1 required')
			),

			// Database :
			'dbPDO' => array(
				'name' => 'PDO extension',
				'mandatory' => true,
				'condition' => extension_loaded('pdo'),
				'by' => 'All DB-related classes',
				'memo' =>  Yii::t('installerSystemCheck','Required for database connections.'),
			),
			'dbMySql' => array(
				'name' => 'PDO MySQL extension',
				'mandatory' => false,
				'condition' => extension_loaded('pdo_mysql'),
				'by' => 'All DB-related classes',
				'memo' =>  Yii::t('installerSystemCheck','Required for MySQL database.'),
			),

			// PHP ini
			'phpExposePhp' => array(
				'name' => 'Expose PHP',
				'mandatory' => false,
				'condition' => $requirementsChecker->checkPhpIniOff("expose_php"),
				'by' => 'Security reasons',
				'memo' =>  Yii::t('installerSystemCheck','"expose_php" should be disabled at php.ini'),
			),
			'phpAllowUrlInclude' => array(
				'name' => 'PHP allow url include',
				'mandatory' => false,
				'condition' => $requirementsChecker->checkPhpIniOff("allow_url_include"),
				'by' => 'Security reasons',
				'memo' =>  Yii::t('installerSystemCheck','"allow_url_include" should be disabled at php.ini'),
			),
			'phpSmtp' => array(
				'name' => 'PHP mail SMTP',
				'mandatory' => true,
				'condition' => strlen(ini_get('SMTP')) > 0,
				'by' => 'Email sending',
				'memo' =>  Yii::t('installerSystemCheck','PHP mail SMTP server required'),
			),
		);


		return $requirementsChecker->checkYii()->check($requirements)->getResult();
	}
}