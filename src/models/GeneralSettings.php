<?php

namespace weblogic\installer\models;

use yii\base\Model;

class GeneralSettings extends Model
{
	public $applicationName;
	public $timeZone;
	public $timeZoneIndex;

	public function rules()
	{
		return [
			[['applicationName', 'timeZone'], 'required'],
			[['applicationName'], 'string', 'max' => 128],
			[['timeZone'], 'string'],
			[['timeZoneIndex'], 'integer'],
		];
	}

	public function attributeLabels()
	{
		return [
			'applicationName' => 'Application name',
			'timeZoneIndex' => 'Time zone',
			'timeZone' => 'Time zone',
		];
	}
}