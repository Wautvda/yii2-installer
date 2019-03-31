<?php
/**
 * @var $model \weblogic\installer\models\MailerSettings
 */

use yii\helpers\Html;
use yii\widgets\DetailView; ?>

<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerSettings','Settings Configuration') ?></h2>
	</div>
	<div class="panel-body">
		<p><?= Yii::t('installerSettings','These are the current settings. You can adapt them by clicking on "Edit"') ?></p>

		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				'applicationName',
                'timeZone'
			],
		]) ?>

		<div>
			<?= Html::a(Yii::t('installerGeneral','Edit'), ['settings/setup'], ['class' => 'btn btn-primary']) ?>
			<?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['settings/finish'], ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
		</div>
	</div>
</div>