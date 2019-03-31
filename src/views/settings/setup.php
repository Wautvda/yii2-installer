<?php
/**
 * @var $model \weblogic\installer\models\MailerSettings
 * @var $errorMsg string
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
                ])->hint('The email host') ?>
		</div>

		<?php if (!empty($errorMsg)) { ?>
			<div class="alert alert-danger">
				<strong><?= $errorMsg ?></strong>
			</div>
		<?php } ?>

		<?= Html::submitButton('Next', ['class' => 'btn btn-primary']) ?>

		<?php ActiveForm::end(); ?>
	</div>
</div>