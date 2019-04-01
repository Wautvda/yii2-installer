<?php

namespace weblogic\installer\models;

use Yii;
use yii\base\Model;

class UserModel extends Model
{
	public $email;
	public $username;
	public $password;
	public $password_confirm;
	public $role;

	public function rules()
	{
		return [
			[['email','username', 'role'], 'required'],
			[['username', 'role'], 'string', 'max' => 128],
			[['email'], 'email'],
			[['password', 'password_confirm'], 'safe'],

			[['password_confirm'], 'compare', 'compareAttribute' => 'password'],
		];
	}

	public function attributeLabels()
	{
		return [
			'host'              => Yii::t('installerUser', 'Email'),
			'username'          => Yii::t('installerGeneral', 'Username'),
			'password'          => Yii::t('installerGeneral', 'Password'),
			'password_confirm'  => Yii::t('installerGeneral', 'Password confirm'),
			'role'              => Yii::t('installerUser', 'role'),
		];
	}
}