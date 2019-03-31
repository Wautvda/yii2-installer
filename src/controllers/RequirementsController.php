<?php

namespace weblogic\installer\controllers;

use weblogic\installer\helpers\enums\Configuration;
use weblogic\installer\helpers\InstallerHelper;
use weblogic\installer\helpers\SystemCheck;
use Yii;
use yii\web\Controller;

class RequirementsController extends Controller
{
	public $layout = 'setup';

	/**
	 * Checks if the application has been installed already
	 * @param $action
	 * @return bool|\yii\web\Response
	 * @throws \yii\web\BadRequestHttpException
	 */
	public function beforeAction($action)
	{
		// Checks if application has been installed successfully
		if (Yii::$app->params[Configuration::APP_INSTALLED])
		{
			return $this->redirect(Yii::$app->homeUrl);
		}

		return parent::beforeAction($action);
	}

	/**
	 * Prerequisites check for application requirement
	 */
	public function actionIndex()
	{
		$checks = SystemCheck::getResults();
		return $this->render('requirements', $checks);
	}

	/**
	 * Sets the requirements met flag
	 */
	public function actionFinish()
	{
		$params = InstallerHelper::get(Configuration::PARAMS_FILE);
		$params[Configuration::APP_REQUIREMENTS_MET] = true;
		InstallerHelper::set(Configuration::PARAMS_FILE, $params);


		return $this->redirect(Yii::$app->urlManager->createUrl('//installer/database/index'));
	}
}