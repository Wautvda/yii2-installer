<?php
namespace weblogic\installer\models;

use yii\base\Model;

class MailerSettings extends Model
{
	public $host;
	public $username;
	public $password;
	public $password_confirm;
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
			[['password','password_confirm'], 'safe'],
			[['port'], 'integer'],

			[['password_confirm'], 'compare', 'compareAttribute' => 'password'],
			[['encryption'],  'in', 'range' => ['ssl', 'tls', null]],
		];
	}

	public function attributeLabels()
	{
		return [
			'host'              => 'Host',
			'username'          => 'Email',
			'password'          => 'Password',
			'password_confirm'  => 'Confirm password',
			'port'              => 'Port',
			'encryption'        => 'Encryption',
			'from_name'         => 'From name',
			'from_email'        => 'From email address'
		];
	}
}