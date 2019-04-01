<?php
namespace weblogic\installer\controllers;

use DateTimeZone;
use weblogic\installer\helpers\enums\Configuration;
use weblogic\installer\helpers\InstallerHelper;
use weblogic\installer\models\GeneralSettings;
use Yii;
use yii\base\Module;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SettingsController extends Controller
{
	public $layout = 'setup';
	private $timeZones;

	function __construct(string $id, Module $module, array $config = [])
	{
		parent::__construct($id, $module, $config);
		$this->timeZones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
	}

	/**
	 * Checks if the application has been installed already
	 * @param $action
	 * @return bool|\yii\web\Response
	 * @throws \yii\web\BadRequestHttpException
	 */
	public function beforeAction($action)
	{
		if (Yii::$app->cache) {
			Yii::$app->cache->flush();
		}

		if (Yii::$app->params[Configuration::APP_INSTALLED])
		{
			return $this->redirect(Yii::$app->homeUrl);
		}

		if (!isset(Yii::$app->params[Configuration::APP_REQUIREMENTS_MET]) || !Yii::$app->params[Configuration::APP_REQUIREMENTS_MET])
		{
			return $this->redirect(Yii::$app->urlManager->createUrl('//installer/requirements/index'));
		}

		if(!InstallerHelper::validDbConnection())
		{
			return $this->redirect(Yii::$app->urlManager->createUrl('//installer/database/index'));
		}

		return parent::beforeAction($action);
	}

	/**
	 * Database action is responsible for all database related stuff.
	 * Checking given database settings, writing them into a config file.
	 */
	public function actionIndex()
	{
		return $this->render('overview', ['model' => $this->getGeneralSetting()]);
	}

	public function actionSetup()
	{
		$config = InstallerHelper::get(Configuration::CONFIG_FILE);

		$settings = new GeneralSettings();
		if ($settings->load(Yii::$app->request->post()))
		{
			if (Yii::$app->request->isAjax)
			{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($settings);
			}

			if(!isset($settings->timeZone))
			{
				$settings->timeZone = $this->timeZones[$settings->timeZoneIndex];
			}

			if ($settings->validate())
			{
				$config[Configuration::APP_NAME] = $settings->applicationName;
				$config[Configuration::APP_TIMEZONE] = $this->timeZones[$settings->timeZoneIndex];

				InstallerHelper::set(Configuration::CONFIG_FILE, $config);

				return $this->redirect(Yii::$app->urlManager->createUrl('//installer/settings/finish'));
			}
		}

		return $this->render('setup', ['model' => $this->getGeneralSetting()]);
	}

	public function actionFinish()
	{
		$params = InstallerHelper::get(Configuration::PARAMS_FILE);
		$params[Configuration::APP_INSTALLED] = true;
		InstallerHelper::set(Configuration::PARAMS_FILE, $params);

		return $this->render('finished');
	}

	private function getGeneralSetting() : GeneralSettings
	{
		$config = InstallerHelper::get(Configuration::CONFIG_FILE);

		$settings = new GeneralSettings();
		$settings->applicationName = $config[Configuration::APP_NAME];
		$settings->timeZone = $config[Configuration::APP_TIMEZONE];
		$settings->timeZoneIndex = array_search($config[Configuration::APP_TIMEZONE], $this->timeZones);

		return $settings;
	}

}