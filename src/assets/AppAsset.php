<?php

namespace weblogic\installer\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl  = '@web/assets';
	public $css      = [
		'https://use.fontawesome.com/releases/v5.8.1/css/all.css'
	];
	public $js       = [
	];
	public $depends  = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}