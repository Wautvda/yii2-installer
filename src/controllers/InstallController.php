<?php

namespace weblogic\installer\controllers;

use weblogic\installer\helpers\enums\Configuration;
use Yii;
use yii\web\Controller;
use yii\web\ErrorAction;

/**
 * Controller to execute the installer
 * 1) Check requirement
 * 2) Check database settings
 * 3) Check mailer settings
 * 4) execute migrations if any
 * @package weblogic\installer\controllers
 */
class InstallController extends Controller
{
	public $layout = 'setup';

	public function actions()
	{
		return [
			'error' => [
				'class' => ErrorAction::class,
			],
		];
	}

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
	 * Installation welcome page
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}
}
