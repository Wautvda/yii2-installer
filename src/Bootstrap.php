<?php

namespace weblogic\installer;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;

class Bootstrap implements BootstrapInterface
{

	/**
	 * Bootstrap method to be called during application bootstrap stage.
	 * @param Application $app the application currently running
	 * @throws \yii\base\InvalidConfigException
	 */
	public function bootstrap($app)
	{
		if ($app->hasModule('installer') && $app->getModule('installer') instanceof Module) {
			$this->initTranslations($app);
		}
	}

	/**
	 * Registers module translation messages.
	 *
	 * @param Application $app
	 *
	 * @throws \yii\base\InvalidConfigException
	 */
	protected function initTranslations(Application $app)
	{
		if (!isset($app->get('i18n')->translations['installer*'])) {
			$app->get('i18n')->translations['installer*'] = [
				'class' => PhpMessageSource::class,
				'basePath' => __DIR__ . '/resources/i18n',
				'sourceLanguage' => 'en',
			];
		}
	}
}