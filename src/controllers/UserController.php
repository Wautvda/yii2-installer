<?php
namespace weblogic\installer\controllers;

use Da\User\Event\MailEvent;
use Da\User\Factory\MailFactory;
use Da\User\Model\User;
use Da\User\Service\UserCreateService;
use Da\User\Traits\ContainerAwareTrait;
use weblogic\installer\helpers\enums\Configuration;
use weblogic\installer\helpers\InstallerHelper;
use weblogic\installer\models\UserModel;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class UserController extends Controller
{
	use ContainerAwareTrait;
	public $layout = 'setup';

	/**
	 * Checks if the application has been installed already
	 * @param $action
	 * @return bool|Response
	 * @throws BadRequestHttpException
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

		if(!$this->module->addAdminUser)
		{
			return $this->redirect(Yii::$app->urlManager->createUrl('//installer/settings/index'));
		}

		return parent::beforeAction($action);
	}

	public function actionIndex()
	{
		$user = new UserModel();
		$user->role = $this->module->addAdminUserDefaultRole;

		if ($user->load(Yii::$app->request->post()))
		{
			if (Yii::$app->request->isAjax)
			{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($user);
			}

			if ($user->validate())
			{
				$errors = $this->createAdminUser($user);
				if(empty($errors))
				{
					return $this->redirect(Yii::$app->urlManager->createUrl('//installer/settings/index'));
				}
				else
				{
					return $this->render('index', ['model' => $user, 'errors' => $errors]);
				}
			}
		}

		return $this->render('index', ['model' => $user, 'errors' => $user->getErrorSummary(true)]);
	}

	/**
	 * Creates a new admin user
	 * @param UserModel $userModel
	 * @return array
	 * @throws InvalidConfigException
	 */
	private function createAdminUser(UserModel $userModel) : array
	{
		$user = $this->make(User::class, [], ['scenario' => 'create']);
		$errors = array();
		$loginData = array(
			'User' =>
				[
					'email' => $userModel->email,
					'username' => $userModel->username,
					'password' => $userModel->password
				]
		);


		if ($user->load($loginData) && $user->validate()) {

			$module = Yii::$app->getModule('user');
			$params = [
				'user' => $user,
				'token' => null,
				'module' => $module,
				'showPassword' => false,
			];
			$subject = $module->mailParams['welcomeMailSubject'];
			$mailService = MailFactory::makeMailerService(MailEvent::TYPE_WELCOME, Yii::$app->params['supportEmail'], $userModel->email, $subject, 'welcome', $params);

			if ($this->make(UserCreateService::class, [$user, $mailService])->run()) {
				try{
					$this->assignRole($user, $userModel->role);
				}
				catch (\Exception $ex)
				{
					$errors[] = $ex->getMessage();
				}
			}
		}
		else
		{
			$errors =array_merge( $errors, $user->getErrorSummary(true));
		}

		return $errors;
	}

	/**
	 * Assigns a role to a user. When the role didn't exist, the role is created
	 * @param User $user
	 * @param $role
	 * @throws \Exception
	 */
	private function assignRole(User $user, $role)
	{
		$auth = Yii::$app->getAuthManager();
		if ($auth === false)
		{
			throw new \Exception(Yii::t('installerUser', 'Cannot assign role "{0}" as the AuthManager is not configured in your application', $role));
		}
		else
		{
			$userRole = $auth->getRole($role);
			if (null === $userRole) {
				$userRole = $auth->createRole($role);
				$auth->add($userRole);
			}
			$auth->assign($userRole, $user->id);
		}
	}
}