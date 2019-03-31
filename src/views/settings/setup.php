<?php
/**
 * @var $model \weblogic\installer\models\GeneralSettings
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$timeZones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
if(!isset($model->timeZoneIndex)){
	$model->timeZone = array_search('Europe/Brussels', $timeZones);
}
?>

<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerSettings','Settings Configuration') ?></h2>
	</div>
	<div class="panel-body">
		<p><?= Yii::t('installerSettings','Please adapt your settings if necessary.') ?></p>

		<?php
			$form = ActiveForm::begin([
                'enableAjaxValidation'  => false
            ]);
		?>

		<div class="form-group">
			<?=
				$form->field($model, 'applicationName')->textInput([
				    'autofocus' => 'on',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                ]) ?>
		</div>

        <div class="form-group">
			<?=
                $form->field($model, 'timeZoneIndex')->dropdownList(
				$timeZones,
				[
					'autocomplete' => 'off',
					'class' => 'form-control'
				]) ?>
        </div>

        <div>
			<?= Html::a(Yii::t('installerGeneral','Cancel settings adaptation'), ['settings/index'], ['class' => 'btn btn-danger', 'style'=>'float: left']) ?>
			<?= Html::submitButton(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
        </div>

		<?php ActiveForm::end(); ?>
	</div>
</div>