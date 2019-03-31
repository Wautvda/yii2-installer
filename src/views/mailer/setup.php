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

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'host')->textInput([
				    'autofocus' => 'on',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                ])->hint('The email host') ?>
		</div>

		<div class="form-group">
			<?=
				$form->field($model, 'username')->textInput([
				    'autocomplete' => 'off',
                    'class' => 'form-control',
                ])->hint('Your mailer username') ?>
		</div>

        <div class="form-group">
			<?=
			$form->field($model, 'port')->textInput([
				'autocomplete' => 'off',
				'type' => 'number',
				'class' => 'form-control',
			])->hint('Port of the mailer') ?>
        </div>

        <div class="form-group">
			<?=
			$form->field($model, 'encryption')->dropdownList(
				[
					'ssl' => 'ssl',
					'tls' => 'tls',
					null => 'none'
				],
				[
					'autocomplete' => 'off',
					'class' => 'form-control'
				])->hint('Can be ssl, tls or nothing (ssl or tls are preferred if possible)') ?>
        </div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'password')->passwordInput([
				    'class' => 'form-control',
                ])->hint('Your mailer password') ?>
		</div>

        <div class="form-group">
			<?=
			$form->field($model, 'password_confirm')->passwordInput([
				'class' => 'form-control',
			])->hint('Confirm mailer password') ?>
        </div>

        <hr/>

        <div class="form-group">
			<?=
			$form->field($model, 'from_email')->textInput([
				'autocomplete' => 'off',
				'class' => 'form-control',
			])->hint('Name shown to the receiver of messages sent via the application') ?>
        </div>

        <div class="form-group">
			<?=
			$form->field($model, 'from_name')->textInput([
				'autocomplete' => 'off',
				'class' => 'form-control',
			])->hint('Name shown to the receiver of messages sent via the application') ?>
        </div>

		<hr/>

		<?php if (!empty($errorMsg)) { ?>
			<div class="alert alert-danger">
				<strong><?= $errorMsg ?></strong>
			</div>
		<?php } ?>

		<?= Html::submitButton('Next', ['class' => 'btn btn-primary']) ?>

		<?php ActiveForm::end(); ?>
	</div>
</div>