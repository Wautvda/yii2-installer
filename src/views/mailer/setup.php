<?php
/**
 * @var $model \weblogic\installer\models\MailerSettings
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerMailer','Mailer Configuration') ?></h2>
	</div>
	<div class="panel-body">
		<p><?= Yii::t('installerMailer','Please enter your mail configuration settings. If you’re not sure about these, please contact your administrator or web host.') ?></p>

		<?php
			$form = ActiveForm::begin([
                'enableAjaxValidation'  => false
            ]);
		?>

		<hr />

		<div class="form-group">
			<?=
				$form->field($model, 'host')->textInput([
				    'autofocus' => 'on',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                ]) ?>
		</div>

        <hr />

		<div class="form-group">
			<?=
				$form->field($model, 'username')->textInput([
				    'autocomplete' => 'off',
                    'class' => 'form-control',
                ]) ?>
		</div>

        <div class="form-group">
			<?=
			$form->field($model, 'password')->passwordInput([
				'class' => 'form-control',
			]) ?>
        </div>

        <hr />

        <div class="form-group">
			<?=
			$form->field($model, 'port')->textInput([
				'autocomplete' => 'off',
				'type' => 'number',
				'class' => 'form-control',
			]) ?>
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
				])->hint(Yii::t('installerMailer','Encryption when sending emails. Ssl or tls are advised.')) ?>
        </div>

        <hr />

        <div class="form-group">
			<?=
			$form->field($model, 'from_email')->textInput([
				'autocomplete' => 'off',
				'class' => 'form-control',
			])->hint(Yii::t('installerMailer','Email shown to reply to when sending from the application')) ?>
        </div>

        <div class="form-group">
			<?=
			$form->field($model, 'from_name')->textInput([
				'autocomplete' => 'off',
				'class' => 'form-control',
			])->hint(Yii::t('installerMailer','Name shown to the receiver of messages sent via the application')) ?>
        </div>

		<hr/>

        <div>
	        <?= Html::a(Yii::t('installerGeneral','Cancel settings adaptation'), ['mailer/index'], ['class' => 'btn btn-danger', 'style'=>'float: left']) ?>
			<?= Html::submitButton(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
        </div>

		<?php ActiveForm::end(); ?>
	</div>
</div>