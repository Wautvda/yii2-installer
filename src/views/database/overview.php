<?php
/**
 * @var $model \weblogic\installer\models\DatabaseSettings
 */
use yii\helpers\Html;
use yii\widgets\DetailView; ?>

<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerDatabase','Database Configuration') ?></h2>
	</div>
	<div class="panel-body">
        <h3><?= Yii::t('installerGeneral', 'Description') ?></h3>
		<p><?= Yii::t('installerDatabase','These are the current connection details. If you’re not sure about these, please contact your administrator or web host.') ?></p>

		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				'hostname',
				'database',
				'username',
			],
		]) ?>

		<div>
            <?= Html::a(Yii::t('installerGeneral','Edit'), ['database/setup'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['database/migrate'], ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
		</div>
	</div>
</div>