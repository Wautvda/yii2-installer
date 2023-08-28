<?php
/**
 * @var $model UserModel
 * @var $errors array
 */

use weblogic\installer\models\UserModel;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerUser','User setup') ?></h2>
	</div>
	<div class="panel-body">
        <h3><?= Yii::t('installerGeneral', 'Description') ?></h3>
		<p><?= Yii::t('installerUser','Add a user to the system') ?></p>

		<?php if (!empty($errors)) {
		    foreach ($errors as $error) { ?>
            <div class="alert alert-danger">
                <strong><?= $error ?></strong>
            </div>
		<?php } } ?>

		<?php
			$form = ActiveForm::begin([
                'enableAjaxValidation'  => false
            ]);
		?>

        <div class="form-group">
			<?=
			$form->field($model, 'email')->textInput([
				'autocomplete' => 'off',
				'class' => 'form-control',
			]) ?>
        </div>

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
			])->hint(Yii::t('installerUser','When empty a password will be generated')) ?>
        </div>

        <div class="form-group">
            <?=
			$form->field($model, 'password_confirm')->passwordInput([
				'class' => 'form-control',
			])?>
        </div>

        <div class="form-group">
			<?=
			$form->field($model, 'role')->textInput([
				'autocomplete' => 'off',
				'class' => 'form-control',
			])->hint(Yii::t('installerUser','Role the user needs to have. If this role doesn\'t exist it will be made'))?>
        </div>

        <div>
	        <?= Html::a(Yii::t('installerGeneral','Skip'), ['settings/index'], ['class' => 'btn btn-danger', 'style'=>'float: left']) ?>
	        <?= Html::submitButton(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
        </div>

		<?php ActiveForm::end(); ?>
	</div>
</div>