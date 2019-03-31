<?php
/**
 * @var $model \weblogic\installer\models\DatabaseSettings
 * @var $errorMsg string
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center">Database Configuration</h2>
	</div>
	<div class="panel-body">
		<p>Below you have to enter your database connection details. If you’re not sure about these, please contact your administrator or web host.</p>

		<?php if (!empty($errorMsg)) { ?>
            <div class="alert alert-danger">
                <strong><?= $errorMsg ?></strong>
            </div>
		<?php } ?>

		<?php
			$form = ActiveForm::begin([
                'enableAjaxValidation'  => false
            ]);
		?>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'hostname')->textInput([
				    'autofocus'    => 'on',
                    'autocomplete' => 'off',
                    'class'        => 'form-control',
                ])->hint('You should be able to get this info from your web host, if localhost does not work.') ?>
		</div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'username')->textInput([
				    'autocomplete' => 'off',
                    'class'        => 'form-control',
                ])->hint('Your MySQL username') ?>
		</div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'password')->passwordInput([
				    'class' => 'form-control',
                ])->hint('Your MySQL password') ?>
		</div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'database')->textInput([
				    'autocomplete' => 'off',
                    'class'        => 'form-control',
                ])->hint('The name of the database you want to run your application in.') ?>
		</div>

		<hr/>

		<?= Html::submitButton('Next', ['class' => 'btn btn-primary']) ?>

		<?php ActiveForm::end(); ?>
	</div>
</div>