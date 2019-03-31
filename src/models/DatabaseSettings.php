<?php
namespace weblogic\installer\models;

use Yii;
use yii\base\Model;

/**
 * DatabaseForm holds all required database settings.
 */
class DatabaseSettings extends Model
{
	public $hostname;
	public $username;
	public $password;
	public $database;

	public function rules()
	{
		return [
			[['hostname', 'username', 'database'], 'required'],
			[['password'], 'safe']
		];
	}

	public function attributeLabels()
	{
		return [
			'hostname' => Yii::t('installerDatabase', 'Hostname'),
			'username' => Yii::t('installerGeneral', 'Username'),
			'password' => Yii::t('installerGeneral', 'Password'),
			'database' => Yii::t('installerDatabase', 'Database name')
		];
	}
}