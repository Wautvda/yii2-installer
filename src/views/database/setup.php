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
		<h2 class="text-center"><?= Yii::t('installerDatabase','Database Configuration') ?></h2>
	</div>
	<div class="panel-body">
		<p><?= Yii::t('installerDatabase','Please enter your database connection details. If you’re not sure about these, please contact your administrator or web host.') ?></p>

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
                ])->hint(Yii::t('installerDatabase','The hostname. You should be able to get this from your hosting or use the default "localhost".')) ?>
		</div>

        <hr/>

        <div class="form-group">
			<?=
			$form->field($model, 'database')->textInput([
				'autocomplete' => 'off',
				'class'        => 'form-control',
			])->hint(Yii::t('installerDatabase','The name of the database you want to install your application on.')) ?>
        </div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'username')->textInput([
				    'autocomplete' => 'off',
                    'class'        => 'form-control',
                ]) ?>
		</div>

		<div class="form-group">
			<?=
				$form->field($model, 'password')->passwordInput([
				    'class' => 'form-control',
                ]) ?>
		</div>

		<hr/>

        <div>
            <?= Html::a(Yii::t('installerGeneral','Cancel settings adaptation'), ['database/index'], ['class' => 'btn btn-danger', 'style'=>'float: left']) ?>
            <?= Html::submitButton(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
        </div>


		<?php ActiveForm::end(); ?>
	</div>
</div>