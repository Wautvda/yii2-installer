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
		<h2 class="text-center">Mailer Configuration</h2>
	</div>
	<div class="panel-body">
		<p>Adapt the Mailer configuration. If you’re not sure about these, please contact your administrator or web host.</p>

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
                ])->hint('The application name displayed on the website') ?>
		</div>

        <div class="form-group">
			<?=
                $form->field($model, 'timeZoneIndex')->dropdownList(
				$timeZones,
				[
					'autocomplete' => 'off',
					'class' => 'form-control'
				])->hint('The timezone most frequently used in the application') ?>
        </div>

		<?= Html::submitButton('Next', ['class' => 'btn btn-primary']) ?>

		<?php ActiveForm::end(); ?>
	</div>
</div>