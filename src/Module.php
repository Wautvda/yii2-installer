<?php

namespace weblogic\installer;

use \yii\base\Module as BaseModule;

/**
 * installer module definition class
 */
class Module extends BaseModule
{
	/**
	 * @var string Website used to display at the bottom of the installer
	 */
	public $poweredByWebsite = "https://www.weblogiconline.eu";
	/**
	 * @var string Name used to display under the installer
	 */
	public $poweredByName = "Weblogic";
	/**
	 * @var boolean Should migrations be executed or not
	 */
	public $executeMigrations = true;
    /**
     * {@inheritdoc}
     */


    public function init()
    {
        parent::init();
    }
}
