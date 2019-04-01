<?php
namespace weblogic\installer\models;

use Yii;
use yii\base\Model;

class MailerSettings extends Model
{
	public $host;
	public $username;
	public $password;
	public $port;
	public $encryption;
	public $from_email;
	public $from_name;

	public function rules()
	{
		return [
			[['host','username', 'password', 'password_confirm', 'port', 'encryption'], 'required'],
			[['host', 'encryption', 'username', 'from_name'], 'string', 'max' => 128],
			[['from_email'], 'email'],
			[['password'], 'safe'],
			[['port'], 'integer'],

			[['encryption'],  'in', 'range' => ['ssl', 'tls', null]],
		];
	}

	public function attributeLabels()
	{
		return [
			'host'              => Yii::t('installerMailer', 'Host'),
			'username'          => Yii::t('installerGeneral', 'Username'),
			'password'          => Yii::t('installerGeneral', 'Password'),
			'port'              => Yii::t('installerMailer', 'Port'),
			'encryption'        => Yii::t('installerMailer', 'Encryption'),
			'from_name'         => Yii::t('installerMailer', 'From name'),
			'from_email'        => Yii::t('installerMailer', 'From email address')
		];
	}
}