<?php

namespace weblogic\installer\controllers;

use Swift_SmtpTransport;
use weblogic\installer\helpers\enums\Configuration;
use weblogic\installer\helpers\InstallerHelper;
use weblogic\installer\models\MailerSettings;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class MailerController extends Controller
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
		if (Yii::$app->cache)
		{
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
		return $this->render('overview', ['model' => $this->getMailerSetting()]);
	}

	public function actionSetup()
	{
		$config = InstallerHelper::get(Configuration::CONFIG_FILE);
		$params = InstallerHelper::get(Configuration::PARAMS_FILE);
		$mailer = new MailerSettings();

		if ($mailer->load(Yii::$app->request->post()))
		{
			if (Yii::$app->request->isAjax)
			{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($mailer);
			}

			if ($mailer->validate())
			{
				$config['components']['mailer']['transport']['class'] = Swift_SmtpTransport::class;
				$config['components']['mailer']['transport']['host'] = $mailer->host;
				$config['components']['mailer']['transport']['username'] = $mailer->username;
				$config['components']['mailer']['transport']['password'] = $mailer->password;
				$config['components']['mailer']['transport']['port'] = $mailer->port;
				$params['supportEmail'] = $mailer->from_email;
				$params['supportName'] = $mailer->from_name;

				InstallerHelper::set(Configuration::CONFIG_FILE, $config);
				InstallerHelper::set(Configuration::PARAMS_FILE, $params);

				return $this->redirect(Yii::$app->urlManager->createUrl('//installer/mailer/index'));
			}
		}

		return $this->render('setup', ['model' => $this->getMailerSetting()]);
	}

	private function getMailerSetting()
	{
		$config = InstallerHelper::get(Configuration::CONFIG_FILE);
		$params = InstallerHelper::get(Configuration::PARAMS_FILE);
		$mailer = new MailerSettings();

		if(isset($config['components']['mailer']['transport']['host']))
		{
			$mailer->host = $config['components']['mailer']['transport']['host'];
		}

		if(isset($config['components']['mailer']['transport']['username']))
		{
			$mailer->username = $config['components']['mailer']['transport']['username'];
		}

		if(isset($config['components']['mailer']['transport']['port']))
		{
			$mailer->port = $config['components']['mailer']['transport']['port'];
		}

		if(isset($config['components']['mailer']['transport']['encryption']))
		{
			$mailer->encryption = $config['components']['mailer']['transport']['encryption'];
		}

		if(isset($config['components']['mailer']['transport']['encryption']))
		{
			$mailer->encryption = $config['components']['mailer']['transport']['encryption'];
		}

		$mailer->from_email = $params['supportEmail'];
		$mailer->from_name = $params['supportName'];

		return $mailer;
	}
}
