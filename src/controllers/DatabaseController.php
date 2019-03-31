<?php

namespace weblogic\installer\controllers;

use weblogic\installer\helpers\enums\Configuration;
use weblogic\installer\helpers\InstallerHelper;
use weblogic\installer\models\DatabaseSettings;
use Yii;
use yii\db\Connection;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Setup class that contains the following steps:
 * 1) init
 */
class DatabaseController extends Controller
{
	public $layout = 'setup';

	/**
	 * @var array
	 */
	private $config;

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

		if ($action->id === 'migrate' || $action->id === 'migrate-up' || $action->id === 'migrate-finished') {
			if (!$this->module->executeMigrations) {
				return $this->redirect(Yii::$app->urlManager->createUrl('//installer/mailer/index'));
			}
		}

		return parent::beforeAction($action);
	}

	/**
	 * Database action is responsible for all database related stuff.
	 * Checking given database settings, writing them into a config file.
	 */
	public function actionIndex()
	{
		if(InstallerHelper::validDbConnection())
		{
			return $this->redirect(Yii::$app->urlManager->createUrl('//installer/database/overview'));
		}
		return $this->redirect(Yii::$app->urlManager->createUrl('//installer/database/setup'));
	}

	/**
	 * Display the overview of database settings
	 * @return string
	 */
	public function actionOverview()
	{
		return $this->render('overview', ['model' => $this->getDatabaseSetting()]);
	}

	/**
	 * Editable database settings display.
	 * Settings will also be saved in the config files.
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionSetup()
	{
		$errorMsg = '';
		$form = new DatabaseSettings();

		if ($form->load(Yii::$app->request->post())) {
			if (Yii::$app->request->isAjax) {
				Yii::$app->response->format = Response::FORMAT_JSON;

				return ActiveForm::validate($form);
			}

			if ($form->validate()) {
				$dsn = "mysql:host=" . $form->hostname . ";dbname=" . $form->database;
				// Create Test DB Connection
				Yii::$app->set('db', [
					'class' => Connection::class,
					'dsn' => $dsn,
					'username' => $form->username,
					'password' => $form->password,
					'charset' => 'utf8'
				]);

				try {
					$this->getDatabaseSetting();
					Yii::$app->db->open();
					if (InstallerHelper::validDbConnection()) {
						$this->config['components']['db']['class'] = Connection::class;
						$this->config['components']['db']['dsn'] = $dsn;
						$this->config['components']['db']['username'] = $form->username;
						$this->config['components']['db']['password'] = $form->password;
						$this->config['components']['db']['charset'] = 'utf8';

						InstallerHelper::set(Configuration::CONFIG_FILE, $this->config);

						if (Yii::$app->cache)
						{
							Yii::$app->cache->flush();
						}

						return $this->redirect(Yii::$app->urlManager->createUrl('//installer/database/overview'));
					}
					else {
						$errorMsg = 'Incorrect configuration';
					}
				}
				catch (Exception $e) {
					$errorMsg = $e->getMessage();
				}
			}
			else {
				$errorMsg = $form->getErrors();
			}
		}
		return $this->render('setup', ['model' => $this->getDatabaseSetting(), 'errorMsg' => $errorMsg]);
	}

	public function actionMigrate(){
		return $this->render('migration');
	}

	/**
	 * Does the necessary migrations
	 * @throws \yii\base\InvalidConfigException
	 * @throws \yii\base\InvalidRouteException
	 * @throws \yii\console\Exception
	 */
	public function actionMigrateUp(){
		// https://github.com/yiisoft/yii2/issues/1764#issuecomment-42436905
		$oldApp = \Yii::$app;
		new \yii\console\Application([
			'id'            => 'Command runner',
			'basePath'      => '@app',
			'components'    => [
				'db' => $oldApp->db,
			],
		]);
		\Yii::$app->runAction('migrate/up', ['interactive' => false]);
		\Yii::$app = $oldApp;
		return $this->redirect(Yii::$app->urlManager->createUrl('//installer/database/migrate-finished'));
	}

	public function actionMigrateFinished(){
		return $this->render('migrationEnd');
	}

	private function getDatabaseSetting() : DatabaseSettings
	{
		$this->config = InstallerHelper::get(Configuration::CONFIG_FILE);

		$form = new DatabaseSettings();
		if(isset($this->config['components']['db']['dsn'])){
			$dsn = $this->config['components']['db']['dsn'];
			$form->hostname = $this->getDsnAttribute("host", $dsn);
			$form->database = $this->getDsnAttribute("dbname", $dsn);
		}

		if (isset($this->config['components']['db']['username'])) {
			$form->username = $this->config['components']['db']['username'];
		}

		return $form;
	}

	private function getDsnAttribute($name, $dsn)
	{
		if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
			return $match[1];
		} else {
			return null;
		}
	}
}
