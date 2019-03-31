<?php

namespace weblogic\installer\models;

use yii\base\Model;

class GeneralSettings extends Model
{
	public $applicationName;

	public function rules()
	{
		return [
			[['applicationName'], 'required'],
			[['applicationName'], 'string', 'max' => 128],
		];
	}

	public function attributeLabels()
	{
		return [
			'applicationName' => 'Application name',
		];
	}
}